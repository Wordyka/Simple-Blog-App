<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $articles = Article::where('title', 'LIKE', '%' . $request->find . '%')->orWhere('content', 'LIKE', '%' . $request->find . '%')->with('user', 'category')->latest()->get();
        return view('admin.article.index', compact('articles'));
    }

    public function indexGuest()
    {
        $articles = Article::with('user', 'category')->latest()->simplePaginate(5);
        return view('guest.article', ['articles' => $articles, 'title' => 'Article']);

        $client = new Client();
        $response = $client->request('GET', 'http://localhost:9010/student/');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        $data = json_decode($body, true);

        return view('beranda', ['data' => $data]);
    }

    public function indexHome()
    {
        $articles = Article::with('user', 'category')->latest()->simplePaginate(5);
        return view('guest.home', ['articles' => $articles, 'title' => 'Home']);
    }

    public function indexUser(Request $request, $user_id)
    {
        $articles = Article::with('user', 'category')->latest()->where('user_id', $user_id)->simplePaginate(5);
        return view('guest.user-article', ['articles' => $articles, 'title' => 'Article']);
    }

    public function indexCategory(Request $request, $category_id)
    {
        $articles = Article::with('user', 'category')->latest()->where('category_id', $category_id)->simplePaginate(5);
        return view('guest.category-article', ['articles' => $articles, 'title' => 'Category']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.article.create', ['data' => new Article, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:articles|max:255',
            'contents' => 'required',
            'image' => 'required',
            'category_id' => 'required'
        ]);

        $article = new Article;
        $article->title = $request->title;
        $article->content = $request->contents;
        $article->image = $request->image;
        $article->user_id = $request->user_id;
        $article->category_id = $request->category_id;
        $article->save();

        return redirect()->route('articles.index')->with('success', 'Article has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('admin.article.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|max:255',
            'contents' => 'required',
            'image' => 'required',
            'category_id' => 'required',
        ]);

        $article->title = $request->title;
        $article->content = $request->contents;
        $article->image = $request->image;
        $article->category_id = $request->category_id;
        $article->save();

        return redirect()->route('articles.index')->with('success', 'Article has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article has been deleted');
    }
}
