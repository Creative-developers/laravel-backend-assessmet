<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeValueController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TimesheetController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::get('/users/{user}/projects', [UserController::class, 'getProjects'])->name('user.projects');
    Route::get('/users/{user}/timesheets', [UserController::class, 'getTimesheets'])->name('user.timesheets');
    Route::apiResource('attributes', AttributeController::class);
    Route::apiResource('attributeValues', AttributeValueController::class);
    Route::apiResource('projects', ProjectController::class);
    Route::post('/projects/{project}/assign-user/{user}', [ProjectController::class, 'assignUserToProject'])->name('project.assignUser');
    Route::post('/projects/{project}/remove-user/{user}', [ProjectController::class, 'removeUserToProject'])->name('project.removeUser');
    Route::apiResource('timesheets', TimesheetController::class);

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('{any}', function () {
    return response(
        content: [
            'status' => 'error',
            'message' => 'invalid request',
        ],
        status: 422
    );
});
