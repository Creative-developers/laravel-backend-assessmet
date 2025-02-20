<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttributeValue;

class AttributeValueController extends Controller
{
    public function index()
    {
        $attributes = AttributeValue::all();
        return response()->json($attributes, 200);
    }

    public function show(AttributeValue $attributeValue)
    {
        return response()->json($attributeValue, 200);
    }

    public function destroy(AttributeValue $attributeValue)
    {
        $attributeValue->delete();
        return response()->json(['message' => 'Attribute Value deleted successfully'], 200);
    }
}
