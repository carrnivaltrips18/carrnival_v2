@extends('admin.layout.app')

@section('content')
<div class="container">
    <h1>Master Settings</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.master_setting') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $details->id ?? '' }}">

        <div class="row m-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="company_title">Company Title</label>
                    <input type="text" name="company_title" class="form-control" value="{{ old('company_title', $details->company_title ?? '') }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $details->phone ?? '') }}">
                </div>
            </div>
        </div>

        <div class="row m-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $details->email ?? '') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea name="address" class="form-control">{{ old('address', $details->address ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="row m-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control">{{ old('description', $details->description ?? '') }}</textarea>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="url" name="facebook" class="form-control" value="{{ old('facebook', $details->facebook ?? '') }}">
                </div>
            </div>
        </div>

        <div class="row m-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="instagram">Instagram</label>
                    <input type="url" name="instagram" class="form-control" value="{{ old('instagram', $details->instagram ?? '') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="youtube">YouTube</label>
                    <input type="url" name="youtube" class="form-control" value="{{ old('youtube', $details->youtube ?? '') }}">
                </div>
            </div>
        </div>

        <div class="row m-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="linkdn">LinkedIn</label>
                    <input type="url" name="linkdn" class="form-control" value="{{ old('linkdn', $details->linkdn ?? '') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="compnay_link">Company Link</label>
                    <input type="url" name="compnay_link" class="form-control" value="{{ old('compnay_link', $details->compnay_link ?? '') }}">
                </div>
            </div>
        </div>

        <div class="row m-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="logo">Logo</label>
                    <input type="file" name="logo" class="form-control-file">
                    @if(isset($details) && $details->logo)
                        <img src="{{ asset('logo/' . $details->logo) }}" alt="Logo" class="img-thumbnail" width="150">
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="fav_icon">Favicon</label>
                    <input type="file" name="fav_icon" class="form-control-file">
                    @if(isset($details) && $details->fav_icon)
                        <img src="{{ asset('fav_icon/' . $details->fav_icon) }}" alt="Favicon" class="img-thumbnail" width="50">
                    @endif
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>
</div>
@endsection
