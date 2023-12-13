
<div class="container">
    <h2>Create Order</h2>
    <form method="post" action="{{ route('orders.store', $instrument) }}">
        @csrf
        <div class="form-group">
            <label for="user_id">User ID:</label>
            <input type="text" class="form-control" id="user_id" name="user_id" value="{{Auth::user()->id}}" hidden>
        </div>
        <div class="form-group">
            <label for="order_quantity">Order Quantity:</label>
            <input type="number" class="form-control" id="order_quantity" value="{{old('order_quantity', 1)}}" name="order_quantity" min="1" hidden>
        </div>
        <div class="form-group">
            <label for="total_price">Total Price:</label>
            <input type="number" class="form-control" id="total_price" name="total_price" value="{{old('order_quantity', 1)}}" hidden>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <input type="text" class="form-control" id="status" name="status" hidden>
        </div>
        <button type="submit" class="btn btn-primary">Create Order</button>
    </form>
</div>
