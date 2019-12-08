<div class="pos-f-t">
    <nav class="navbar navbar-dark bg-dark">
        <div class="row mr-auto">
            <button class="side-menu navbar-toggler"  style="border: 0 solid">
                <i class="fas fa-bars"></i>
            </button>
            <a class="nav-link" href="{{ route('home') }}">
                <img src="/images/petshop.png" style="max-height: 20px" alt="petShop">
            </a>
            <button class="navbar-toggler" data-toggle="collapse" style="border: 0 solid"
                    data-target="#navbarToggleExternalContent">
                <i class="fas fa-search"></i>
            </button>

        </div>
        <div class="row ml-auto">
            @guest
            <a class="nav-link" href="{{ route('login') }}">
                <i class="fas fa-user"></i>
            </a>
            <a class="nav-link" href="{{ route('register') }}">
                <i id="icon" class="fas fa-sign-in-alt "></i>
            </a>
            @endguest
                @auth
                    <form id="profile" action="{{ route('user.show', Auth::user()->id) }}" method="get">
                        @csrf
                        <a class="nav-link" href="javascript:{}" onclick="document.getElementById('profile').submit();">
                            <i class="fas fa-user-circle"></i>
                        </a>
                    </form>
                    <form id="logout_form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a class="nav-link" href="javascript:{}" onclick="document.getElementById('logout_form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </form>
            @endauth
            <a class="nav-link" href="{{ route('order.index') }}">
                <i class="fas fa-shopping-cart "></i>
                @if(session()->get('products') and count(session()->get('products'))>0)
                    <span class="badge badge-pill badge-danger">{{ count(session()->get('products')) }}</span>
                @endif
            </a>
        </div>
    </nav>
    <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark p-4">
            <div class="md-form active-pink active-pink-2 mb-3 mt-0">
                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
            </div>
        </div>
    </div>
</div>
