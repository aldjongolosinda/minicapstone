@extends('landing')
@section('content')
    @if (session('message'))
        <div class="row justify-content-center">
            <div class="col-lg-4 alert alert-success mt-3 text-center">{{ session('message') }} <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button></div>
        </div>
    @endif

    @if (session('error'))
        <div class="row justify-content-center">
            <div class="col-lg-5 alert alert-danger mt-3 text-center">{{ session('error') }} <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button></div>
        </div>
    @endif
    <div class="container">
        <h2 class="text-white mt-3">My orders</h2>
        @if ($orders->count() > 0)
            <table class="table table-striped bg-light">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{$order->instrument->name}}</td>
                                <td>${{ number_format($order->total_price, 2) }}</td>
                                <td>{{ $order->status }}</td>
                                <td>
                                    @if ($order->status == 'pending')
                                        <form action="{{ route('orders.delete', $order->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to cancel order?')">Cancel</button>
                                        </form>


                                        <form action="{{ route('orders.edit', $order->id) }}" method="post" style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-sm">Checkout</button>
                                        </form>
                                    @elseif($order->status == "confirmed")
                                        <button class="btn btn-primary btn-sm" disabled>To ship</button>
                                    @else
                                        <button class="btn btn-primary btn-sm" disabled>Received </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
        @else
            <p class="text-white">No orders yet.</p>
        @endif
    </div>
@endsection
