@extends('master.theme')

@section('content')

@if(session()->has('yes')) <div class="col-md-12"><div class="alert alert-success">{{ session()->get('yes') }}</div></div> @endif
@if(session()->has('no')) <div class="col-md-12"><div class="alert alert-danger">{{ session()->get('no') }}</div></div> @endif

@foreach($resign as $item)
<div class="col-md-12 grid-margin stretch-card formular">
  <div class="card">
    <div class="card-body">
        <h4 class="card-title">
          Show & Edit  
          @if($item->act==0)<label class="badge badge-warning" style="float:right">Pending</label>@endif
          @if($item->act==1)<label class="badge badge-success" style="float:right">Enabled</label>@endif
          @if($item->act==-1)<label class="badge badge-danger" style="float:right">Disabled</label>@endif
        </h4>
        <form method="POST" action="{{ route('resign_edited', [ 'ref' => $item->ref ]) }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label class="sr-only" for="reason">Reason <span class="span_required">*</span></label>
              <select class="form-control form-control-lg" name="reason" id="reason" required>
                <option>{{$item->reason}}</option>
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
              <input type="date" class="form-control form-control-lg" name="date" id="date" value="{{ date('Y-m-d', strtotime($item->date)) }}" min="<?php echo $mindate;?>" required>
            </div>
            <div class="col-md-6">
              <label class="sr-only" for="attach">Attachment </label>
                  @if($item->attach!='') 
                    <a target="_blank" href="https://hr.magnitudeconstruction.com/media/resign/{{ $item->attach }}"> View </a> |
                    <a href="{{ route('resign_attach_deleted',[  'ref' => $item->ref ]) }}" style="color: red">Delete</a>
                  @endif
                  @if($item->attach=='') <input type="file" class="form-control form-control-lg" name="attach[]" id="attach"> @else <input type="file" class="form-control form-control-lg" name="attach[]" id="attach" disabled> @endif
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label class="sr-only" for="description">Description <span class="span_required">*</span></label>
              <textarea class="form-control form-control-lg" name="description" id="description" style="min-height: 150px;" required>{{$item->description}}</textarea>
            </div>
          </div>
        </div>
        
        @if($item->act==0)
        <button type="submit" class="btn btn-success btn-icon-text btn-md"><i class=" mdi mdi-refresh  btn-icon-prepend"></i>Update</button>
        @endif
      </form>
    </div>
  </div>
</div>
@endforeach

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