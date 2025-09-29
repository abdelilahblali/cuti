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
      <h4 class="card-title">Add request new staff</h4>
        <form method="POST" action="{{route('recruitment_added')}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <label class="sr-only" for="type">Type <span class="span_required">*</span></label>
              <select class="form-control form-control-lg" name="type" id="type" required>
                <option></option>
                <option>Full Time</option>
                <option>Part Time</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="sr-only" for="hire">Hire Reason <span class="span_required">*</span></label>
              <select class="form-control form-control-lg" name="hire" id="hire" required>
                <option></option>
                <option>New</option>
                <option>Replacing</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="sr-only" for="replacing">Replacing (name) </label>
              <input type="text" class="form-control form-control-lg" name="replacing" id="replacing" disabled>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label class="sr-only" for="reason">Reason<span class="span_required">*</span></label>
              <textarea class="form-control form-control-lg" name="reason" id="reason" style="min-height: 150px;"></textarea>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label class="sr-only" for="title">Title <span class="span_required">*</span></label>
              <input type="text" class="form-control form-control-lg" name="title" id="title" required>
            </div>
            <div class="col-md-6">
              <label class="sr-only" for="salary">Salary Range </label>
              <input type="text" class="form-control form-control-lg" name="salary" id="salary">
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label class="sr-only" for="description">Position Description <span class="span_required">*</span></label>
              <textarea class="form-control form-control-lg" name="description" id="description" style="min-height: 150px;" required></textarea>
            </div>
            <div class="col-md-6">
              <label class="sr-only" for="duties">Duties <span class="span_required">*</span></label>
              <textarea class="form-control form-control-lg" name="duties" id="duties" style="min-height: 150px;" required></textarea>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <label class="sr-only" for="requirement">Requirements (ie. Research funds, other funding) <span class="span_required">*</span></label>
              <textarea class="form-control form-control-lg" name="requirement" id="requirement" style="min-height: 150px;" required></textarea>
            </div>
            <div class="col-md-4">
              <label class="sr-only" for="equipment">Equipments (ie. furniture,phone) <span class="span_required">*</span></label>
              <textarea class="form-control form-control-lg" name="equipment" id="equipment" style="min-height: 150px;" required></textarea>
            </div>
            <div class="col-md-4">
              <label class="sr-only" for="additional">Additional Requirement <span class="span_required">*</span></label>
              <textarea class="form-control form-control-lg" name="additional" id="additional" style="min-height: 150px;" required></textarea>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-success btn-icon-text btn-md"><i class=" mdi mdi-plus  btn-icon-prepend"></i>Add</button>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  $('#hire').on('change', function() {
    if(this.value=='Replacing') {
      $( "#replacing" ).prop( "disabled", false );
    }else {
      $( "#replacing" ).prop( "disabled", true );
    }
  });
</script>

@endsection