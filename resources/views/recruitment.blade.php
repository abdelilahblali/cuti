@extends('master.theme')

@section('content')

@if(session()->has('yes')) <div class="col-md-12"><div class="alert alert-success">{{ session()->get('yes') }}</div></div> @endif
@if(session()->has('no')) <div class="col-md-12"><div class="alert alert-danger">{{ session()->get('no') }}</div></div> @endif

<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Request New Staff</h4>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Type</th>
              <th>Hire Reason</th>
              <th>Title</th>
              <th>Status</th>
              <th>Options</th>
            </tr>
          </thead>
          <tbody>
          	@foreach($recruitment as $item)
            <tr>
              <td class="bold">{{$item->type}}</td>
              <td class="bold">{{$item->hire}}</td>
              <td><span>{{ $item->title }}</span></td>
              <td>
              	@if($item->act==0)<label class="badge badge-warning">Pending</label>@endif
              	@if($item->act==1)<label class="badge badge-success">Accepted</label>@endif
              	@if($item->act==-1)<label class="badge badge-danger">Refused</label>@endif
              </td>
              <td>
                <a title="View" href="{{ route('recruitment_edit',[ 'ref' => $item->ref ]) }}" ><button class="btn btn-sm btn-success" type="button">View</button></a>
              	@if($item->act==0)
                <a title="Update" href="{{ route('recruitment_edit',[ 'ref' => $item->ref ]) }}" ><button class="btn btn-sm btn-success" type="button">Update</button></a>
              	<a title="Delete" href="{{ route('recruitment_deleted',[ 'ref' => $item->ref ]) }}" ><button class="btn btn-sm btn-danger" type="button" onclick="return confirm('Are you sure to delete this item ?');">Delete</button></a>
                @endif
                @if($item->act==1)
                <a title="View" href="{{ route('recruitment_form',[ 'ref' => $item->ref ]) }}" target="_blank"><button class="btn btn-sm btn-warning" type="button">Print</button></a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @if(count($recruitment)==0)
        <center><div class="badge badge-danger" style="margin-top: 100px; margin-bottom: 100px;">No items on this list</div></center>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection