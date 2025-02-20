<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::all();
        return response()->json($attributes, 200);
    }

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

    public function show(Attribute $attribute)
    {
        return response()->json($attribute, 200);
    }

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

    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return response()->json(['message' => 'Attribute deleted successfully'], 200);
    }
}
