@extends('master.theme')

@section('content')

<style type="text/css">
  .span_required { color:red  }
</style>

@if(session()->has('yes')) <div class="col-md-12"><div class="alert alert-success">{{ session()->get('yes') }}</div></div> @endif
@if(session()->has('no')) <div class="col-md-12"><div class="alert alert-danger">{{ session()->get('no') }}</div></div> @endif

<div class="col-md-12 grid-margin stretch-card formular">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Add new freelance request</h4>
        <form method="POST" action="{{ route('freelance_added') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        
        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <label class="sr-only" for="from_date">Date <span class="span_required">*</span></label>
              <input type="date" class="form-control form-control-lg" name="from_date" id="from_date" required>
            </div>
            <div class="col-md-4">
              <label class="sr-only" for="from_time">From (Time) <span class="span_required">*</span></label>
              <input type="time" class="form-control form-control-lg" name="from_time" id="from_time" required>
            </div>
            <div class="col-md-4">
              <label class="sr-only" for="to_time">To (Time) <span class="span_required">*</span></label>
              <input type="time" class="form-control form-control-lg" name="to_time" id="to_time" required>
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <label class="sr-only" for="note">Note</label>
          <textarea class="form-control form-control-lg" name="note" style="min-height: 300px;"></textarea>
        </div>
        <button type="submit" class="btn btn-success btn-icon-text btn-md"><i class=" mdi mdi-plus  btn-icon-prepend"></i>Add</button>
      </form>
    </div>
  </div>
</div>

@endsection