@extends('layouts.main-admin')

@section('content')

@include('sweetalert::alert')


<div class="shadow p-3 mb-5 bg-body rounded container border mt-5">

    <h2 class="mb-5 mt-5 mx-5 fw-bold text-center">Update Article</h2>


    <form enctype="multipart/form-data" action="{{ route('articles.update',$article->id) }}" method="post">
        @method('PUT')
        @csrf
        <div class="form-group mt-3">
            <div class="d-flex justify-content-center">
                <label class="mx-4 w-25" for="title">Title</label>
                <input type="text" name="title" class="form-control mx-4" autofocus autocomplete="off" value="{{$article->title}}">
            </div>
        </div>

        @error('title')
        <div class="alert-danger mt-1">{{$message}}</div>
        @enderror

        <div class="form-group mt-3">
            <div class="d-flex justify-content-center">
                <label class="mx-4 w-25" for="contents">Content</label>
                <textarea name="contents" class="form-control mx-4" id="contents" cols="30" value="{{ $article->content }}" rows="10">{{ $article->content }}</textarea>
            </div>
        </div>

        @error('contents')
        <div class="alert-danger mt-1">{{$message}}</div>
        @enderror

        <div class="form-group mt-3">
        <div class="d-flex justify-content-center">
            <label class="mx-4 w-25" for="image">Image Link</label>
            <input type="text" class="form-control mx-4" id="image" name="image" value="{{$article->image}}">
        </div>
        </div>

        @error('image')
        <div class="alert-danger mt-1">{{$message}}</div>
        @enderror

        <div class="form-group mt-3">
        <div class="d-flex justify-content-center">
            <label class="mx-4 w-25" for="category_id">Category</label>
            <select class="form-control mx-4" id="category_id" name="category_id">
                <option value="{{ $article->category->id }}">{{ $article->category->name }}</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        </div>

        @error('category_id')
        <div class="alert-danger mt-1">{{$message}}</div>
        @enderror

        <br><br>

        <div class="form-group mt-3 mt-5">
            <div class="d-flex justify-content-center">
                <a href="{{route('articles.index')}}" class="btn btn-secondary mx-4" style="width: 40%">Cancel</a>
                <button type="submit" class="btn btn-success mx-4" style="width: 40%">Save</button>
            </div>
        </div>

    </form>
</div>
<br><br><br>

@endsection