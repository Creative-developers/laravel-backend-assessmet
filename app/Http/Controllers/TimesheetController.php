<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timesheet;
use Illuminate\Support\Facades\Log;

class TimesheetController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/timesheets",
     *     summary="Get all timesheets",
     *     tags={"Timesheets"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Timesheet")
     *         )
     *     ),
     *      @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     * )
     */
    public function index()
    {
        $timesheets = Timesheet::all();
        return response()->json($timesheets, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/timesheets",
     *     summary="Create a new timesheet",
     *     tags={"Timesheets"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="task_name", type="string", example="Task 1", description="Name of the task"),
     *             @OA\Property(property="date", type="string", format="date", example="2025-02-20", description="Date of the timesheet entry"),
     *             @OA\Property(property="hours", type="number", format="float", example=8, description="Number of hours worked"),
     *             @OA\Property(property="user_id", type="integer", example=1, description="ID of the user who worked on the task"),
     *             @OA\Property(property="project_id", type="integer", example=1, description="ID of the project the task belongs to")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Timesheet created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Timesheet")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation failed",
     *     ),
     *      @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/api/timesheets/{timesheet}",
     *     summary="Get a single timesheet by ID",
     *     tags={"Timesheets"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="timesheet",
     *         description="Timesheet ID",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/Timesheet")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Timesheet not found"
     *     ),
     *      @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     * )
     */
    public function show(Timesheet $timesheet)
    {
        return response()->json($timesheet, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/timesheets/{timesheet}",
     *     summary="Update an existing timesheet",
     *     tags={"Timesheets"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="timesheet",
     *          description="Timesheet ID",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             @OA\Property(property="task_name", type="string", example="Task 1", description="Name of the task", nullable=true),
     *             @OA\Property(property="date", type="string", format="date", example="2025-02-20", description="Date of the timesheet entry", nullable=true),
     *             @OA\Property(property="hours", type="number", format="float", example=8, description="Number of hours worked", nullable=true),
     *             @OA\Property(property="user_id", type="integer", example=1, description="ID of the user who worked on the task", nullable=true),
     *             @OA\Property(property="project_id", type="integer", example=1, description="ID of the project the task belongs to", nullable=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Timesheet updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Timesheet")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation failed",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     )
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/api/timesheets/{timesheet}",
     *     summary="Delete a timesheet",
     *     tags={"Timesheets"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="timesheet",
     *         description="Timesheet ID",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Timesheet deleted successfully",
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     )
     * )
     */
    public function destroy(Timesheet $timesheet)
    {
        $timesheet->delete();
        return response()->json(['message' => 'Timesheet deleted successfully'], 200);
    }
}
