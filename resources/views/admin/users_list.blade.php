@extends('admin.layout.app')
@section('content')

<?php use Carbon\Carbon; ?>

<style>
    .row {
        display: flex;
        justify-content: center;
    }
</style>

<div class="row m-4">
    <div class="col-12">
        <div>
            <h5 class="mt-4">Upload CSV</h5>
            <form action="{{ route('admin.users.upload_csv') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" name="file" class="form-control-file" required>
                    @error('file')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
        <div class="card">
            <div class="card-header">
                {{-- <a href="{{ route('admin.users.csv') }}" class="bg-danger btn btn-sm m-1">Download</a> --}}
                <a href="{{ route('admin.users.csv') }}" class="btn btn-success">Download CSV</a>
                <div class="card-tools">
                    <form method="GET" action="{{ route('admin.users.list') }}">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->

            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th>{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->status == 1)
                                        <a onclick="getData({{ $user->id }});" href="#" class="text-success">Active</a>
                                    @else
                                        <a onclick="getData({{ $user->id }});" href="#" class="text-danger">Deactive</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->

            <!-- Pagination Links -->
            <div class="card-footer clearfix">
                {{ $users->links() }} <!-- Display pagination links -->
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>

<script>
    function getData(id) {
        if (confirm('Are you sure you want to update the status?')) {
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
