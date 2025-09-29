@extends('master.theme')

@section('content')

@if(session()->has('yes')) <div class="col-md-12"><div class="alert alert-success">{{ session()->get('yes') }}</div></div> @endif
@if(session()->has('no')) <div class="col-md-12"><div class="alert alert-danger">{{ session()->get('no') }}</div></div> @endif

<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Leaves</h4>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>From</th>
              <th>To</th>
              <th>Half Day</th>
              <th>Raison</th>
              <th>Status</th>
              <th>Options</th>
            </tr>
          </thead>
          <tbody>
          	@foreach($leaves as $item)
            <tr>
              <td class="bold"><?php echo date('m/d/Y', strtotime($item->from_date)); ?> @if($item->from_time!='') {{ $item->from_time }} @endif</td>
              <td class="bold"><?php echo date('m/d/Y', strtotime($item->to_date)); ?> @if($item->to_time!='') {{ $item->to_time }} @endif</td>
              <td><span>{{ $item->halfday }}</span></td>
              <td>{{ $item->raison }}</td>
              <td>
              	@if($item->act==0)<label class="badge badge-warning">Pending</label>@endif
              	@if($item->act==1)<label class="badge badge-success">Accepted</label>@endif
              	@if($item->act==-1)<label class="badge badge-danger">Refused</label>@endif
              </td>
              <td>
                <a title="View" href="{{ route('leave_edit',[ 'ref' => $item->ref ]) }}" ><button class="btn btn-sm btn-success" type="button">View</button></a>
              	@if($item->act==0)
                <a title="Update" href="{{ route('leave_edit',[ 'ref' => $item->ref ]) }}" ><button class="btn btn-sm btn-success" type="button">Update</button></a>
              	<a title="Delete" href="{{ route('leave_deleted',[ 'ref' => $item->ref ]) }}" ><button class="btn btn-sm btn-danger" type="button" onclick="return confirm('Are you sure to delete this item ?');">Delete</button></a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @if(count($leaves)==0)
        <center><div class="badge badge-danger" style="margin-top: 100px; margin-bottom: 100px;">No items on this list</div></center>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection