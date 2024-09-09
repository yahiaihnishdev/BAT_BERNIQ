<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmpDocument;

class EmpDocumentController extends Controller
{
    public function create()
    {
        return view('pages.emp_document.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'emp_id' => 'required|integer',
            'document_name' => 'required|string|max:250',
            'document_type' => 'required|string',
            'document_path' => 'required|string|max:255',
        ]);

        EmpDocument::create($request->all());

        return redirect()->route('emp_document.index')->with('success', 'Document added successfully.');
    }

    public function index()
    {
        $emp_documents = EmpDocument::where('document_active', 1)->get();
        return view('pages.emp_document.index', compact('emp_documents'));
    }

    public function edit($id)
    {
        $empDocument = EmpDocument::findOrFail($id);
        return view('pages.emp_document.edit', compact('empDocument'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'emp_id' => 'required|integer',
            'document_name' => 'required|string|max:250',
            'document_type' => 'required|string',
            'document_path' => 'required|string|max:255',
        ]);

        $empDocument = EmpDocument::findOrFail($id);
        $empDocument->update($request->all());

        return redirect()->route('emp_document.index')->with('success', 'Document updated successfully.');
    }

    public function delete($id)
    {
        $empDocument = EmpDocument::findOrFail($id);
        $empDocument->update(['document_active' => 0]);

        return redirect()->route('emp_document.index')->with('success', 'Document marked as inactive.');
    }
}
