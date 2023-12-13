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
<div class="container mt-4">
    <h2 class="text-white">{{ $category->name }}</h2>
    {{-- @php
        dd($instruments);
    @endphp --}}
    @if ($instruments->isEmpty())
        <p class="text-white">Instruments will be added soon.</p>
        <button class="btn btn-primary" onclick="window.history.back()">Back</button>
    @else
    {{-- Modal form --}}
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Order</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
      </button> --}}

        <div class="container">
            <div class="row">
                    @foreach ($instruments as $instrument)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-3 mt-3">

                                <div class="card" style="width: 100%;">
                                    <form method="post" action="{{ route('orders.create', $instrument) }}">
                                        @csrf
                                        @if (!Auth::user())
                                            <input type="text" class="form-control" id="user_id" name="user_id" value="null" hidden>
                                        @else
                                            <input type="text" class="form-control" id="user_id" name="user_id" value="{{Auth::user()->id}}" hidden>
                                        @endif

                                        <input type="text" class="form-control" id="instrument_id" name="instrument_id" value="{{$instrument->id}}" hidden>
                                        <input type="number" class="form-control" id="order_quantity" value="{{old('order_quantity', 1)}}" name="order_quantity" min="1" hidden>
                                        <input type="number" class="form-control" id="total_price" name="total_price" value="{{$instrument->price}}" hidden>
                                        <input type="text" class="form-control" id="status" value="{{ old('status', 'pending') }}" name="status" hidden>



                                        <img src="{{ asset('storage/' . $instrument->image) }}" class="card-img-top p-2" alt="{{ $instrument->name }}" style="height:27rem;">
                                        <div class="card-body">
                                            <h5 class="card-title"><strong>{{ $instrument->name }}</strong></h5>
                                            <p class="card-text">$ {{ $instrument->price }}</p>

                                            @if ($instrument->instrument_quantity > 0)
                                                @if (!Auth::user())
                                                    <a href='/login' class="btn btn-primary">Buy</a>
                                                @else
                                                    <button type="submit" class="btn btn-primary">Buy</button>

                                                @endif
                                            @else
                                                <p class="text-secondary">Out of stock</p>
                                            @endif

                                        </div>
                                    </form>

                                </div>
                            </div>

                    @endforeach
            </div>

        </div>
    @endif
</div>


@endsection

{{-- <a href="{{ route('instruments.edit', $instrument->id) }}"></i></a> --}}
