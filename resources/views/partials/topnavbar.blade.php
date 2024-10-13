<nav class="navbar navbar-light rounded-pill" style="background-color: #135589;">
    <div class="d-flex justify-content-between">
        <button type="button" id="sidebarCollapse" class="btn mx-4" style="background-color: #2A93D5;">
            <span class="iconify" data-icon="gg:menu" data-height=20></span></button>

        <form class="form-inline" method="get">
            <div class="d-flex">
                <input class="form-control" type="search" name="find" value="{{Request::get('find')}}" placeholder="Type keyword here..." aria-label="Search" size=50 autocomplete="off"> &nbsp;&nbsp;&nbsp;&nbsp;
                <button class="btn btn-outline-light ml-5" type="submit">Search</button>
            </div>
        </form>
    </div>


    <div class="d-flex justify-content-end mr-5">

        


        <div class="dropdown mr-5">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="iconify" data-icon="bxs:user"></span> {{Auth::user()->name}} &nbsp;&nbsp;&nbsp;&nbsp;</span>
            </button> 
            <ul class="dropdown-menu  mt-2" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span class="iconify" data-icon="charm:sign-out"></span>&nbsp;Log Out</a></li>
                </form>
            </ul>
        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>


    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

</nav>