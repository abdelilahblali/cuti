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
                <a href="{{ url('positions_add') }}" class="btn btn-otline-dark align-items-center"><i class="mdi mdi-plus "></i> Add new position</a>
                <a href="{{ url('positions') }}" class="btn btn-otline-dark align-items-center"><i class="mdi mdi-file "></i> List of positions</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@foreach($positions as $item)
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">positions</h4>

      <div class="row">
        <form method="POST" action="{{ route('positions_edited',[ 'ref' => $item->ref ]) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label class="sr-only" for="code">Code <span class="span_required">*</span></label>
              <input type="text" class="form-control form-control-lg" name="code" id="code" required value="{{ $item->code }}">
            </div>
            <div class="col-md-6">
              <label class="sr-only" for="title">Title <span class="span_required">*</span></label>
              <input type="text" class="form-control form-control-lg" name="title" id="title" required value="{{ $item->title }}">
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-success btn-icon-text btn-md"><i class=" mdi mdi-refresh  btn-icon-prepend"></i>Update</button>
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