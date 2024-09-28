@extends('admin.layout.app')
@section('content')
    <div class="container p-4">
        <div class="card bg-primary mb-0 text-center w-75" style="margin-left: 7rem;">
            <h3>Social Media</h3>
        </div>
        <div class="card p-3 w-75 text-dark" style="margin-left: 7rem;">
            <form action="{{Route('admin.socialmedia') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Name">Name (optional)</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="short_desc">Link *</label>
                        <input type="text" class="form-control" name="link" id="link" placeholder="Enter Link">
                    </div>
                    
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="short_desc">Svg_icon (optional)</label>
                        <input type="text" class="form-control" name="svg_icon" id="svg_icon" placeholder="Enter Svg_icon">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Logo (optional)</label>
                        <input type="file" class="form-control" name="logo_path" id="logo_path" >
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
                
            </form>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ url('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ url('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ url('dist/js/demo.js') }}"></script>
@endsection
