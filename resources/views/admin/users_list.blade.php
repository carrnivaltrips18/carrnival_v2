@extends('admin.layout.app')

@section('content')
<div class="container  p-4">
    <a href="{{ route('admin.dashboard') }}" class="bg-danger btn btn-sm m-1">Dashboard</a>
    <div class="card text-dark">
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
        @endif
        <div class="card-header bg-primary">
            <h3 class="text-center">User List</h3>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">password</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th>{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->password }}</td>
                            @if ($user->status == 1)
                            <td>
                                <a onclick="getData({{ $user->id }});" href="#"
                                    class="text-success">Active</a>

                            </td>
                        @endif
                        @if ($user->status == 0)
                            <td>
                                <a onclick="getData({{ $user->id }});"href="#" class="text-danger">Deactive</a>

                            </td>
                        @endif


                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

   <script>
            function getData(id) {
                if (confirm('Are you sure to status update')) {
                    $.ajax({
                        url: '{{ route('admin.status_active_deactive') }}',
                        type: 'get',
                        data: {
                            id: id
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            window.location.href = '{{ route('admin.users.list') }}';

                        }
                    });

                }


            }
        </script>

@endsection
