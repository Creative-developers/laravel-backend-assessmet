<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timesheet;
use Illuminate\Support\Facades\Log;

class TimesheetController extends Controller
{
    public function index()
    {
        $timesheets = Timesheet::all();
        return response()->json($timesheets, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
           'task_name' => 'required|string|max:255',
           'date' => 'required|date',
           'hours' => 'required|numeric',
           'user_id' => 'required|exists:users,id',
           'project_id' => 'required|exists:projects,id',
        ]);

        $timesheet = Timesheet::create($validated);
        return response()->json($timesheet, 201);
    }

    public function show(Timesheet $timesheet)
    {
        return response()->json($timesheet, 200);
    }

    public function update(Request $request, Timesheet $timesheet)
    {
        $validated = $request->validate([
            'task_name' => 'sometimes|string|max:255',
            'date' => 'sometimes|date',
            'hours' => 'sometimes|numeric',
            'user_id' => 'sometimes|exists:users,id',
            'project_id' => 'sometimes|exists:projects,id',
         ]);

        $timesheet->update($validated);
        return response()->json([
            'message' => 'Timesheet updated successfully',
            'timesheet' => $timesheet
        ], 200);
    }

    public function destroy(Timesheet $timesheet)
    {
        $timesheet->delete();
        return response()->json(['message' => 'Timesheet deleted successfully'], 200);
    }
}
