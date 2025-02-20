<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function getProjects(User $user)
    {
        $projects = $user->projects;
        return response()->json($projects->load('attributeValues.attribute'), 200);
    }

    public function getTimesheets(User $user)
    {
        $timesheets = $user->timesheets;
        return response()->json($timesheets, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required','string','max:255',
            'last_name' => 'required','string','max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user, 201);
    }

    public function show(User $user)
    {
        return response()->json($user, 200);
    }


    public function update(Request $request, User $user)
    {
        Log::info('Request Data:', $request->all());

        $validatedData = $request->validate([
            'first_name' => 'string|max:255',
            'last_name' => '    string|max:255',
            'email' => 'string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'string|min:8|nullable',
        ]);


        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        }

        $user->update($validatedData);

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user], 200);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully',
        ], 204);
    }
}
