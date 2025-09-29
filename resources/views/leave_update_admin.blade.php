<?php use \App\Http\Controllers\Admin; ?>
@extends('master.theme')

@section('content')

@if(session()->has('yes')) <div class="col-md-12"><div class="alert alert-success">{{ session()->get('yes') }}</div></div> @endif
@if(session()->has('no')) <div class="col-md-12"><div class="alert alert-danger">{{ session()->get('no') }}</div></div> @endif

@foreach($leaves as $item)
<div class="col-md-12 grid-margin stretch-card formular">
  <div class="card">
    <div class="card-body">
        <h4 class="card-title">
          Show & Edit The leave for :  <span style="background: #e5e5e5; padding: 5px 10px; border-radius: 5px">{{ $cli }}</span>
          @if($item->act==0)<label class="badge badge-warning" style="float:right">Pending</label>@endif
          @if($item->act==1)<label class="badge badge-success" style="float:right">Enabled</label>@endif
          @if($item->act==-1)<label class="badge badge-danger" style="float:right">Disabled</label>@endif
        </h4>
        <h4 class="card-title">
          <?php $months = array( 1=>"Jan" , 2=>"Feb" , 3=>"Mar" , 4=>"Apr" , 5=>"May" , 6=>"June" , 7=>"July" , 8=>"Aug" , 9=>"Sept" , 10=>"Oct" , 11=>"Nov" , 12=>"Dec" ); $year = date('Y'); $sum=0;?>
          @for($i=1; $i<=12; $i++)
            <?php $sum = $sum + Admin::calc_nb_leaves_byUser($i, $year, $item->cli);  $total = 31-$sum;?>
          @endfor 
          <label class="badge badge-warning">Leaves Available : {{$total}} @if($total>1) Days @else Day @endif</label>
        </h4>
        <form method="POST" action="{{ route('leave_updated_admin', [ 'ref' => $item->ref ]) }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label class="sr-only" for="raison">Raison <span class="span_required">*</span></label>
              <select class="form-control form-control-lg" name="raison" id="raison" required>
                <option>{{ $item->raison }}</option>
                <option>Holiday</option>
                <option>Disease</option>
                <option>Ceremony</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="sr-only" for="halfday">Half Day</label>
              <select class="form-control form-control-lg" name="halfday" id="halfday">
                <option>{{ $item->halfday }}</option>
                <option>NO</option>
                <option>YES</option>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label class="sr-only" for="from_date">From (Date) <span class="span_required">*</span></label>
              <input type="date" class="form-control form-control-lg" name="from_date" id="from_date" required value="{{ $item->from_date }}">
            </div>
            <div class="col-md-6">
              <label class="sr-only" for="from_date">From (Time)</label>
              <input type="time" class="form-control form-control-lg" name="from_time" id="from_time" value="{{ $item->from_time }}">
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label class="sr-only" for="to_date">To (Date) <span class="span_required">*</span></label>
              <input type="date" class="form-control form-control-lg" name="to_date" id="to_date" required value="{{ $item->to_date }}">
            </div>
            <div class="col-md-6">
              <label class="sr-only" for="to_time">To (Time)</label>
              <input type="time" class="form-control form-control-lg" name="to_time" id="to_time" value="{{ $item->to_time }}" >
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="sr-only" for="note">Note</label>
          <textarea class="form-control form-control-lg" name="note" style="min-height: 150px;">{{ $item->note }}</textarea>
        </div>
        
        <button type="submit" class="btn btn-success btn-icon-text btn-md"><i class=" mdi mdi-refresh  btn-icon-prepend"></i>Update</button>
        <a title="Delete" href="{{ route('leave_deleted_admin',[ 'ref' => $item->ref ]) }}" ><button class="btn btn-danger btn-icon-text btn-md" type="button" onclick="return confirm('Are you sure to delete this item ?');"><i class=" mdi mdi-times  btn-icon-prepend"></i> Delete</button></a>
      </form>
    </div>
  </div>
</div>
@endforeach

<script type="text/javascript">
  $('#halfday').on('change', function() {
    if(this.value=='NO') {
      $( "#to_date" ).prop( "disabled", false );
      $( "#to_time" ).prop( "disabled", false );
    }else {
      $('#to_date').val(''); $( "#to_date" ).prop( "disabled", true );
      $('#to_time').val(''); $( "#to_time" ).prop( "disabled", true );
    }
  });
</script>

@endsection