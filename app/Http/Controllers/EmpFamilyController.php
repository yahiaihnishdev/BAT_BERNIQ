<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmpFamily;
use Illuminate\Http\Request;

class EmpFamilyController extends Controller
{
    // Display the list of family members with active status
    public function index(Request $request)
    {
        // Fetch the employee using the 'emp_id' from the request
        $employee = Employee::find($request->emp_id);

        if (!$employee) {
            return redirect()->back()->with('error', 'Employee not found.');
        }

        // Build the query to filter family members by employee ID and active status
        $query = EmpFamily::where('person_active', 1)
            ->where('emp_id', $request->emp_id);

        // If search input is provided, filter by the family member's name
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('person_name', 'like', "%{$search}%");
        }

        // Fetch the family members for the specified employee
        $emp_family = $query->paginate(10)->appends($request->all());

        return view('pages.emp_family.index', compact('emp_family', 'employee'));
    }


    // Show the form for creating a new family member
    // Show the form for creating a new family member
    public function create(Request $request)
    {
        // Get the emp_id from the query parameters
        $emp_id = $request->query('emp_id');

        // Check if emp_id exists, else redirect with an error
        if (!$emp_id) {
            return redirect()->route('employees.index')->with('error', 'Employee ID is required to add a family member.');
        }

        // Find the employee by emp_id
        $employee = Employee::findOrFail($emp_id);

        // Pass the employee object to the view
        return view('pages.emp_family.add', compact('employee'));
    }


    // Store a newly created family member in the database
    public function store(Request $request)
    {
        // Validate request input
        $request->validate([
            'emp_id' => 'required|integer',
            'person_name' => 'required|string|max:250',
            'person_rel' => 'required|string|max:100',
            'person_birth_date' => 'required|date',
        ]);

        // Prepare family member data
        $empFamilyData = $request->all();
        $empFamilyData['person_active'] = 1;

        // Create the new family member
        EmpFamily::create($empFamilyData);

        // Redirect back to the family members index for the specified employee
        return redirect()->route('emp_family.index', ['emp_id' => $request->emp_id])
            ->with('success', 'Family member added successfully.');
    }

    // Show the form for editing the specified family member
    public function edit($id)
    {
        $empFamily = EmpFamily::findOrFail($id);

        // Fetch the employee related to this family member
        $employee = Employee::findOrFail($empFamily->emp_id);

        return view('pages.emp_family.edit', compact('empFamily', 'employee'));
    }

    // Update the specified family member in the database
    public function update(Request $request, $id)
    {
        // Validate request input
        $request->validate([
            'emp_id' => 'required|integer',
            'person_name' => 'required|string|max:250',
            'person_rel' => 'required|string|max:100',
            'person_birth_date' => 'required|date',
            'person_phone' => 'nullable|string|max:255',
        ]);

        // Find the family member record
        $empFamily = EmpFamily::findOrFail($id);

        // Update the family member record
        $empFamily->update($request->all());

        // Redirect to the family members list for the specific employee
        return redirect()->route('emp_family.index', ['emp_id' => $request->emp_id])
                         ->with('success', 'Family member updated successfully.');
    }

    // Mark the family member as inactive (soft delete)
    public function delete($id)
    {
        $empFamily = EmpFamily::findOrFail($id);
        $empFamily->update(['person_active' => 0]);

        return redirect()->route('emp_family.index')->with('success', 'Family member marked as inactive.');
    }
}
