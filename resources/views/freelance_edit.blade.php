@extends('master.theme')

@section('content')

@if(session()->has('yes')) <div class="col-md-12"><div class="alert alert-success">{{ session()->get('yes') }}</div></div> @endif
@if(session()->has('no')) <div class="col-md-12"><div class="alert alert-danger">{{ session()->get('no') }}</div></div> @endif

@foreach($freelance as $item)
<div class="col-md-12 grid-margin stretch-card formular">
  <div class="card">
    <div class="card-body">
        <h4 class="card-title">
          Show & Edit  
          @if($item->act==0)<label class="badge badge-warning" style="float:right">Pending</label>@endif
          @if($item->act==1)<label class="badge badge-success" style="float:right">Enabled</label>@endif
          @if($item->act==-1)<label class="badge badge-danger" style="float:right">Disabled</label>@endif
        </h4>
        <form method="POST" action="{{ route('freelance_edited', [ 'ref' => $item->ref ]) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        
        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <label class="sr-only" for="from_date">Date <span class="span_required">*</span></label>
              <input type="date" class="form-control form-control-lg" name="from_date" id="from_date" required value="{{ $item->from_date }}">
            </div>
            <div class="col-md-4">
              <label class="sr-only" for="from_date">From (Time) <span class="span_required">*</span></label>
              <input type="time" class="form-control form-control-lg" name="from_time" id="from_time" required value="{{ $item->from_time }}">
            </div>
            <div class="col-md-4">
              <label class="sr-only" for="to_time">To (Time) <span class="span_required">*</span></label>
              <input type="time" class="form-control form-control-lg" name="to_time" id="to_time" required value="{{ $item->to_time }}">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="sr-only" for="note">Note</label>
          <textarea class="form-control form-control-lg" name="note" style="min-height: 150px;">{{ $item->note }}</textarea>
        </div>

        @if($item->act==0)
        <button type="submit" class="btn btn-success btn-icon-text btn-md"><i class=" mdi mdi-refresh  btn-icon-prepend"></i>Update</button>
        @endif
      </form>
    </div>
  </div>
</div>
@endforeach

@endsection