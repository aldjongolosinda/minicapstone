@extends('admin.dashboard') {{-- Assuming you have a layout file --}}

@section('content')
    <div class="container">
        <h2>Category Details</h2>

        <dl class="row">
            <dt class="col-sm-3">ID</dt>
            <dd class="col-sm-9">{{ $category->id }}</dd>

            <dt class="col-sm-3">Name</dt>
            <dd class="col-sm-9">{{ $category->name }}</dd>

            <dt class="col-sm-3">Description</dt>
            <dd class="col-sm-9">{{ $category->description }}</dd>

            <dt class="col-sm-3">Image</dt>
            <dd class="col-sm-9">
                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
            </dd>
        </dl>

        <a href="{{ route('categories.index') }}" class="btn btn-primary">Back to Categories</a>
    </div>
@endsection
