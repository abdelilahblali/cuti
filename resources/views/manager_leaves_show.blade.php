<?php use \App\Http\Controllers\Admin; ?>

@extends('master.theme')

@section('content')

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
                <a href="{{ url('manager_team') }}" class="btn btn-otline-dark align-items-center"><i class="mdi mdi-account-multiple-outline "></i> My team</a>
                <a href="{{ url('manager_leaves', [ 'act' => '0' ]) }}" class="btn btn-primary text-white"><i class="mdi mdi-calendar "></i> Leave</a>
                <a href="{{ url('manager_overtimes', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center"><i class="mdi mdi-av-timer "></i> Over time</a>
                <a href="{{ url('manager_travel', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-wallet-travel "></i> Business Travel</a>
                <a href="{{ url('manager_resign', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-account-arrow-left "></i>Resignation</a>
                @if(Auth::user()->type=='admin')
                <a href="{{ url('manager_recruitment', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-account-multiple-plus "></i>Recruitment Request</a>
                @endif
                <a href="{{ url('manager_freelance', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-clipboard-account "></i> Freelance</a>
              </div>
            </div>
            <div>
              <div class="btn-wrapper">
                @if(Auth::user()->type=='admin')
                <a href="{{ url('manager_leaves_all') }}" class="btn btn-inverse-defulat"><i class="mdi mdi-account-details "></i> All Data</a>
                @endif
                <a href="{{ url('manager_leaves_calendar') }}" class="btn btn-inverse-defulat"><i class="mdi mdi-calendar "></i> Calendar</a>
                <a href="{{ url('manager_leaves_recap') }}" class="btn btn-inverse-defulat"><i class="mdi mdi-table "></i> Recap</a>
                <a href="{{ url('manager_leaves', [ 'act' => '0' ]) }}" class="btn btn-inverse-warning"><i class="mdi mdi-account-multiple-outline "></i> Waiting Approval</a>
                <a href="{{ url('manager_leaves', [ 'act' => '1' ]) }}" class="btn btn-inverse-success"><i class="mdi mdi-calendar "></i> Accepted Leave</a>
                <a href="{{ url('manager_leaves', [ 'act' => '-1' ]) }}" class="btn btn-inverse-danger"><i class="mdi mdi-av-timer "></i> Refused Leave</a>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@foreach($leaves as $item)
<div class="col-md-12 grid-margin stretch-card formular">
  <div class="card">
    <div class="card-body">
        <h4 class="card-title">
          <u style="font-size: 14px;">Request Added : <?php echo date('m/d/Y H:i:s', strtotime($item->fait)); ?></u>  
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
        
        @if($item->act==0)
        <a title="Enabled" href="{{ route('manager_leaves_edit_etat',[ 'ref' => $item->ref, 'act' => '-1' ]) }}" ><button type="button" class="btn btn-danger btn-icon-text btn-sm" onclick="return confirm('Are you sure to cancel this request ?');"><i class=" mdi  mdi mdi-close-circle-outline   btn-icon-prepend"></i>Cancel</button></a>
        <a title="Enabled" href="{{ route('manager_leaves_edit_etat',[ 'ref' => $item->ref, 'act' => '1' ]) }}" ><button type="button" class="btn btn-success btn-icon-text btn-sm" onclick="return confirm('Are you sure to confirm this request ?');"><i class=" mdi  mdi mdi-check   btn-icon-prepend"></i>Confirm</button></a>
        @endif
    </div>
  </div>
</div>
@endforeach

@endsection