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
      <h4 class="card-title">Add resignation form</h4>
        <form method="POST" action="{{ route('resign_added') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label class="sr-only" for="reason">Reason <span class="span_required">*</span></label>
              <select class="form-control form-control-lg" name="reason" id="reason" required>
                <option></option>
                <option>For Better Paying Job</option>
                <option>Retirement</option>
                <option>Health</option>
                <option>Relocation</option>
                <option>Commuting Problems</option>
                <option>Continue My Education</option>
                <option>Other</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="sr-only" for="other">Reason (Other)</label>
              <input type="text" class="form-control form-control-lg" name="other" id="other" disabled>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label class="sr-only" for="date">Effective Resign (Date) <span class="span_required">*</span></label>
              <?php 
                $today = date("Y/m/d");
                $mindate = date('Y-m-d', strtotime("+1 month", strtotime($today))); ?>
              <input type="date" class="form-control form-control-lg" name="date" id="date" min="<?php echo $mindate;?>"  required>
            </div>
            <div class="col-md-6">
              <label class="sr-only" for="attach">Attachment  <span class="span_required">*</span></label>
              <input type="file" class="form-control form-control-lg" name="attach[]" id="attach" required>
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label class="sr-only" for="description">Description <span class="span_required">*</span></label>
              <textarea class="form-control form-control-lg" name="description" id="description" style="min-height: 150px;" required></textarea>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-success btn-icon-text btn-md"><i class=" mdi mdi-plus  btn-icon-prepend"></i>Add</button>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  $('#reason').on('change', function() {
    if(this.value=='Other') {
      $( "#other" ).prop( "disabled", false );
      alert('Please specify your reason in Reason (Other) column!');
    }else {
      $('#other').val(''); $( "#other" ).prop( "disabled", true );
    }
  });
  $('#attach').on('click', function() {
    alert('Please upload format zip file if you have more than one attachment!');
  });
</script>

@endsection