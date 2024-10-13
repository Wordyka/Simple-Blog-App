@extends('layouts.main')

@section('container')
<h1 class="mb-5">All Categories</h1>

<?php $i = 0; ?>
@foreach($categories as $category)
<article class="mb-2">
    <h5>{{$categories->firstItem()+$i.'. '}}<a href="/article-category/{{$category->id}}">{{$category->name}}</a></h5>
</article>
<?php $i++; ?>
@endforeach

<div class="d-flex justify-content-center mt-5" style="margin-bottom: 100px">
    @if(!empty($categories))
    <div class="pagination">
        {{ $categories->links() }}
    </div>
    @endif
</div>

@endsection