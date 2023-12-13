@extends('admin.dashboard')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow-lg text-center">
                <div class="card-body">
                    <i class="fa-solid fa-users fs-1"></i>
                    <h3>Users</h3>
                    <div class="card-text">
                        <h4>
                            {{ $users->count() }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-lg text-center">
                <div class="card-body">
                    <i class="fa-solid fa-bars fs-1"></i>
                    <h3>Categories</h3>
                    <div class="card-text">
                        <h4>
                            {{ $categories->count() }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-5">
            <div class="card shadow-lg text-center">
                <div class="card-body">
                    <i class="fa-solid fa-guitar fs-1"></i>
                    <h3>Instruments</h3>
                    <div class="card-text">
                        <h4>
                            {{ $instruments->count() }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-lg text-center">
                <div class="card-body">
                    <i class="fa-solid fa-cart-shopping fs-1"></i>
                    <h3>Orders</h3>
                    <div class="card-text">
                        <h4>
                            {{ $orders->count() }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-lg text-center">
                <div class="card-body">
                    <i class="fa-solid fa-list fs-1"></i>
                    <h3>Logs</h3>
                    <div class="card-text">
                        <h4>
                            {{ $logs->count() }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>

@endsection
