<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CategoryAPIController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        
        return response()->json([
            'code' => 200,
            'data' => $categories,
            'message' => 'Categories retrieved successfully.'
        ], 200);
    }

    public function store(Request $request)
    {
        // Check if user is authenticated
        if (!Auth::guard('api')->check()) {
            return response()->json([
                'code' => 401,
                'message' => 'Unauthorized: Please provide a valid token.'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        // Handle validation errors
        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'errors' => $validator->errors(),
                'message' => 'Validation failed.'
            ], 422);
        }

        // Create and save the category
        $category = new Category;
        $category->name = $request->name;
        $category->user_id = Auth::guard('api')->user()->id;
        $category->save();

        return response()->json([
            'code' => 201,
            'data' => $category,
            'message' => 'Category created successfully.'
        ], 201);
    }

    public function show(Category $category)
    {
        return response()->json([
            'code' => 200,
            'data' => $category,
            'message' => 'Category retrieved successfully.'
        ], 200);
    }

    public function update(Request $request, Category $category)
    {
        // Check if user is authenticated
        if (!Auth::guard('api')->check()) {
            return response()->json([
                'code' => 401,
                'message' => 'Unauthorized: Please provide a valid token.'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        // Handle validation errors
        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'errors' => $validator->errors(),
                'message' => 'Validation failed.'
            ], 422);
        }

        // Update the category
        $category->name = $request->name;
        $category->save();

        return response()->json([
            'code' => 200,
            'data' => $category,
            'message' => 'Category updated successfully.'
        ], 200);
    }

    public function destroy(Category $category)
    {
        // Check if user is authenticated
        if (!Auth::guard('api')->check()) {
            return response()->json([
                'code' => 401,
                'message' => 'Unauthorized: Please provide a valid token.'
            ], 401);
        }

        $category->delete();

        return response()->json([
            'code' => 204,
            'message' => 'Category deleted successfully.'
        ], 204);
    }
}
