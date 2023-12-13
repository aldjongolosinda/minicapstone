@extends('admin.dashboard') {{-- Assuming you have a layout file --}}

@section('content')
    <div class="container my-3">
        <h2>Edit Instrument</h2>

        <form action="{{ route('instruments.update', $instrument->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $instrument->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="instrument_quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="instrument_quantity" name="instrument_quantity" value="{{ old('instrument_quantity', $instrument->instrument_quantity) }}" min="1" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    {{-- <option selected>{{$instrument->category->name}}</option> --}}
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $instrument->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $instrument->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $instrument->price) }}" min="0.01" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            @if ($instrument->image)
                <div class="mb-3">
                    <label>Current Image</label>
                    <img src="{{ asset('storage/' . $instrument->image) }}" alt="{{ $instrument->name }}" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                </div>
            @endif

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
