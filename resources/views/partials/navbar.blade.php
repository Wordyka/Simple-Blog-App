<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="/">Blogger</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link {{($title=='Home')?'active':''}}" href="/">Home</a>
                <a class="nav-link {{($title=='Category')?'active':''}}" href="/category">Category</a>
                <a class="nav-link {{($title=='Article')?'active':''}}" href="/article">Article</a>
            </div>
            <div class="navbar-nav ms-auto">
                <a class="nav-link active" href="/masuk"><i class="fa-solid fa-right-to-bracket"></i>&nbsp;Login</a>
            </div>
        </div>
    </div>
</nav>