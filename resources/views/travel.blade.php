@extends('master.theme')

@section('content')

@if(session()->has('yes')) <div class="col-md-12"><div class="alert alert-success">{{ session()->get('yes') }}</div></div> @endif
@if(session()->has('no')) <div class="col-md-12"><div class="alert alert-danger">{{ session()->get('no') }}</div></div> @endif

<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Travels</h4>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Destination</th>
              <th>From</th>
              <th>To</th>
              <th>Total Days</th>
              <th>Total Budget (IDR)</th>
              <th>Status</th>
              <th>Options</th>
            </tr>
          </thead>
          <tbody>
          	@foreach($travel as $item)
            <tr>
              <td><?php echo wordwrap($item->destination,30,"<br>\n"); ?></td>
              <td><?php echo date('m/d/Y', strtotime($item->from_date)); ?></td>
              <td><?php echo date('m/d/Y', strtotime($item->to_date)); ?></td>
              <?php 
                $from_date = strtotime($item->from_date);
                $to_date = strtotime($item->to_date);
                $diff = $to_date - $from_date;
                $days = floor($diff / (60 * 60 * 24));

                $budget = DB::table('travel_details')->where('travel', $item->ref)->sum('budget');
              ?>
              <td class="bold"><span class="badge badge-info"><?php echo $days; ?> Days</span></td>
              <td class="bold"><?php echo number_format($budget,2); ?></td>
              <td>
              	@if($item->act==0)<label class="badge badge-warning">Pending</label>@endif
              	@if($item->act==1)<label class="badge badge-success">Accepted</label>@endif
              	@if($item->act==-1)<label class="badge badge-danger">Refused</label>@endif
              </td>
              <td>
                <a title="View" href="{{ route('travel_edit',[ 'ref' => $item->ref ]) }}" ><button class="btn btn-sm btn-success" type="button">View</button></a>
                @if($item->act==1)
                <a title="Print Travel Business Form" href="{{ route('travelbusiness_form',[ 'ref' => $item->ref ]) }}" target="_blank"><button class="btn btn-sm btn-warning" type="button">Print</button></a>
                <a title="Upload Invoice" href="{{ route('travel_edit',[ 'ref' => $item->ref ]) }}" target="_blank"><button class="btn btn-sm btn-danger" type="button"><i class=" mdi mdi-upload"></i></button></a>
                @endif
              	@if($item->act==0)
                <a title="Update" href="{{ route('travel_edit',[ 'ref' => $item->ref ]) }}" ><button class="btn btn-sm btn-success" type="button">Update</button></a>
              	<a title="Delete" href="{{ route('travel_deleted',[ 'ref' => $item->ref ]) }}" ><button class="btn btn-sm btn-danger" type="button" onclick="return confirm('Are you sure to delete this item ?');">Delete</button></a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @if(count($travel)==0)
        <center><div class="badge badge-danger" style="margin-top: 100px; margin-bottom: 100px;">No items on this list</div></center>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection