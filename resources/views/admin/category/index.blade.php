@extends('layouts.main-admin')

@section('content')

@include('sweetalert::alert')

<h2 class="mb-5 mt-5 mx-5 fw-bold">LIST OF CATEGORIES</h2>

<a href="{{route('categories.create')}}" class="btn btn-success mx-5 ">Add Categories</a>

<div class="table-container mr-5 mx-5">
    <table class="table table-striped table-bordered mb-5 ">
        <thead>
            <tr>
                <th scope="col" class="text-center">No</th>
                <th scope="col" class="text-center">Name</th>
                <th scope="col" class="text-center">Sum of Articles</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            @foreach ($categories->where('user_id',Auth::user()->id) as $category)

            <?php $sumOfArticles = $articles->where('category_id',$category->id)->count(); ?>
            <tr>
                <td class="text-center">{{$i}}</td>
                <td class="text-center text-justify">{{$category->name}}</td>
                <td class="text-center text-justify">{{$sumOfArticles}}</td>
                <td class="text-center">
                    <div class="d-flex justify-content-around">
                        <a href="{{route('categories.edit',$category->id)}}" class="btn btn-warning">Update</a> &nbsp;
                        <form action="{{route('categories.destroy',$category->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>


            <?php $i++; ?>
            @endforeach

        </tbody>
    </table>

</div>

<br><br><br>

@endsection