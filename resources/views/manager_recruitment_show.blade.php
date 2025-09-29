@extends('master.theme')
@if(Auth::user()->type=='admin')
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
                <a href="{{ url('manager_leaves', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center"><i class="mdi mdi-calendar "></i> Leave</a>
                <a href="{{ url('manager_overtimes', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center"><i class="mdi mdi-av-timer "></i> Over time</a>
                <a href="{{ url('manager_travel', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-cente"><i class="mdi mdi-wallet-travel "></i> Business Travel</a>
                <a href="{{ url('manager_resign', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-account-arrow-left "></i>Resignation</a>
                @if(Auth::user()->type=='admin')
                <a href="{{ url('manager_recruitment', [ 'act' => '0' ]) }}" class="btn btn-primary text-white me-0"><i class="mdi mdi-account-multiple-plus "></i>Recruitment Request</a>
                @endif
                <a href="{{ url('manager_freelance', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-clipboard-account "></i> Freelance</a>
              </div>
            </div>
            <div>
              <div class="btn-wrapper">
                <a href="{{ url('manager_recruitment', [ 'act' => '0' ]) }}" class="btn btn-inverse-warning"><i class="mdi mdi-account-multiple-outline "></i> Waiting Approval</a>
                <a href="{{ url('manager_recruitment', [ 'act' => '1' ]) }}" class="btn btn-inverse-success"><i class="mdi mdi-calendar "></i> Accepted Recruitment</a>
                <a href="{{ url('manager_recruitment', [ 'act' => '-1' ]) }}" class="btn btn-inverse-danger"><i class="mdi mdi-av-timer "></i> Refused Recruitment</a>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@foreach($recruitment as $item)
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
            <div class="col-md-4">
              <label class="sr-only" for="type">Type <span class="span_required">*</span></label>
              <select class="form-control form-control-lg" name="type" id="type" required>
                <option>{{$item->type}}</option>
                <option></option>
                <option>Full Time</option>
                <option>Part Time</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="sr-only" for="hire">Hire Reason <span class="span_required">*</span></label>
              <select class="form-control form-control-lg" name="hire" id="hire" required>
                <option>{{$item->hire}}</option>
                <option></option>
                <option>New</option>
                <option>Replacing</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="sr-only" for="replacing">Replacing (name) </label>
              <input type="text" class="form-control form-control-lg" name="replacing" id="replacing" value="{{$item->replacing}}" >
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label class="sr-only" for="reason">Reason<span class="span_required">*</span></label>
              <textarea class="form-control form-control-lg" name="reason" id="reason" style="min-height: 150px;">{{$item->reason}}</textarea>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label class="sr-only" for="title">Title <span class="span_required">*</span></label>
              <input type="text" class="form-control form-control-lg" name="title" id="title" required value="{{$item->title}}">
            </div>
            <div class="col-md-6">
              <label class="sr-only" for="salary">Salary Range </label>
              <input type="text" class="form-control form-control-lg" name="salary" id="salary" value="{{$item->salary}}">
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label class="sr-only" for="description">Position Description <span class="span_required">*</span></label>
              <textarea class="form-control form-control-lg" name="description" id="description" style="min-height: 150px;" required>{{$item->description}}</textarea>
            </div>
            <div class="col-md-6">
              <label class="sr-only" for="duties">Duties <span class="span_required">*</span></label>
              <textarea class="form-control form-control-lg" name="duties" id="duties" style="min-height: 150px;" required>{{$item->duties}}</textarea>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <label class="sr-only" for="requirement">Requirements (ie. Research funds, other funding) <span class="span_required">*</span></label>
              <textarea class="form-control form-control-lg" name="requirement" id="requirement" style="min-height: 150px;" required>{{$item->requirement}}</textarea>
            </div>
            <div class="col-md-4">
              <label class="sr-only" for="equipment">Equipments (ie. furniture,phone) <span class="span_required">*</span></label>
              <textarea class="form-control form-control-lg" name="equipment" id="equipment" style="min-height: 150px;" required>{{$item->equipment}}</textarea>
            </div>
            <div class="col-md-4">
              <label class="sr-only" for="additional">Additional Requirement <span class="span_required">*</span></label>
              <textarea class="form-control form-control-lg" name="additional" id="additional" style="min-height: 150px;" required>{{$item->additional}}</textarea>
            </div>
          </div>
        </div>
        
        @if($item->act==0)
        <a title="Enabled" href="{{ route('manager_recruitment_edit_etat',[ 'ref' => $item->ref, 'act' => '-1' ]) }}" ><button type="button" class="btn btn-danger btn-icon-text btn-sm" onclick="return confirm('Are you sure to cancel this request ?');"><i class=" mdi  mdi mdi-close-circle-outline   btn-icon-prepend"></i>Cancel</button></a>
        <a title="Enabled" href="{{ route('manager_recruitment_edit_etat',[ 'ref' => $item->ref, 'act' => '1' ]) }}" ><button type="button" class="btn btn-success btn-icon-text btn-sm" onclick="return confirm('Are you sure to confirm this request ?');"><i class=" mdi  mdi mdi-check   btn-icon-prepend"></i>Confirm</button></a>
        @endif
    </div>
  </div>
</div>
@endforeach

@endsection
@endif