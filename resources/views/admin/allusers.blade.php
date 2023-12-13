@extends('admin.dashboard')
@section('content')
<div class="container-fluid">
    <h3 class="my-3">Users</h3>
    @if ($users->count() > 0)
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                            @foreach ($user->roles as $role)
                                @if ($role->id === 1)
                                    <span class="badge rounded-pill text-bg-primary">Admin</span>
                                @break

                            @else
                                <span class="badge rounded-pill text-bg-warning">User</span>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @if ($user->email_verified_at != null)
                            <span class="badge rounded-pill text-bg-info">VERIFIED</span>
                        @else
                            <span class="badge rounded-pill text-bg-danger">NOT VERIFIED</span>
                        @endif
                    </td>
                    {{-- <td>
                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></a>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No categories found.</p>
    @endif
</div>



@endsection
