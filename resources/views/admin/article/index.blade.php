@extends('layouts.main-admin')

@section('content')

@include('sweetalert::alert')

<h2 class="mb-5 mt-5 mx-5 fw-bold">LIST OF ARTICLES</h2>

<a href="{{route('articles.create')}}" class="btn btn-success mx-5 ">Add Article</a>

<div class="table-container mr-5 mx-5">
    <table class="table table-striped table-bordered mb-5 ">
        <thead>
            <tr>
                <th scope="col" class="text-center">No</th>
                <th scope="col" class="text-center">Title</th>
                <th scope="col" class="text-center">Content</th>
                <th scope="col" class="text-center">Category</th>
                <th scope="col" class="text-center">Image</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            @foreach ($articles->where('user_id',Auth::user()->id) as $article)

            <tr>
                <td class="text-start">{{$i}}</td>
                <td class="text-start text-justify">{{$article->title}}</td>
                <td class="text-start text-justify">{{$article->content}}</td>
                <td class="text-start">{{$article->category->name}}</td>
                <td class="text-center"><img src="{{$article->image}}" alt="{{ $article->title }}" width="100"></td>
                <td class="text-center">
                    <div class="d-flex justify-content-around">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detail-article<?= $article->id ?>">Detail</button> &nbsp;
                        <a href="{{route('articles.edit',$article->id)}}" class="btn btn-warning">Update</a> &nbsp;
                        <form action="{{route('articles.destroy',$article->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>

            <!-- MODAL DETAIL ARTICLE -->
            @include('layouts.modalDetailArticle')

            <?php $i++; ?>
            @endforeach

        </tbody>
    </table>

</div>

<br><br><br>

@endsection