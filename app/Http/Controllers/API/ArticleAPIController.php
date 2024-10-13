<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ArticleAPIController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return response()->json([
            'code' => 200,
            'data' => $articles,
            'message' => 'Articles retrieved successfully'
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
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Handle validation errors
        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'errors' => $validator->errors(),
                'message' => 'Validation failed.'
            ], 422);
        }

        // Create and save the article
        $article = new Article;
        $article->title = $request->title;
        $article->content = $request->content;
        $fileName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $fileName);
        $article->image = $fileName;
        $article->user_id = Auth::guard('api')->user()->id;
        $article->category_id = $request->category_id;
        $article->save();

        return response()->json([
            'code' => 201,
            'data' => $article,
            'message' => 'Article created successfully.'
        ], 201);
    }

    public function show(Article $article)
    {
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

    public function update(Request $request, Article $article)
    {
        // Check if user is authenticated
        if (!Auth::guard('api')->check()) {
            return response()->json([
                'code' => 401,
                'message' => 'Unauthorized: Please provide a valid token.'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Handle validation errors
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
        $fileName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $fileName);
        $article->image = $fileName;
        $article->user_id = Auth::guard('api')->user()->id;
        $article->category_id = $request->category_id;
        $article->save();

        return response()->json([
            'code' => 200,
            'data' => $article,
            'message' => 'Article updated successfully.'
        ], 200);
    }

    public function destroy(Article $article)
    {
        // Check if user is authenticated
        if (!Auth::guard('api')->check()) {
            return response()->json([
                'code' => 401,
                'message' => 'Unauthorized: Please provide a valid token.'
            ], 401);
        }

        $article->delete();
        return response()->json([
            'code' => 204,
            'message' => 'Article deleted successfully.'
        ], 204);
    }
}
