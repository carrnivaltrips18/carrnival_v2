@extends('admin.layout.app')

@section('content')
<div class="container p-4">
    <h1 class="text-center">Social Media List</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Link</th>
                <th>svg_icon</th>
                <th>Logo</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($socialmedias as $socialmedia)
                <tr>
                    <td>{{ $socialmedia->id }}</td>
                    <td>{{ $socialmedia->name }}</td>
                    <td>{{ $socialmedia->link }}</td>
                    <td>
                        <div style="height: 50px">
                            {!! $socialmedia->svg_icon !!}
                        </div>
                    </td>
                    {{-- <td>{{ $socialmedia->logo_path }}</td> --}}
                    <td>
                        @if($socialmedia->logo_path) <!-- Check if logo_path exists -->
                            <img src="{{ asset($socialmedia->logo_path) }}" style="width: 50px; height: auto;">
                        @else
                            No Logo
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.socialmedia_list.toggleStatus', $socialmedia->id) }}" method="POST"> 
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $socialmedia->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                {{ $socialmedia->status == 1 ? 'Active' : 'Inactive' }}
                            </button>
                        </form>

                        <div class="outerDivFull" >
                            <div class="switchToggle">
                                <input type="checkbox" id="switch">
                                <label for="switch">Toggle</label>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="flex">
                            <a href="{{ route('admin.socialmedia_edit', $socialmedia->id) }}" class="btn btn-warning btn-xs mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#fff"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                            </a>
                            <form action="{{ route('admin.socialmedia_delete', $socialmedia->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE') <!-- This simulates a DELETE request -->
                                <button type="submit" class="btn btn-danger btn-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#fff"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
