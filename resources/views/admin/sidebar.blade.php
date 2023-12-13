<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline mt-3 fs-3 fw-bold ms-4">Instrument Shop</span>
        </a>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start mt-3 ms-3" id="menu">
            <li class="mt-2">
                <a href="/dashboard" class="nav-link px-0 align-middle">
                    <i class="fa-solid fa-gauge fa-lg"></i> <span class="ms-2 d-none d-sm-inline fs-5">Dashboard</span></a>
            </li>
            <li class="mt-2">
                <a href="/categories" class="nav-link px-0 align-middle">
                    <i class="fa-solid fa-bars fa-lg"></i> <span class="ms-2 d-none d-sm-inline fs-5">Categories</span></a>
            </li>
            <li class="mt-2">
                <a href="/instruments" class="nav-link px-0 align-middle">
                    <i class="fa-solid fa-guitar fa-lg"></i> <span class="ms-2 d-none d-sm-inline fs-5">Instruments</span></a>
            </li>
            <li class="mt-2">
                <a href="/all-orders" class="nav-link px-0 align-middle">
                    <i class="fa-solid fa-cart-shopping fa-lg"></i> <span class="ms-2 d-none d-sm-inline fs-5">Orders</span></a>
            </li>
            <li class="mt-2">
                <a href="/logs" class="nav-link px-0 align-middle">
                    <i class="fa-solid fa-list fa-lg"></i> <span class="ms-2 d-none d-sm-inline fs-5">Logs</span></a>
            </li>
            <li class="mt-2">
                <a href="/users" class="nav-link px-0 align-middle">
                    <i class="fa-solid fa-user fa-lg"></i> <span class="ms-2 d-none d-sm-inline fs-5">Users</span></a>
            </li>



        </ul>
        <hr>
        <div class="dropdown pb-4">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle ms-2" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                {{-- <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle"> --}}
                <span class="d-none d-sm-inline mx-1">{{Auth::user()->name}}</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        @csrf
                        <li><button class="dropdown-item" type="submit">Sign out</button></li>
                </ul>
            </form>
        </div>
    </div>
</div>

