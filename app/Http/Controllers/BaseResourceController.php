<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseResourceController extends Controller
{
    protected $model;
    protected $validationRules = [];

    // Allows chargeable fields to be set dynamically from the child controller
    protected $chargeableFields = [];

    public function index()
    {
        // List all resources
        $items = $this->model::all();
        return response()->json($items, 200);
    }

    public function create()
    {
        // Show the form for creating a new resource
        return response()->json(['message' => 'Form for creating a resource'], 200);
    }

    public function store(Request $request)
    {
        // Dynamically set validation rules for chargeable fields
        $this->dynamicValidation($request);

        // Validate and store the new resource
        $validatedData = $request->validate($this->validationRules);
        $item = $this->model::create($validatedData);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        // Show a specific resource
        $item = $this->model::findOrFail($id);
        return response()->json($item, 200);
    }

    public function edit($id)
    {
        // Show the form for editing the resource
        $item = $this->model::findOrFail($id);
        return response()->json(['message' => 'Form for editing a resource', 'data' => $item], 200);
    }

    public function update(Request $request, $id)
    {
        // Dynamically set validation rules for chargeable fields
        $this->dynamicValidation($request);

        // Validate and update the resource
        $validatedData = $request->validate($this->validationRules);
        $item = $this->model::findOrFail($id);
        $item->update($validatedData);
        return response()->json($item, 200);
    }

    public function destroy($id)
    {
        // Delete the resource
        $item = $this->model::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Resource deleted'], 200);
    }

    // Add dynamic validation for fields passed in the chargeableFields array
    protected function dynamicValidation(Request $request)
    {
        foreach ($this->chargeableFields as $field => $rules) {
            if ($request->has($field)) {
                $this->validationRules[$field] = $rules;
            }
        }
    }
}
