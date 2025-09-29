<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-15" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="" />
    <title>Magnitude | Cuti Management</title>
    <link href="{{ url('imgs/logo.png') }}" rel="icon">
    <link rel="stylesheet" type="text/css" href="{{ url('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('bootstrap/fonts/font-awesome.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Changa&amp;display=swap" rel="stylesheet">
</head>
<body style="background: rgba(0,0,0,0.1);">

<section id="hero" class="">
<div class="container">
    <div class="row justify-content-center">
        <div class="">
            <div class="form-login">
              <div class="title-section" style="text-align: center; margin-bottom: 40px; margin-top: 0px">
                <h4>Magnitude | Cuti Management</h4>
                <a href="{{ route('home') }}"><img src="{{ url('imgs/logo.png') }}" style="width: 100%; margin-top: 16px"></a>
              </div>
              
              <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label text-md-right">Please enter the email address</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                            <div class="col-md-4" style="text-align: right;">
                                  <a href="{{ route('login') }}">Login</a>
                              </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>


  <script type="text/javascript" src="{{ url('bootstrap/js/bootstrap.min.js') }}"></script>

</body>
</html>
