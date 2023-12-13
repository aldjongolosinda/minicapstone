@extends('admin.dashboard') {{-- Assuming you have a layout file --}}

@section('content')
    <div class="container-fluid mt-3">
        <h2>Instruments</h2>

        <a href="{{ route('instruments.create') }}" class="btn btn-primary mb-2 me-3 float-end">Add Instrument</a>

        @if ($instruments->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($instruments as $instrument)
                        <tr>
                            <td class="col-sm-1">{{ $instrument->id }}</td>
                            <td class="col-sm-2">{{ $instrument->name }}</td>
                            <td class="col-sm-1">{{ $instrument->instrument_quantity }}</td>
                            <td class="col-sm-1">{{ $instrument->category->name }}</td>
                            <td class="col-sm-2">{{ $instrument->description }}</td>
                            <td class="col-sm-1">${{ number_format($instrument->price, 2) }}</td>
                            <td class="col-sm-2">
                                <img src="{{ asset('storage/' . $instrument->image) }}" alt="{{ $instrument->name }}" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                            </td>
                            <td class="col-sm-1">
                                <a href="{{ route('instruments.show', $instrument->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('instruments.edit', $instrument->id) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('instruments.destroy', $instrument->id) }}" method="POST" style="display: inline;">
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
            <p>No instruments found.</p>
        @endif
    </div>
@endsection
