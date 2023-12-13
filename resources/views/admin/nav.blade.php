<nav class="navbar bg-dark border-bottom border-body">
    <div class="container-fluid my-2">
      <a class="navbar-brand text-white">Welcome, <strong> {{ Auth::user()->name }} </strong></a>

      <div class="dropdown me-3">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            {{-- <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle"> --}}
            <i class="fa-regular fa-user fa-lg m-2"></i>

            <span class="d-none d-sm-inline mx-1">{{ Auth::user()->name }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <li><button class="dropdown-item" type="submit" href="#">Sign out</button></li>
            </form>
        </ul>
    </div>
    </div>
</nav>
