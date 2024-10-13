@foreach($articles->skip(1) as $article)
<article class="mb-5 border-bottom">
    <h3>{{$article->title}}</h3>
    <h6 class="fst-italic">last updated at {{$article->created_at->diffForHumans()}}</h6>
    <h6 >By : <a href="/article/{{$article->user_id}}" class="text-decoration-none">{{$article->user->name}}</a> in <a href="/article-category/{{$article->category_id}}" class="text-decoration-none">{{$article->category->name}}</a></h6>
    <div class="d-flex justify-content-start mb-3 mt-3">
        <img src="{{$article->image}}" alt="" width=150 class="mx-4">
        <p class="mx-4">{!! $article->content !!}</p>
    </div>
</article>
@endforeach