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
                <a href="{{ url('manager_travel', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-wallet-travel "></i> Business Travel</a>
                <a href="{{ url('manager_resign', [ 'act' => '0' ]) }}" class="btn btn-primary text-white me-0"><i class="mdi mdi-account-arrow-left "></i>Resignation</a>
                @if(Auth::user()->type=='admin')
                <a href="{{ url('manager_recruitment', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-wallet-travel "></i> Recruitment Request</a>
                @endif
                <a href="{{ url('manager_freelance', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-clipboard-account "></i> Freelance</a>
              </div>
            </div>
            <div>
              <div class="btn-wrapper">
                @if(Auth::user()->type=='admin')<a href="{{ url('manager_resign_all') }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-account-details "></i> All Data</a>@endif
                <a href="{{ url('manager_resign', [ 'act' => '0' ]) }}" class="btn btn-inverse-warning"><i class="mdi mdi-account-multiple-outline "></i> Waiting Approval</a>
                <a href="{{ url('manager_resign', [ 'act' => '1' ]) }}" class="btn btn-inverse-success"><i class="mdi mdi-calendar "></i> Accepted Request</a>
                <a href="{{ url('manager_resign', [ 'act' => '-1' ]) }}" class="btn btn-inverse-danger"><i class="mdi mdi-av-timer "></i> Refused Request</a>
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
      <h4 class="card-title">Resignation</h4>
      <div class="table-responsive">
        <table id="table2" class="table display nowrap" style="width: 100%;">
          <thead>
            <tr>
              <th>User</th>
              <th>Effective Resign Date</th>
              <th>Reason</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          	@foreach($resign as $item)
            <tr>
              <td class="bold">{{ $item->nom }} {{ $item->pre }}</td>
              <td class="bold"><?php echo date('m/d/Y', strtotime($item->date)); ?></td>
              <td><?php echo wordwrap($item->reason,100,"<br>\n"); ?></span></td>
              <td>
              	@if($item->act==0)<label class="badge badge-warning">Pending</label>@endif
              	@if($item->act==1)<label class="badge badge-success">Accepted</label>@endif
              	@if($item->act==-1)<label class="badge badge-danger">Refused</label>@endif
              </td>
              <td align="right">
                <a title="View" href="{{ route('manager_resign_show',[ 'ref' => $item->ref ]) }}" ><button class="btn btn-sm btn-success" type="button">View</button></a>
                <a title="Delete" href="{{ route('manager_resign_delete',[ 'ref' => $item->ref ]) }}"  onclick="return confirm('Are you sure to delete this element ?');"><button class="btn btn-sm btn-danger" type="button">Delete</button></a>
                @if($item->act==1)
                <!-- <a title="View" href="{{ route('resign_form',[ 'ref' => $item->ref ]) }}" target="_blank"><button class="btn btn-sm btn-warning" type="button">Print</button></a> -->
                <a title="Download Letter" href="https://hr.magnitudeconstruction.com/media/resign/{{$item->attach}}" target="_blank"><button class="btn btn-sm btn-primary" type="button">Download</button></a>
                <a title="Offboarding Checklist" href="{{ route('manager_resign_checklist',[ 'ref' => $item->ref ]) }}" ><button class="btn btn-sm btn-warning" type="button">Checklist</button></a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @if(count($resign)==0)
        <center><div class="badge badge-danger" style="margin-top: 100px; margin-bottom: 100px;">No items on this list</div></center>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection