<?php use \App\Http\Controllers\Admin; ?>
@extends('master.theme')

@section('content')



<style type="text/css">
  .span_Manager { background:#34605F; color:white; font-weight:bold; padding:5px 8px; border-radius:5px }
  .span_User { background:#0b54a3; color:white; font-weight:bold; padding:5px 8px; border-radius:5px }
  .modal-backdrop { width:100% !important; height:100% !important  }
</style>


<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Accounts</h4>
      <div class="table-responsive">
        <table id="table4" class="table display nowrap" style="width: 100%;">
          <thead>
            <tr>
              <th></th>
              <th>Name</th>
              <th>Code</th>
              <th>Email</th>
              <th>Type</th>
              <th>Manager</th>
              <th>Department</th>
              <th>Position</th>
              <th>Phone</th>
              <th>Created</th>
              <th>Contratcs</th>
              <th>Status</th>
              <th>Options</th>
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
              <td class="bold">
                <a style="text-decoration:none !important; color:black" href="{{ route('users_update',[ 'ref' => $item->ref ]) }}" ><span class="bold ref">{{ $item->nom }} {{ $item->pre }}</span></a>
              </td>
              <td class="bold"><span class="ref">{{ $item->code }}</span></td>
              <td>{{ $item->username }}</td>

              <td>
                <a id="type_{{ $item->ref }}" data-toggle="modal" data-target="#modal_select" onClick="getData( '{{ $item->ref }}', 'type', '{{ $item->type }}' );">
                  @if($item->category=='Manager')
                  <span class="span_{{ $item->category }}">{{ $item->category }}</span>
                  @else
                  <span class="span_User">Staff</span>
                  @endif
                </a>
              </td>

              <td class="bold"><span>{{ Admin::usersGetManager($item->ref) }}</span></td>

              <td class="bold">{{ Admin::usersGetDepartment($item->department) }}</td>
              <td class="bold">{{ Admin::usersGetPosition($item->position) }}</td>
              <td>{{ $item->phone }}</td>
              <td><?php echo date('m/d/Y H:i:s', strtotime($item->fait)); ?></td>

              <td>
                <?php $count = Admin::usersContracts_count($item->ref); ?>
                @if($count==0) <i class="mdi mdi-close red bold"></i> @else <i class="mdi mdi-check green bold"></i> @endif 
                <a title="Contracts Management" href="{{ route('usersContracts',[ 'cli' => $item->ref ]) }}" ><i class=" mdi mdi-shape-square-plus" style="margin-left: 10px;"></i></a>
              </td>

              <td>
              	@if($item->act==0)<label class="badge badge-warning">Pending</label>@endif
              	@if($item->act==1)<label class="badge badge-success">Enabled</label>@endif
              	@if($item->act==-1)<label class="badge badge-danger">Disabled</label>@endif
              </td>
              <td>
                @if($item->act==-1 or $item->act==0)
              	<a title="Enabled" href="{{ route('usersEditAct',[ 'ref' => $item->ref, 'act' => '1' ]) }}" ><button class="btn btn-xs btn-success" type="button" onclick="return confirm('Are you sure to enable this item ?');">Enabled</button></a>
              	@endif
                @if($item->act==1)
                <a title="Disabled" href="{{ route('usersEditAct',[ 'ref' => $item->ref, 'act' => '-1' ]) }}" ><button class="btn btn-xs btn-danger" type="button" onclick="return confirm('Are you sure to disable this item ?');">Disabled</button></a>
                @endif

                

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