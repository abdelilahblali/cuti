@extends('master.theme')

@section('content')

<style type="text/css">
  .span_Manager { background:#34605f; color:white; font-weight:bold; padding:5px 8px; border-radius:5px }
  .span_User { background:#0b54a3; color:white; font-weight:bold; padding:5px 8px; border-radius:5px }
</style>

<div class="">
  <div class="">
    <div class="row">
      <div class="col-sm-12">
        <div class="home-tab">
          <div class="d-sm-flex align-items-center justify-content-between border-bottom">
            <div>
              <div class="btn-wrapper">
                <a href="{{ url('manager_team') }}" class="btn btn-primary text-white me-0"><i class="mdi mdi-account-multiple-outline "></i> My team</a>
                <a href="{{ url('manager_leaves', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-calendar "></i> Leave</a>
                <a href="{{ url('manager_overtimes', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-av-timer "></i> Over time</a>
                <a href="{{ url('manager_travel', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-wallet-travel "></i> Business Travel</a>
                <a href="{{ url('manager_resign', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-account-arrow-left "></i>Resignation</a>
                @if(Auth::user()->type=='admin')
                <a href="{{ url('manager_recruitment', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-account-multiple-plus "></i>Recruitment Request</a>
                @endif
                <a href="{{ url('manager_freelance', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-clipboard-account "></i> Freelance</a>
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
      <h4 class="card-title">My team</h4>

      <div class="row">
        
      </div>

      <div class="table-responsive">
        <table id="table2" class="table display nowrap" style="width: 100%;">
          <thead>
            <tr>
              <th></th>
              <th>Name</th>
              <th>Type</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Created</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
          	@foreach($users as $item)
            <tr>
              <td>
                @if($item->img!='')
                <img class="img-xs rounded-circle" src="{{ url('media/profil/') }}/{{ $item->img }}" >
                @else
                <img class="img-xs rounded-circle" src="{{ url('imgs/no-profil_magnitude.jpg') }}">
                @endif
              </td>
              <td class="bold">{{ $item->nom }} {{ $item->pre }}</td>
              <td>{{ $item->username }}</td>
              <td>
                @if($item->category=='Manager')
                <span class="span_{{ $item->category }}">{{ $item->category }}</span>
                @else
                <span class="span_User">User</span>
                @endif
              </td>
              <td>{{ $item->phone }}</td>
              <td><?php echo date('m/d/Y H:i:s', strtotime($item->fait)); ?></td>
              <td>
              	@if($item->act==0)<label class="badge badge-warning">Pending</label>@endif
              	@if($item->act==1)<label class="badge badge-success">Enabled</label>@endif
              	@if($item->act==-1)<label class="badge badge-danger">Disabled</label>@endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection