@extends('layouts.main')

@section('container')
@foreach($articles->take(1) as $article)
<h1 class="mb-5">Articles By Author : {{$article->user->name}}</h1>

@if($article->count())
<div class="card mb-5">
    <img src="{{$article->image}}" class="card-img-top" alt="..." width="300" height="300">
    <div class="card-body text-center">
        <h3 class="card-title">{{$article->title}}</h3>
        <small class="text-muted">
            <h6>By : <a href="/article/{{$article->user_id}}" class="text-decoration-none">{{$article->user->name}}</a> in <a href="/article-category/{{$article->category_id}}" class="text-decoration-none">{{$article->category->name}}</a></h6>
            <p class="card-text">{!!$article->content!!}</p>
            <p class="card-text text-end">Last updated {{$article->created_at->diffForHumans()}}</p>
        </small>
    </div>
</div>
@else
<p class="text-center fs-4">No article found.</p>
@endif

@endforeach

@include('partials.list-articles')

@include('partials.pagination-articles')

@endsection