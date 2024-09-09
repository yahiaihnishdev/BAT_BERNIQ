<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::where('job_active', 1)->get();
        return view('pages.job.jobs-index', compact('jobs'));

    }

    public function create()
    {
        return view('pages.job.add-job');
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
        ]);

        Job::create([
            'job_title' => $request->input('job_title'),
            'job_active' => $request->input('job_active', true),
        ]);

        return redirect()->route('job.index')->with('success', 'Job added successfully.');
    }

    public function edit($id)
    {
        $job = Job::findOrFail($id);
        return view('pages.job.edit-job', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
        ]);

        $job = Job::findOrFail($id);
        $job->update([
            'job_title' => $request->input('job_title'),
            'job_active' => $request->input('job_active', true),
        ]);

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
    }

    public function delete($id)
    {
        $job = Job::findOrFail($id);
        $job->update(['job_active' => false]);

        return redirect()->route('jobs.index')->with('success', 'Job deactivated successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $jobs = Job::where('job_active', 1)
                    ->where('job_title', 'LIKE', "%{$query}%")
                    ->get();

        return view('pages.job.job_search', compact('jobs'));
    }
}
