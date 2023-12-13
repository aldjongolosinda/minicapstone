@extends('admin.dashboard')
@section('content')
    <div class="container-fluid mt-3">
        <h2>Orders</h2>
        @if ($orders->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Instrument</th>
                        <th>Status</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->instrument->name }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->order_quantity }}</td>
                            <td>{{ $order->total_price }}</td>
                            <td>
                                @if($order->status  == "pending")
                                    <form action="{{ route('orders.edit', $order->id) }}" method="post" style="display: inline;">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-success btn-sm">Confirm</button>
                                    </form>
                                    @elseif ($order->status == "confirmed")
                                        <form action="{{ route('orders.receive', $order->id) }}" method="post" style="display: inline;" >
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-sm">Received</button>
                                        </form>
                                    @else
                                        <button class="btn btn-success btn-sm" disabled>Received</button>
                                @endif

                                <form action="{{ route('orders.delete', $order->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i></button>
                                </form>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No orders found.</p>
        @endif
    </div>
@endsection
