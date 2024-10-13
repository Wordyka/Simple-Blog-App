<!-- Sidebar  -->
<nav id="sidebar">
    <div id="dismiss">
        <span class="iconify" data-icon="bx:arrow-to-left" data-height=25></span>
    </div>

    <div class="sidebar-header text-center">
        <a href="{{route('articles.index')}}"><img src="../../../gambar/bloglogo.png" alt="" width="100px"></a>
    </div>

    <ul class="list-unstyled components">
        <li>
            <a href="{{route('articles.index')}}"><span class="iconify" data-icon="pixelarticons:article-multiple" data-height="25"></span>&nbsp;&nbsp;&nbsp;&nbsp;Articles</a>
        </li>
        <li>
            <a href="{{route('categories.index')}}"><span class="iconify" data-icon="bx:category" data-height="25"></span>&nbsp;&nbsp;&nbsp;&nbsp;Categories</a>
        </li>
    </ul>

</nav>