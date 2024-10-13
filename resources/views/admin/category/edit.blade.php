@extends('layouts.main-admin')

@section('content')

@include('sweetalert::alert')


<div class="shadow p-3 mb-5 bg-body rounded container border mt-5">

    <h2 class="mb-5 mt-5 mx-5 fw-bold text-center">Update Category</h2>


    <form enctype="multipart/form-data" action="{{ route('categories.update',$category->id) }}" method="post">
        @method('PUT')
        @csrf
        <div class="form-group mt-3">
            <div class="d-flex justify-content-center">
                <label class="mx-4 w-25" for="title">Name</label>
                <input type="text" name="name" class="form-control mx-4" autofocus autocomplete="off" value="{{$category->name}}">
            </div>
        </div>

        @error('name')
        <div class="alert-danger mt-1">{{$message}}</div>
        @enderror

        <br><br>

        <div class="form-group mt-3 mt-5">
            <div class="d-flex justify-content-center">
                <a href="{{route('categories.index')}}" class="btn btn-secondary mx-4" style="width: 40%">Cancel</a>
                <button type="submit" class="btn btn-success mx-4" style="width: 40%">Save</button>
            </div>
        </div>

    </form>
</div>
<br><br><br>

@endsection