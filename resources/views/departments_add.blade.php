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
                <a href="{{ url('departments_add') }}" class="btn btn-otline-dark align-items-center"><i class="mdi mdi-plus "></i> Add new department</a>
                <a href="{{ url('departments') }}" class="btn btn-otline-dark align-items-center"><i class="mdi mdi-file "></i> List of departments</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="col-lg-12 grid-margin stretch-card">


  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Departments</h4>

      <div class="row">
        <form method="POST" action="{{ route('departments_added') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label class="sr-only" for="code">Code <span class="span_required">*</span></label>
              <input type="text" class="form-control form-control-lg" name="code" id="code" required value="{{ $code }}">
            </div>
            <div class="col-md-6">
              <label class="sr-only" for="title">Title <span class="span_required">*</span></label>
              <input type="text" class="form-control form-control-lg" name="title" id="title" required>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-success btn-icon-text btn-md"><i class=" mdi mdi-plus  btn-icon-prepend"></i>Add</button>
      </form>
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
  document.getElementById('title').select();
</script>

@endsection