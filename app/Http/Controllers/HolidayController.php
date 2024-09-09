<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holiday;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class HolidayController extends Controller
{
    // Show the form to create a new holiday
    public function create()
    {
        return view('pages.holidays.add');
    }

    // Store the newly created holiday
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'holiday_name' => 'required|string|max:250',
            'holiday_from' => 'required|date',
            'holiday_to' => 'required|date|after_or_equal:holiday_from',
            'emp_id' => 'required|integer',
        ]);

        // Create the holiday
        Holiday::create([
            'holiday_name' => $request->input('holiday_name'),
            'holiday_from' => $request->input('holiday_from'),
            'holiday_to' => $request->input('holiday_to'),
            'emp_id' => $request->input('emp_id'),
            'holiday_active' => 1,
        ]);

        return redirect()->route('holidays.index')->with('success', 'Holiday added successfully.');
    }

    // Display a listing of the holidays
    public function index()
    {
        $holidays = Holiday::where('holiday_active', 1)->get();
        return view('pages.holidays.index', compact('holidays'));
    }

    // Export holidays to PDF
    public function exportPDF()
    {
        $holidays = Holiday::where('holiday_active', 1)->get();

        // Load the view and pass the holidays data with the Arabic font configuration
        $pdf = PDF::loadView('pages.holidays.pdf', compact('holidays'));

        // Set Paper Size and Orientation
        $pdf->setPaper('a4', 'portrait'); // Use A4 size paper in portrait mode

        // Return the generated PDF
        return $pdf->download('holidays_report.pdf');
    }

    // Show the form to edit a holiday
    public function edit($id)
    {
        $holiday = Holiday::findOrFail($id);
        return view('pages.holidays.edit', compact('holiday'));
    }

    // Update the specified holiday
    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'holiday_name' => 'required|string|max:250',
            'holiday_from' => 'required|date',
            'holiday_to' => 'required|date|after_or_equal:holiday_from',
            'emp_id' => 'required|integer',
        ]);

        $holiday = Holiday::findOrFail($id);

        // Update the holiday
        $holiday->update([
            'holiday_name' => $request->input('holiday_name'),
            'holiday_from' => $request->input('holiday_from'),
            'holiday_to' => $request->input('holiday_to'),
            'emp_id' => $request->input('emp_id'),
            'holiday_active' => 1,
        ]);

        return redirect()->route('holidays.index')->with('success', 'Holiday updated successfully.');
    }

    // Soft-delete the holiday
    public function delete($id)
    {
        $holiday = Holiday::findOrFail($id);
        $holiday->update(['holiday_active' => 0]);

        return redirect()->route('holidays.index')->with('success', 'Holiday marked as inactive.');
    }

    // Search holidays
    public function search(Request $request)
    {
        $query = $request->input('query');
        $holidays = Holiday::where('holiday_active', 1)
            ->where('holiday_name', 'LIKE', "%{$query}%")
            ->get();

        return response()->json($holidays);
    }
}
