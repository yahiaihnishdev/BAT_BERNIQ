<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Job;
use App\Models\Department;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the employees with search and filter functionalities.
     */
    public function index(Request $request)
    {
        // Start a query on the Employee model, filtering active employees
        $query = Employee::query()->where('emp_active', 1);

        // Search by employee name
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('emp_name', 'like', "%{$search}%");
        }

        // Filter by Department ID
        if ($request->filled('dept_id')) {
            $dept_id = $request->input('dept_id');
            $query->where('dept_id', $dept_id);
        }

        // Filter by Job ID
        if ($request->filled('job_id')) {
            $job_id = $request->input('job_id');
            $query->where('job_id', $job_id);
        }

        // Eager load relationships to prevent N+1 problem
        $employees = $query->with(['job', 'department'])->paginate(10)->appends($request->all());

        // Fetch all active departments and jobs for filter dropdowns
        $departments = Department::where('department_active', 1)->get();
        $jobs = Job::where('job_active', 1)->get();

        return view('pages.employees.index', compact('employees', 'departments', 'jobs'));
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create()
    {
        // Fetch all active departments and jobs to populate select inputs
        $departments = Department::where('department_active', 1)->get();
        $jobs = Job::where('job_active', 1)->get();
        return view('pages.employees.add', compact('departments', 'jobs'));
    }

    /**
     * Store a newly created employee in the database.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'emp_name' => 'required|string|max:250',
            'emp_username' => 'required|string|max:250|unique:employees,emp_username',
            'emp_password' => 'required|string|min:6|confirmed',
            'birth_date' => 'required|date',
            'nid' => 'required|string|max:15',
            'job_id' => 'required|integer|exists:jobs,job_id',
            'dept_id' => 'required|integer|exists:departments,dept_id',
            'basic_salary' => 'required|numeric',
            'hire_date' => 'required|date',
        ]);

        // Auto-generate emp_num_id
        $lastEmployee = Employee::orderBy('emp_num_id', 'desc')->first();
        $newEmployeeNumber = $lastEmployee ? $lastEmployee->emp_num_id + 1 : 1;

        // Prepare employee data
        $employeeData = $request->all();
        $employeeData['emp_num_id'] = $newEmployeeNumber;
        $employeeData['emp_active'] = 1; // Mark as active

        // Create the employee
        Employee::create($employeeData);

        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::where('department_active', 1)->get();
        $jobs = Job::where('job_active', 1)->get();
        return view('pages.employees.edit', compact('employee', 'departments', 'jobs'));
    }

    /**
     * Update the specified employee in the database.
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        // Validate incoming request data
        $request->validate([
            'emp_name' => 'required|string|max:250',
            'emp_username' => 'required|string|max:250|unique:employees,emp_username,' . $id . ',emp_id',
            'emp_password' => 'nullable|string|min:6|confirmed',
            'birth_date' => 'required|date',
            'nid' => 'required|string|max:15',
            'job_id' => 'required|integer|exists:jobs,job_id',
            'dept_id' => 'required|integer|exists:departments,dept_id',
            'basic_salary' => 'required|numeric',
            'hire_date' => 'required|date',
        ]);

        // Prepare employee data
        $employeeData = $request->all();

        // If password is provided, it will be hashed via the mutator
        if (empty($employeeData['emp_password'])) {
            unset($employeeData['emp_password']); // Do not update password if not provided
        }

        // Ensure emp_num_id is not updated
        unset($employeeData['emp_num_id']);

        // Update the employee
        $employee->update($employeeData);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Mark the specified employee as inactive (soft delete).
     */
    public function delete($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->update(['emp_active' => 0]);

        return redirect()->route('employees.index')->with('success', 'Employee marked as inactive.');
    }

    /**
     * Fetch only the employee's name by ID (optional).
     */
    public function fetchName($id)
    {
        $employee = Employee::findOrFail($id, ['emp_name']);
        return response()->json($employee);
    }

    /**
     * (Optional) Show a confirmation page before deleting an employee.
     */
    public function showDelete($id)
    {
        $employee = Employee::findOrFail($id);
        return view('pages.employees.delete', compact('employee'));
    }
}
