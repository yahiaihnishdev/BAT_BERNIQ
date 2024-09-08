<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    protected $model; // Model class (e.g., Job::class)
    protected $viewPath; // Path to views (e.g., 'pages.jobs')
    protected $validationRules = []; // Validation rules for the model
    protected $activeField = 'active'; // Field name for the active status, can be overridden in child classes
    protected $searchableFields = ['name']; // Default searchable fields, can be customized in child controllers

    // Index method: Shows a listing of all resources
    public function index()
    {
        $items = $this->model::where($this->activeField, 1)->get();
        return view("{$this->viewPath}.index", compact('items'));
    }

    // Create method: Show form to create new resource
    public function create()
    {
        return view("{$this->viewPath}.create");
    }

    // Store method: Save new resource in storage
    public function store(Request $request)
    {
        $request->validate($this->validationRules);
        $this->model::create($this->getFormData($request));
        return redirect()->route("{$this->viewPath}.index")
                         ->with('success', 'Record added successfully.');
    }

    // Edit method: Show form for editing a specific resource
    public function edit($id)
    {
        $item = $this->model::findOrFail($id);
        return view("{$this->viewPath}.edit", compact('item'));
    }

    // Update method: Update a specific resource in storage
    public function update(Request $request, $id)
    {
        $request->validate($this->validationRules);
        $item = $this->model::findOrFail($id);
        $item->update($this->getFormData($request));
        return redirect()->route("{$this->viewPath}.index")
                         ->with('success', 'Record updated successfully.');
    }

    // Destroy method: Delete a specific resource from storage
    public function destroy($id)
    {
        $item = $this->model::findOrFail($id);
        $item->delete(); // Adjust for soft delete if necessary
        return redirect()->route("{$this->viewPath}.index")
                         ->with('success', 'Record deleted successfully.');
    }

    // Search method: Perform search based on the input query
    public function search(Request $request)
    {
        $query = $request->input('query');
        $queryBuilder = $this->model::where($this->activeField, 1);

        foreach ($this->searchableFields as $field) {
            $queryBuilder->orWhere($field, 'LIKE', "%{$query}%");
        }

        $items = $queryBuilder->get();
        return response()->json($items);
    }

    // Extract form data from the request (can be customized in child controllers)
    protected function getFormData(Request $request)
    {
        return $request->all();
    }
}
