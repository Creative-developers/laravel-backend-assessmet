<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;

class AttributeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/attributes",
     *     summary="Get all attributes",
     *     tags={"Attributes"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Attribute")
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
        $attributes = Attribute::all();
        return response()->json($attributes, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/attributes",
     *     summary="Create a new attribute",
     *     tags={"Attributes"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AttributeRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Attribute created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Attribute")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     ),
     *    @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *    )
     *
     * )
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'required|in:text,number,date,select',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }

        $attribute = Attribute::create($request->only(['name', 'type']));
        return response()->json($attribute, 201);
    }


    /**
     * @OA\Get(
     *     path="/api/attributes/{attribute}",
     *     summary="Get a single attribute by ID",
     *     tags={"Attributes"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="attribute",
     *         description="Attribute ID",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/Attribute")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *    ),
     *     @OA\Response(
     *         response=404,
     *         description="Attribute not found"
     *     )
     * )
     */
    public function show(Attribute $attribute)
    {
        return response()->json($attribute, 200);
    }


    /**
     * @OA\Put(
     *     path="/api/attributes/{attribute}",
     *     summary="Update an existing attribute",
     *     tags={"Attributes"},
     *     security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *         name="attribute",
     *         description="Attribute ID",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AttributeRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Attribute updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Attribute")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     ),
     *    @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *    )
     *
     * )
     */
    public function update(Request $request, Attribute $attribute)
    {
        try {
            $request->validate([
                'name' => 'sometimes|string|max:255',
                'type' => 'sometimes|in:text,number,date,select',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }

        $attribute->update($request->only(['name', 'type' ]));
        return response()->json($attribute, 201);
    }

    /**
     * @OA\Delete(
     *     path="/api/attributes/{attribute}",
     *     summary="Delete an attribute",
     *     tags={"Attributes"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="attribute",
     *         description="Attribute ID",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Attribute deleted successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Attribute deleted successfully")
     *         )
     *     ),
     *    @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *    ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return response()->json(['message' => 'Attribute deleted successfully'], 200);
    }
}
