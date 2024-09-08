<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    // Show the form to create a new resource
    public function create()
    {
        return view('pages.jobs.add'); // Return the 'add job' form
    }

    // Store the newly created resource
    public function store(Request $request)
    {
        // Validate the request input
        $request->validate([
            'job_title' => 'required|string|max:255', // Ensure job title is provided
        ]);

        // Create the new job entry
        Job::create([
            'job_title' => $request->input('job_title'),
            'job_active' => $request->input('job_active', true), // Default to active
        ]);

        // Redirect to the job listing with a success message
        return redirect()->route('jobs.index')->with('success', 'Job added successfully.');
    }

    // Display a listing of the resource
    public function index()
    {
        // Fetch all active jobs
        $jobs = Job::where('job_active', 1)->get();
        return view('pages.jobs.index', compact('jobs')); // Display them in the index view
    }

    // Show the form to edit a resource
    public function edit($id)
    {
        // Fetch the job to be edited
        $job = Job::findOrFail($id);
        return view('pages.jobs.edit', compact('job')); // Return the 'edit job' form
    }

    // Update the specified resource
    public function update(Request $request, $id)
    {
        // Validate the request input
        $request->validate([
            'job_title' => 'required|string|max:255', // Ensure job title is provided
        ]);

        // Find the job to update
        $job = Job::findOrFail($id);

        // Update the job details
        $job->update([
            'job_title' => $request->input('job_title'),
            'job_active' => $request->input('job_active', true),
        ]);

        // Redirect to the job listing with a success message
        return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
    }

    // Mark the resource as inactive (soft delete)
    public function delete($id)
    {
        // Find the job to mark as inactive
        $job = Job::findOrFail($id);
        $job->update(['job_active' => false]);

        // Redirect to the job listing with a success message
        return redirect()->route('jobs.index')->with('success', 'Job marked as inactive successfully.');
    }

    // Search for the resource
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search for jobs with matching titles
        $jobs = Job::where('job_active', 1)
                    ->where('job_title', 'LIKE', "%{$query}%")
                    ->get();

        // Return the search results as JSON
        return response()->json($jobs);
    }
}
