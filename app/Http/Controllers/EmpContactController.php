<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmpContact;

class EmpContactController extends Controller
{
    public function create()
    {
        return view('pages.emp_contacts.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'emp_id' => 'required|integer',
            'emp_phone' => 'required|string|max:15',
            'emp_email' => 'required|email|max:250',
            'emp_address' => 'required|string|max:255',
        ]);

        EmpContact::create($request->all());

        return redirect()->route('emp_contacts.index')->with('success', 'Contact added successfully.');
    }

    public function index()
    {
        $emp_contacts = EmpContact::where('person_active', 1)->get();
        return view('pages.emp_contacts.index', compact('emp_contacts'));
    }

    public function edit($id)
    {
        $empContact = EmpContact::findOrFail($id);
        return view('pages.emp_contacts.edit', compact('empContact'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'emp_id' => 'required|integer',
            'emp_phone' => 'required|string|max:15',
            'emp_email' => 'required|email|max:250',
            'emp_address' => 'required|string|max:255',
        ]);

        $empContact = EmpContact::findOrFail($id);
        $empContact->update($request->all());

        return redirect()->route('emp_contacts.index')->with('success', 'Contact updated successfully.');
    }

    public function delete($id)
    {
        $empContact = EmpContact::findOrFail($id);
        $empContact->update(['person_active' => 0]);

        return redirect()->route('emp_contacts.index')->with('success', 'Contact marked as inactive.');
    }
}
