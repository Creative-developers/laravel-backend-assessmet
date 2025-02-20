<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttributeValue;

class AttributeValueController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/attributeValues",
     *     summary="Get all attributes values",
     *     tags={"Attribute Values"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/AttributeValues")
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
        $attributes = AttributeValue::all();
        return response()->json($attributes, 200);
    }

    /**
     * @OA\Get(
     *     path="/api/attributeValues/{attributeValue}",
     *     summary="Get a single attribute value by ID",
     *     tags={"Attribute Values"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="attributeValue",
     *         description="Attribute Value ID",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/AttributeValues")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *    ),
     *     @OA\Response(
     *         response=404,
     *         description="Attribute Value not found"
     *     )
     * )
     */
    public function show(AttributeValue $attributeValue)
    {
        return response()->json($attributeValue, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/attributeValues/{attributeValue}",
     *     summary="Delete an attribute value",
     *     tags={"Attribute Values"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="attributeValue",
     *         description="Attribute Value ID",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Attribute Value deleted successfully",
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
    public function destroy(AttributeValue $attributeValue)
    {
        $attributeValue->delete();
        return response()->json(['message' => 'Attribute Value deleted successfully'], 200);
    }
}
