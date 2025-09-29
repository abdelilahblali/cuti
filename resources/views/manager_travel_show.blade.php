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
                <a href="{{ url('manager_team') }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-account-multiple-outline "></i> My team</a>
                <a href="{{ url('manager_leaves', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-calendar "></i> Leave</a>
                <a href="{{ url('manager_overtimes', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-av-timer "></i> Over time</a>
                <a href="{{ url('manager_travel', [ 'act' => '0' ]) }}" class="btn btn-primary text-white me-0"><i class="mdi mdi-wallet-travel "></i> Business Travel</a>
                <a href="{{ url('manager_resign', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-account-arrow-left "></i>Resignation</a>
                @if(Auth::user()->type=='admin')
                <a href="{{ url('manager_recruitment', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-account-multiple-plus "></i>Recruitment Request</a>
                @endif
                <a href="{{ url('manager_freelance', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-clipboard-account "></i> Freelance</a>
              </div>
            </div>
            <div>
              <div class="btn-wrapper">
                @if(Auth::user()->type=='admin')<a href="{{ url('manager_travel_all') }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-account-details "></i> All Data</a>@endif
                <a href="{{ url('manager_travel', [ 'act' => '0' ]) }}" class="btn btn-inverse-warning"><i class="mdi mdi-account-multiple-outline "></i> Waiting Approval</a>
                <a href="{{ url('manager_travel', [ 'act' => '1' ]) }}" class="btn btn-inverse-success"><i class="mdi mdi-calendar "></i> Accepted Business Travel</a>
                <a href="{{ url('manager_travel', [ 'act' => '-1' ]) }}" class="btn btn-inverse-danger"><i class="mdi mdi-av-timer "></i> Refused Business Travel</a>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@foreach($travel as $item)
<div class="col-md-12 grid-margin stretch-card formular">
  <div class="card">
    <div class="card-body">
        <h4 class="card-title">
          <u style="font-size: 14px;">Request Added : <?php echo date('m/d/Y H:i:s', strtotime($item->fait)); ?></u>  
          @if($item->act==0)<label class="badge badge-warning" style="float:right">Pending</label>@endif
          @if($item->act==1)<label class="badge badge-success" style="float:right">Enabled</label>@endif
          @if($item->act==-1)<label class="badge badge-danger" style="float:right">Disabled</label>@endif
        </h4>
        <div class="form-group">
          <div class="row">
            <div class="col md-6">
                <label class="sr-only" for="purpose">Travel Purpose <span class="span_required">*</span></label>
                <input type="text" class="form-control form-control-lg" name="purpose" id="purpose" value="{{$item->purpose}}">
            </div>
            <div class="col md-6">
                <label class="sr-only" for="destination">Destination <span class="span_required">*</span></label>
                <input type="text" class="form-control form-control-lg" name="destination" id="destination" value="{{$item->destination}}">
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label class="sr-only" for="from_date">From (Date) <span class="span_required">*</span></label>
              <input type="date" class="form-control form-control-lg" name="from_date" id="from_date" value="{{$item->from_date}}">
            </div>
            <div class="col-md-6">
              <label class="sr-only" for="to_date">To (Date) <span class="span_required">*</span></label>
              <input type="date" class="form-control form-control-lg" name="to_date" id="to_date" value="{{$item->to_date}}">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="sr-only" for="agenda">Agenda</label>
          <textarea class="form-control form-control-lg" name="agenda" style="min-height: 150px;">{{ $item->agenda }}</textarea>
        </div>
        
        @if($item->act==0)
        <a title="Enabled" href="{{ route('manager_travel_edit_etat',[ 'ref' => $item->ref, 'act' => '-1' ]) }}" ><button type="button" class="btn btn-danger btn-icon-text btn-sm" onclick="return confirm('Are you sure to cancel this request ?');"><i class=" mdi  mdi mdi-close-circle-outline   btn-icon-prepend"></i>Cancel</button></a>
        <a title="Enabled" href="{{ route('manager_travel_edit_etat',[ 'ref' => $item->ref, 'act' => '1' ]) }}" ><button type="button" class="btn btn-success btn-icon-text btn-sm" onclick="return confirm('Are you sure to confirm this request ?');"><i class=" mdi  mdi mdi-check   btn-icon-prepend"></i>Confirm</button></a>
        @endif
    </div>
  </div>
</div>

<?php $total = DB::table('travel_details')->where('travel', $item->ref)->sum('budget'); ?>
<div class="col-md-12 grid-margin stretch-card formular">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Expense Details</h4>
        <div class="table-responsive">
          <table class="table" style="width: 100%;">
            <thead>
              <tr>
                <th>Type</th>
                <th>Description</th>
                <th>Budget (IDR)</th>
              </tr>
            </thead>
            <tbody id="dataExpense">
              @foreach ($details as $item)
              <tr>
                <td style="font-weight:bold;">{{$item->type}}</td>
                <td>{{$item->description}}</td>
                <td><?php echo number_format($item->budget,2); ?></td>
              </tr>
              @endforeach
            </tbody>
            <tfoot id="FootdataExpense">
              <tr>
                <td style="font-weight:bold;" colspan="2">TOTAL</td>
                <td style="font-weight:bold;" colspan="2"><?php echo number_format($total,2); ?> IDR</td>
              </tr>
            </tfoot>
          </table>
        </div>
    </div>
  </div>
</div>

@endforeach

@endsection