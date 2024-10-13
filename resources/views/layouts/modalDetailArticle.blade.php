<div class="modal fade" id="detail-article<?= $article->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fw-bold text-center" id="exampleModalLabel">Detail Article</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <article >
                    <h4>{{$article->title}}</h4>
                    <h6 class="fst-italic">last updated at {{$article->created_at->diffForHumans()}}</h6>
                    <h6>By : <a href="/article/{{$article->user_id}}" class="text-decoration-none">{{$article->user->name}}</a> in <a href="/article-category/{{$article->category_id}}" class="text-decoration-none">{{$article->category->name}}</a></h6>
                    <div class="d-flex justify-content-start mb-3 mt-3">
                        <img src="{{$article->image}}" alt="" width=150 class="mx-4">
                        <p class="mx-4 text-justify">{!! $article->content !!}</p>
                    </div>
                </article>
            </div>
            <div class="modal-footer">
                <button style="width: 100%" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>