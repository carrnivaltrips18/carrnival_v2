<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>User </b>Register</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="input-group mb-3">
          {{-- <input type="text" class="form-control" placeholder="Full name"> --}}
          <input id="Full name" type="text" name="name" class="form-control" value="{{ old('name') }}" required  placeholder="Full name"/>
          @if ($errors->has('name'))
          <div class="text-danger mt-2">
              {{ $errors->first('name') }}
          </div>
            @endif
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          {{-- <input type="email" class="form-control" placeholder="Email"> --}}
          <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required placeholder="Email" />
          @if ($errors->get('email'))
              <div class="text-danger mt-2">
                  @foreach ($errors->get('email') as $message)
                      <p>{{ $message }}</p>
                  @endforeach
              </div>
          @endif
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          {{-- <input type="password" class="form-control" placeholder="Password"> --}}
          <input id="password" class="form-control" type="password" name="password" required placeholder="Password" />
    @if ($errors->get('password'))
        <div class="text-danger mt-2">
            @foreach ($errors->get('password') as $message)
                <p>{{ $message }}</p>
            @endforeach
        </div>
    @endif
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          {{-- <input type="password" class="form-control" placeholder="Retype password"> --}}
          <input id="password_confirmation" class="form-control " type="password" name="password_confirmation" required  placeholder="Retype password" />
        @if ($errors->get('password_confirmation'))
       <div class="text-danger mt-2">
           @foreach ($errors->get('password_confirmation') as $message)
               <p>{{ $message }}</p>
           @endforeach
       </div>
       @endif
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
                <input type="checkbox" id="agreeTerms" class="form-check-input" name="terms" value="agree">
              <label for="agreeTerms" class="form-check-label text-muted">
                {{ __('') }} I agree to the <a href="#">terms </a>
               </label>
              {{-- <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label> --}}
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="{{route('login')}}" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
