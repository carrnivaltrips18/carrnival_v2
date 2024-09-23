@extends('admin.layout.app')
@section('content')
    <div class="container bg-secondary p-4">
        <a href="dashboard" class="bg-danger btn btn-sm m-1">Go To Dashboard</a>
        <div class="card text-dark">
            <div class="card-header bg-primary">
                <h3 class="text-center">Notification List</h3>
            </div>
            <p>Total Notifications: {{ $notifications->count() }}</p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sender ID</th>
                        <th scope="col">Receiver ID</th>
                        <th scope="col">Header</th>
                        <th scope="col">Description</th>
                        <th scope="col">Read Flag</th>
                        <th scope="col">Time</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($notifications->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">No notifications available.</td>
                        </tr>
                    @else
                        @foreach ($notifications as $notification)
                            <tr>
                                <th>{{ $notification->id }}</th>
                                <th>{{ $notification->sender_id }}</th>
                                <th>{{ $notification->receiver_id }}</th>
                                <td>{{ $notification->header }}</td>
                                <td>{{ $notification->description }}</td>
                                <td>{{ $notification->read_flag }}</td>
                                <td>{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
