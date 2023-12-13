@extends('admin.dashboard') {{-- Assuming you have a layout file --}}

@section('content')
    <div class="container-fluid mt-3">
        <h2>Categories</h2>

        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-2 float-end mx-3">Create Category</a>

        @if ($categories->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                            </td>
                            <td>
                                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline;">
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
            <p>No categories found.</p>
        @endif
    </div>
@endsection
