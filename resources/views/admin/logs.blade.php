@extends('admin.dashboard')
@section('content')
<h3 class="m-4">Logs</h3>
<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                {{-- <th>Medicine ID</th> --}}
                <th>Timestamp</th>
                <th>Log Entry</th>

            </tr>
        </thead>
        <tbody>
            @forelse ($logEntries as $logEntry)
                <tr>
                    <td>{{ $logEntry->formattedCreatedAt }}</td>
                    <td>{{ $logEntry->log_entry }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">
                        <h5 class="text-center">No logs yet.</h5>
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>
</div>


@endsection
