<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CategoryAPIController extends Controller
{
    // Get all categories
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'code' => 200,
            'data' => $categories,
            'message' => 'Categories retrieved successfully.'
        ], 200);
    }

    // Get a single category by ID
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'code' => 404,
                'message' => 'Category not found.'
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'data' => $category,
            'message' => 'Category retrieved successfully.'
        ], 200);
    }

    // Create a new category (authenticated users only)
    public function store(Request $request)
    {
        // Check if Authorization header is present
        if (!$request->hasHeader('Authorization')) {
            return response()->json([
                'code' => 400,
                'message' => 'Bad Request: Authorization header is missing.'
            ], 400);
        }

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

    // Update an existing category by ID
    public function update(Request $request, $id)
    {
        // Check if Authorization header is present
        if (!$request->hasHeader('Authorization')) {
            return response()->json([
                'code' => 400,
                'message' => 'Bad Request: Authorization header is missing.'
            ], 400);
        }

        // Check if user is authenticated
        if (!Auth::guard('api')->check()) {
            return response()->json([
                'code' => 401,
                'message' => 'Unauthorized: Please provide a valid token.'
            ], 401);
        }

        // Find the category by ID
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'code' => 404,
                'message' => 'Category not found.'
            ], 404);
        }

        // Validate request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'errors' => $validator->errors(),
                'message' => 'Validation failed.'
            ], 422);
        }

        // Update the category
        $category->name = $request->name;
        $category->user_id = Auth::guard('api')->user()->id;
        $category->save();

        return response()->json([
            'code' => 200,
            'data' => $category,
            'message' => 'Category updated successfully.'
        ], 200);
    }

    // Delete a category by ID
    public function destroy(Request $request, $id)
    {
        // Check if Authorization header is present
        if (!$request->hasHeader('Authorization')) {
            return response()->json([
                'code' => 400,
                'message' => 'Bad Request: Authorization header is missing.'
            ], 400);
        }

        // Check if user is authenticated
        if (!Auth::guard('api')->check()) {
            return response()->json([
                'code' => 401,
                'message' => 'Unauthorized: Please provide a valid token.'
            ], 401);
        }

        // Find the category by ID
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'code' => 404,
                'message' => 'Category not found.'
            ], 404);
        }

        // Delete the category
        $category->delete();

        return response()->json([
            'code' => 204,
            'message' => 'Category deleted successfully.'
        ], 204);
    }
}
