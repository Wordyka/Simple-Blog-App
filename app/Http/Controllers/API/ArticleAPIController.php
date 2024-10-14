<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ArticleAPIController extends Controller
{
    // Get all articles
    public function index()
    {
        $articles = Article::all();

        return response()->json([
            'code' => 200,
            'data' => $articles,
            'message' => 'Articles retrieved successfully'
        ], 200);
    }

    // Store a new article (authenticated users only)
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

        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'errors' => $validator->errors(),
                'message' => 'Validation failed.'
            ], 422);
        }

        // Create and save the article
        $article = new Article();
        $article->title = $request->title;
        $article->content = $request->content;

        // Handle image upload
        $fileName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $fileName);
        $article->image = $fileName;

        // Save user and category
        $article->user_id = Auth::guard('api')->user()->id;
        $article->category_id = $request->category_id;
        $article->save();

        return response()->json([
            'code' => 201,
            'data' => $article,
            'message' => 'Article created successfully.'
        ], 201);
    }

    // Show a specific article by ID
    public function show($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'code' => 404,
                'message' => 'Article not found.'
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'data' => [
                'title' => $article->title,
                'content' => $article->content,
                'image' => $article->image,
                'user' => $article->user->name,
                'category' => $article->category->name,
            ],
            'message' => 'Article retrieved successfully.'
        ], 200);
    }

    // Update an existing article by ID
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

        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'code' => 404,
                'message' => 'Article not found.'
            ], 404);
        }

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'errors' => $validator->errors(),
                'message' => 'Validation failed.'
            ], 422);
        }

        // Update the article
        $article->title = $request->title;
        $article->content = $request->content;

        // Handle image upload
        $fileName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $fileName);
        $article->image = $fileName;

        // Update user and category
        $article->user_id = Auth::guard('api')->user()->id;
        $article->category_id = $request->category_id;
        $article->save();

        return response()->json([
            'code' => 200,
            'data' => $article,
            'message' => 'Article updated successfully.'
        ], 200);
    }

    // Delete an article by ID
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

        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'code' => 404,
                'message' => 'Article not found.'
            ], 404);
        }

        // Delete the article
        $article->delete();

        return response()->json([
            'code' => 204,
            'message' => 'Article deleted successfully.'
        ], 204);
    }
}
