<?php use \App\Http\Controllers\Admin; ?>
@extends('master.theme')

@section('content')

@if(session()->has('yes')) <div class="col-md-12"><div class="alert alert-success">{{ session()->get('yes') }}</div></div> @endif
@if(session()->has('no')) <div class="col-md-12"><div class="alert alert-danger">{{ session()->get('no') }}</div></div> @endif

<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">overtimes</h4>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>From</th>
              <th>To</th>
              <th>Hours</th>
              <th>Raison</th>
              <th>Status</th>
              <th>Options</th>
            </tr>
          </thead>
          <tbody>
          	@foreach($overtimes as $item)
            <tr>
              <td class="bold"><?php echo date('m/d/Y', strtotime($item->from_date)); ?> <?php if($item->from_time!='') { echo date('H:i', strtotime($item->from_time)); } ?></td>
              <td class="bold"><?php echo date('m/d/Y', strtotime($item->to_date)); ?>   <?php if($item->to_time!='') { echo date('H:i', strtotime($item->to_time)); } ?></td>

              <td><div class="badge badge-opacity-success me-3 bold"><?php echo Admin::calcul_hours($item->from_time, $item->to_time);  ?></div></td>

              <td>{{ $item->raison }}</td>
              <td>
              	@if($item->act==0)<label class="badge badge-warning">Pending</label>@endif
              	@if($item->act==1)<label class="badge badge-success">Accepted</label>@endif
              	@if($item->act==-1)<label class="badge badge-danger">Refused</label>@endif
              </td>
              <td>
                <a title="View" href="{{ route('overtimes_edit',[ 'ref' => $item->ref ]) }}" ><button class="btn btn-sm btn-success" type="button">View</button></a>
              	@if($item->act==0)
                <a title="Update" href="{{ route('overtimes_edit',[ 'ref' => $item->ref ]) }}" ><button class="btn btn-sm btn-success" type="button">Update</button></a>
              	<a title="Delete" href="{{ route('overtimes_deleted',[ 'ref' => $item->ref ]) }}" ><button class="btn btn-sm btn-danger" type="button" onclick="return confirm('Are you sure to delete this item ?');">Delete</button></a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @if(count($overtimes)==0)
        <center><div class="badge badge-danger" style="margin-top: 100px; margin-bottom: 100px;">No items on this list</div></center>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection