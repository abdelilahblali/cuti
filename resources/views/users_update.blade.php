@extends('master.theme')

@section('content')

<style type="text/css">
  .span_Manager { background:#0AA2A5; color:white; font-weight:bold; padding:5px 8px; border-radius:5px }
  .span_User { background:#0b54a3; color:white; font-weight:bold; padding:5px 8px; border-radius:5px }
</style>

@if(session()->has('yes')) <div class="col-md-12"><div class="alert alert-success">{{ session()->get('yes') }}</div></div> @endif
@if(session()->has('no')) <div class="col-md-12"><div class="alert alert-danger">{{ session()->get('no') }}</div></div> @endif

<div class="">
  <div class="">
    <div class="row">
      <div class="col-sm-12">
        <div class="home-tab">
          <div class="d-sm-flex align-items-center justify-content-between border-bottom">
            <div>
              <div class="btn-wrapper">
                <a href="{{ url('users') }}" class="btn btn-otline-dark align-items-center"><i class="mdi file "></i> List of users</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@foreach($users as $u)
<div class="col-lg-12 grid-margin stretch-card">

  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Departments</h4>

      <div class="row">
        <form method="POST" action="{{ route('users_updated', [ 'ref'=> $u->ref ]) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        
        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <label class="sr-only" for="category">Type <span class="span_required">*</span></label>
              <select class="form-control form-control-lg" name="category"  style="background: white !important; color: black !important;">
                <option>{{ $u->category }}</option>
                <option>Manager</option>
                <option>Staff</option>
              </select>
            </div>
            <div class="col-md-3">
              <label class="sr-only" for="department">Department <span class="span_required">*</span></label>
              <select class="form-control form-control-lg" name="department" style="background: white !important;color: black !important">
                <option></option>
                @foreach($departments as $d)
                <option value="{{ $d->ref }}" @if($u->department==$d->ref) selected @endif >{{ $d->title }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <label class="sr-only" for="position">Position <span class="span_required">*</span></label>
              <select class="form-control form-control-lg" name="position"  style="background: white !important;color: black !important">
                <option></option>
                @foreach($positions as $d)
                <option value="{{ $d->ref }}" @if($u->position==$d->ref) selected @endif >{{ $d->title }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <label class="sr-only" for="position">Manager <span class="span_required">*</span></label>
              <select class="form-control form-control-lg" name="manager" style="background: white !important;color: black !important">
                <option></option>
                @foreach($managers as $d)
                <option value="{{ $d->ref }}" @if($u->manager==$d->ref) selected @endif >{{ $d->civ }} {{ $d->nom }} {{ $d->pre }}</option>
                @endforeach
            </select>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-success btn-icon-text btn-md"><i class=" mdi mdi-plus  btn-refresh"></i>Update</button>
      </form>
      </div>

    </div>
  </div>
</div>
@endforeach

<script type="text/javascript">
  document.getElementById('code').select();
</script>

@endsection