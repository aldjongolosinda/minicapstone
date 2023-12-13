@extends('admin.dashboard') {{-- Assuming you have a layout file --}}

@section('content')
    <div class="container">
        <h2>{{ isset($category) ? 'Edit' : 'Create' }} Category</h2>

        @if (isset($category))
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
        @else
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @endif
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', isset($category) ? $category->name : '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', isset($category) ? $category->description : '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                @if (isset($category) && $category->image)
                    <div class="mb-3">
                        <label>Current Image</label>
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                    </div>
                @endif

                <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Update' : 'Create' }}</button>
            </form>
    </div>
@endsection
