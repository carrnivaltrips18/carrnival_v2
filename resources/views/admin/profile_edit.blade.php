@extends('admin.layout.app')

@section('content')

<h3>Edit Admin Profile</h3>
<div class="card p-4 pt-0 w-75 text-dark" style="margin-left: 7rem">
    <form action="{{ route('admin.update', $admin->id) }}" method="post">
        @csrf
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $admin->first_name) }}" placeholder="Enter first name" required>
            @error('first_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $admin->last_name) }}" placeholder="Enter last name" required>
            @error('last_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $admin->email) }}" placeholder="Enter email" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-sm">Update</button>
        </div>
    </form>
</div>

@endsection
