<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container my-3">
      <a class="navbar-brand" href="/">SHop</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link text-white" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="/about"><span>About</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="/contact">Contact</a>
          </li>
            @if (!Auth::check())
                <li class="nav-item">
                    <a class="nav-link text-white" href="/login">Sign In</a>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{Auth::user()->name}}
                    </a>
                    <ul class="dropdown-menu">
                        @if (Auth::user()->is_admin)
                            <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                        @endif
                            <li><a class="dropdown-item" href="{{route('orders.user', Auth::user()->id) }}">My Orders
                                @if(Auth::user()->orders->count() > 0)
                                    ({{Auth::user()->orders->count()}})
                                @endif
                                </a>
                            </li>

                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fa fa-sign-out me-2" aria-hidden="true"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            @endif

        </ul>
      </div>
    </div>
</nav>

<style>
    .navbar {
        /* background: transparent; */
        /* position: fixed;
        top: 0;
        left: 0;
        right: 0; */
    }
    .nav-item{
        padding: 0px 10px 0px 10px;
        font-size: 1.1rem;
        border-radius: 18px;
    }

    li:hover{
        background-color: rgb(59, 59, 255);
        transition: all 0.5s ease;

    }

</style>
