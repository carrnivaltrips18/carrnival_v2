@extends('admin.layout.app')
@section('content')
<div class="container">
    <h1>Edit Header Content</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.header_content_update', $content->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $content->title) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ old('description', $content->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" name="type" id="type" class="form-control" value="{{ old('type', $content->type) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Header Content</button>
        <a href="{{ route('admin.header_content_list') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
