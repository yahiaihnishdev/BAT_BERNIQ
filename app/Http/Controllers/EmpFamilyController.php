<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmpFamily;

class EmpFamilyController extends Controller
{
    public function create()
    {
        return view('pages.emp_family.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'emp_id' => 'required|integer',
            'person_name' => 'required|string|max:250',
            'person_rel' => 'required|string',
            'person_birth_date' => 'required|date',
        ]);

        EmpFamily::create($request->all());

        return redirect()->route('emp_family.index')->with('success', 'Family member added successfully.');
    }

    public function index()
    {
        $emp_family = EmpFamily::where('person_active', 1)->get();
        return view('pages.emp_family.index', compact('emp_family'));
    }

    public function edit($id)
    {
        $empFamily = EmpFamily::findOrFail($id);
        return view('pages.emp_family.edit', compact('empFamily'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'emp_id' => 'required|integer',
            'person_name' => 'required|string|max:250',
            'person_rel' => 'required|string',
            'person_birth_date' => 'required|date',
        ]);

        $empFamily = EmpFamily::findOrFail($id);
        $empFamily->update($request->all());

        return redirect()->route('emp_family.index')->with('success', 'Family member updated successfully.');
    }

    public function delete($id)
    {
        $empFamily = EmpFamily::findOrFail($id);
        $empFamily->update(['person_active' => 0]);

        return redirect()->route('emp_family.index')->with('success', 'Family member marked as inactive.');
    }
}
