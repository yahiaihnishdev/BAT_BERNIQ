<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserType;

class UserTypeController extends Controller
{
    // Show the form to create a new user type
    public function create()
    {
        return view('pages.user_type.add'); // Return the 'add user type' form
    }


    public function store(Request $request)
    {
        // Validate the request input
        $request->validate([
            'user_type_name' => 'required|string|max:255', // Ensure user type name is provided
        ]);

        // Create the new user type entry with user_type_active defaulting to 1
        UserType::create([
            'user_type_name' => $request->input('user_type_name'),
            'user_type_active' => 1, // Default to active
        ]);

        // Redirect to the user type listing with a success message
        return redirect()->route('user_type.index')->with('success', 'UserType added successfully.');
    }


    // Display a listing of the user types
    public function index()
    {
        // Fetch all active user types
        $userTypes = UserType::where('user_type_active', 1)->get();
        return view('pages.user_type.index', compact('userTypes')); // Display them in the index view
    }

    // Show the form to edit a user type
    public function edit($id)
    {
        // Fetch the user type to be edited
        $userType = UserType::findOrFail($id);
        return view('pages.user_type.edit', compact('userType')); // Correct variable name
    }
// Update the specified user type
public function update(Request $request, $id)
{
    // Validate the request input
    $request->validate([
        'user_type_name' => 'required|string|max:255', // Ensure user type name is provided
    ]);

    // Find the user type to update
    $userType = UserType::findOrFail($id);

    // Update the user type details
    $userType->update([
        'user_type_name' => $request->input('user_type_name'),
        'user_type_active' => $request->input('user_type_active', true),
    ]);

    // Redirect to the user type listing with a success message
    return redirect()->route('user_type.index')->with('success', 'User type updated successfully.');
}

    // Mark the user type as inactive (soft delete)
    public function delete($id)
    {
        // Find the user type to mark as inactive
        $userType = UserType::findOrFail($id);
        $userType->update(['user_type_active' => false]);

        // Redirect to the user type listing with a success message
        return redirect()->route('user_type.index')->with('success', 'User type marked as inactive successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search for user types with matching names
        $userTypes = UserType::where('user_type_active', 1)
                    ->where('user_type_name', 'LIKE', "%{$query}%")
                    ->get();

        // Return the search results as JSON
        return response()->json($userTypes);
    }

}
