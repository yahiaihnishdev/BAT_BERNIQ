<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function create()
    {

        return view('pages.department.add-department');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dept_name' => 'required|string|max:255',
        ]);

        Department::create([
            'dept_name' => $request->input('dept_name'),
            'department_active' => $request->input('department_active', true),
        ]);

        return redirect()->route('index_department')->with('success', 'Department added successfully.');
    }

    public function index()
    {
        $departments = Department::where('department_active', 1)->get();
        return view('pages.department.department-index', compact('departments'));
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('pages.department.edit-department', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dept_name' => 'required|string|max:255',
        ]);

        $department = Department::findOrFail($id);
        $department->update([
            'dept_name' => $request->input('dept_name'),
            'department_active' => $request->input('department_active', true),
        ]);

        return redirect()->route('index_department')->with('success', 'Department updated successfully.');
    }

    public function delete($id)
    {
        $department = Department::findOrFail($id);
        $department->update(['department_active' => false]);

        return redirect()->route('index_department')->with('success', 'Department marked as inactive successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $departments = Department::where('department_active', 1)
                                ->where('dept_name', 'LIKE', "%{$query}%")
                                ->get();

        return response()->json($departments);
    }
}
