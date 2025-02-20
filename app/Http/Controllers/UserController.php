<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
    * @OA\Get(
    *     path="/api/users",
    *     summary="Get list of users",
    *     tags={"Users"},
    *     security={{"bearerAuth":{}}},
    *     @OA\Response(
    *         response=200,
    *         description="List of users",
    *         @OA\JsonContent(
    *             type="array",
    *             @OA\Items(ref="#/components/schemas/User")
    *         )
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="Unauthorized",
    *     ),
    * )
    */
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    /**
     * @OA\Get(
     *     path="/api/users/{user}/projects",
     *     summary="Get user projects",
     *     tags={"Users"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(type="integer", example="1")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of user projects",
     *         @OA\JsonContent(type="array", @OA\Items(type="object"))
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     ),
     * )
     */

    public function getProjects(User $user)
    {
        $projects = $user->projects;
        return response()->json($projects->load('attributeValues.attribute'), 200);
    }

    /**
     * @OA\Get(
     *     path="/api/users/{user}/timesheets",
     *     summary="Get user logged timesheets",
     *     tags={"Users"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(type="integer", example="1")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of user logged timesheets",
     *         @OA\JsonContent(type="array", @OA\Items(type="object"))
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     ),
     * )
     */
    public function getTimesheets(User $user)
    {
        $timesheets = $user->timesheets;
        return response()->json($timesheets, 200);
    }

    /**
    * @OA\Post(
    *     path="/api/users",
    *     summary="Create a new user",
    *     tags={"Users"},
    *     security={{"bearerAuth":{}}},
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             required={"first_name", "last_name", "email", "password"},
    *             @OA\Property(property="first_name", type="string", example="John"),
    *             @OA\Property(property="last_name", type="string", example="Doe"),
    *             @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
    *             @OA\Property(property="password", type="string", format="password", example="password123")
    *         )
    *     ),
    *     @OA\Response(
    *         response=201,
    *         description="User created successfully",
    *         @OA\JsonContent(ref="#/components/schemas/User")
    *     ),
    *     @OA\Response(
    *         response=422,
    *         description="Validation error"
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="Unauthorized",
    *     )
    * )
    */


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


    /**
     * @OA\Get(
     *     path="/api/users/{user}",
     *     summary="Get a user by ID",
     *     tags={"Users"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User details",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     ),
     *   @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *
     * )
     */

    public function show(User $user)
    {
        return response()->json($user, 200);
    }


    /**
    * @OA\Put(
    *     path="/api/users/{user}",
    *     summary="Update user details",
    *     tags={"Users"},
    *     security={{"bearerAuth":{}}},
    *     @OA\Parameter(
    *         name="user",
    *         in="path",
    *         required=true,
    *         description="User ID",
    *         @OA\Schema(type="integer", example=1)
    *     ),
    *     @OA\RequestBody(
    *         required=false,
    *         @OA\JsonContent(
    *             @OA\Property(property="first_name", type="string", example="John", nullable=true),
    *             @OA\Property(property="last_name", type="string", example="Doe" , nullable=true),
    *             @OA\Property(property="email", type="string", format="email", example="john.doe@example.com" , nullable=true),
    *             @OA\Property(property="password", type="string", format="password", nullable=true, example="newpassword123" , nullable=true)
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="User updated successfully",
    *         @OA\JsonContent(ref="#/components/schemas/User")
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="User not found"
    *     ),
    *     @OA\Response(
    *         response=422,
    *         description="Validation error"
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="Unauthorized",
    *     )
    * )
    */

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

    /**
    * @OA\Delete(
    *     path="/api/users/{user}",
    *     summary="Delete a user",
    *     tags={"Users"},
    *     security={{"bearerAuth":{}}},
    *     @OA\Parameter(
    *         name="user",
    *         in="path",
    *         required=true,
    *         description="User ID",
    *         @OA\Schema(type="integer", example=1)
    *     ),
    *     @OA\Response(
    *         response=204,
    *         description="User deleted successfully"
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="User not found"
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="Unauthorized",
    *     )
    * )
    */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully',
        ], 204);
    }
}
