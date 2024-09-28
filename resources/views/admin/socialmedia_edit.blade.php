@extends('admin.layout.app')

@section('content')
<div class="container">
    <h1>Edit Social Media</h1>

    <form action="{{ route('admin.socialmedia_update', $socialMedia->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Simulate PUT request for update -->

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $socialMedia->name) }}" placeholder="Enter name" required>
        </div>

        <div class="form-group">
            <label for="link">Link</label>
            <input type="url" class="form-control" name="link" id="link" value="{{ old('link', $socialMedia->link) }}" placeholder="Enter URL" required>
        </div>

        <div class="form-group">
            <label for="svg_icon">SVG Icon</label>
            <input type="text" class="form-control" name="svg_icon" id="svg_icon" value="{{ old('svg_icon', $socialMedia->svg_icon) }}" placeholder="Enter SVG Icon">
        </div>

        <div class="form-group">
            <label for="logo">Logo Image</label>
            <input type="file" class="form-control" name="logo_path" id="logo_path">
            <small class="form-text text-muted">Leave empty to keep the current logo.</small>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('admin.socialmedia_list') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
