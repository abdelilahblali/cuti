@extends('master.theme')

@section('content')

@if(session()->has('yes')) <div class="col-md-12"><div class="alert alert-success">{{ session()->get('yes') }}</div></div> @endif
@if(session()->has('no')) <div class="col-md-12"><div class="alert alert-danger">{{ session()->get('no') }}</div></div> @endif

<div class="col-md-12 grid-margin stretch-card formular">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Change My Password</h4>
        <form method="POST" action="{{ route('user_password_updated') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
          <label class="sr-only" for="username">Email</label>
          <input type="text" class="form-control form-control-lg" name="username"  required>
        </div>
        <div class="form-group">
          <label class="sr-only" for="password">New Password</label>
          <input type="password" class="form-control form-control-lg" name="password"  required>
        </div>
        <div class="form-group">
          <label class="sr-only" for="password2">Confirmation</label>
          <input type="password" class="form-control form-control-lg" name="password2"  required>
        </div>
        <button type="submit" class="btn btn-success btn-icon-text btn-md"><i class=" mdi mdi-content-save-all  btn-icon-prepend"></i>Update</button>
      </form>
    </div>
  </div>
</div>

@endsection