<div class="d-flex justify-content-center mt-3" style="margin-bottom: 100px">
    @if(!empty($articles))
    <div class="pagination">
        {{ $articles->links() }}
    </div>
    @endif
</div>