@extends('admin.dashboard') {{-- Assuming you have a layout file --}}

@section('content')
    <div class="container">
        <h2>Instrument Details</h2>

        <dl class="row">
            <dt class="col-sm-3">ID</dt>
            <dd class="col-sm-9">{{ $instrument->id }}</dd>

            <dt class="col-sm-3">Name</dt>
            <dd class="col-sm-9">{{ $instrument->name }}</dd>

            <dt class="col-sm-3">Description</dt>
            <dd class="col-sm-9">{{ $instrument->description }}</dd>

            <dt class="col-sm-3">Price</dt>
            <dd class="col-sm-9">${{ number_format($instrument->price, 2) }}</dd>

            <dt class="col-sm-3">Image</dt>
            <dd class="col-sm-9">
                <img src="{{ asset('storage/' . $instrument->image) }}" alt="{{ $instrument->name }}" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
            </dd>
        </dl>

        <a href="{{ route('instruments.index') }}" class="btn btn-primary">Back to Instruments</a>
    </div>
@endsection
