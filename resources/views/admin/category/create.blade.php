@extends('layouts.main-admin')

@section('content')

@include('sweetalert::alert')


<div class="shadow p-3 mb-5 bg-body rounded container border mt-5">

    <h2 class="mb-5 mt-5 mx-5 fw-bold text-center">Add Categories</h2>


    <form enctype="multipart/form-data" action="{{ route('categories.store') }}" method="post">
        @csrf
        <div class="form-group mt-3">
            <div class="d-flex justify-content-center">
                <label class="mx-4 w-25" for="name">Name</label>
                <input type="text" name="name" class="form-control mx-4" value="{{ old('name') }}" autofocus autocomplete="off">
            </div>
        </div>

        @error('name')
        <div class="alert-danger mt-1">{{$message}}</div>
        @enderror

        
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
    
        <br><br>

        <div class="form-group mt-3 mt-5">
            <div class="d-flex justify-content-center">
                <a href="{{route('categories.index')}}" class="btn btn-secondary mx-4" style="width: 40%">Cancel</a>
                <button type="submit" class="btn btn-success mx-4" style="width: 40%">Submit</button>
            </div>
        </div>

    </form>
</div>
<br><br><br>

@endsection