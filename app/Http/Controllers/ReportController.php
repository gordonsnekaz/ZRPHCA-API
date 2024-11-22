<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with(['patient'])->get();
        return response()->json($reports);
    }

    /**
     * Store a newly created report.
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'diagnosed_by' => 'required|exists:users,id',
            'diagnosis_date' => 'required|date',
            'diagnosis' => 'required|date',
            'symptoms' => 'required|string',
            'prescribed_medication' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $report = Report::create($request->all());
        return response()->json($report, 201);
    }

    /**
     * Display the specified report.
     */
    public function show($id)
    {
        $reports = Report::with(['patient'])->where('patient_id', $id)->get();

        return response()->json($reports);
    }

    /**
     * Update the specified report.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'patient_id' => 'sometimes|exists:patients,id',
            'diagnosed_by' => 'sometimes|exists:users,id',
            'diagnosis_date' => 'sometimes|date',
            'diagnosis' => 'sometimes|date',
            'symptoms' => 'sometimes|string',
            'prescribed_medication' => 'sometimes|string',
            'notes' => 'nullable|string',
        ]);

        $report = Report::findOrFail($id);
        $report->update($request->all());
        return response()->json($report);
    }

    /**
     * Remove the specified report.
     */
    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();
        return response()->json(['message' => 'Report deleted successfully']);
    }
}
