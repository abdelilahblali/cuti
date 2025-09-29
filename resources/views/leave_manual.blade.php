@extends('master.theme')

@section('content')

<style type="text/css">
  .span_required { color:red  }
</style>

@if(session()->has('yes')) <div class="col-md-12"><div class="alert alert-success">{{ session()->get('yes') }}</div></div> @endif
@if(session()->has('no')) <div class="col-md-12"><div class="alert alert-danger">{{ session()->get('no') }}</div></div> @endif


<div class="col-md-4 grid-margin stretch-card formular">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Add new leave request</h4>
        <form method="POST" action="{{ route('leave_manual_added') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label class="sr-only" for="cli">Staff <span class="span_required">*</span></label>
              <select class="form-control form-control-lg" name="cli" id="cli" required>
                <option></option>
                @foreach($clis as $c)
                <option value="{{ $c->ref }}">{{ $c->nom }} {{ $c->pre }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label class="sr-only" for="raison">Raison <span class="span_required">*</span></label>
              <select class="form-control form-control-lg" name="raison" id="raison" required>
                <option></option>
                <option>Holiday</option>
                <option>Disease</option>
                <option>Ceremony</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="sr-only" for="halfday">Half Day</label>
              <select class="form-control form-control-lg" name="halfday" id="halfday">
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
              <input type="date" class="form-control form-control-lg" name="from_date" id="from_date" required>
            </div>
            <div class="col-md-6">
              <label class="sr-only" for="from_date">From (Time)</label>
              <input type="time" class="form-control form-control-lg" name="from_time" id="from_time" >
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label class="sr-only" for="to_date">To (Date) <span class="span_required">*</span></label>
              <input type="date" class="form-control form-control-lg" name="to_date" id="to_date" required>
            </div>
            <div class="col-md-6">
              <label class="sr-only" for="to_time">To (Time)</label>
              <input type="time" class="form-control form-control-lg" name="to_time" id="to_time" >
            </div>
          </div>
        </div>
        
        <button type="submit" class="btn btn-success btn-icon-text btn-md"><i class=" mdi mdi-plus  btn-icon-prepend"></i>Add</button>
      </form>
    </div>
  </div>
</div>

<div class="col-lg-8 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Leaves</h4>
      <div class="table-responsive">
        <table id="table2" class="table display nowrap" style="width: 100%;">
          <thead>
            <tr>
              <th>User</th>
              <th>From</th>
              <th>To</th>
              <th>Raison</th>
              <th>Status</th>
              <th>Options</th>
            </tr>
          </thead>
          <tbody>
          	@foreach($leaves as $item)
            <tr>
              <td class="bold">{{ $item->nom }} {{ $item->pre }}</td>
              <td class="bold"><?php echo date('m/d/Y', strtotime($item->from_date)); ?> @if($item->from_time!='') {{ $item->from_time }} @endif</td>
              <td class="bold"><?php echo date('m/d/Y', strtotime($item->to_date)); ?> @if($item->to_time!='') {{ $item->to_time }} @endif</td>
              <td>{{ $item->raison }}</td>
              <td>
              	@if($item->act==0)<label class="badge badge-warning">Pending</label>@endif
              	@if($item->act==1)<label class="badge badge-success">Accepted</label>@endif
              	@if($item->act==-1)<label class="badge badge-danger">Refused</label>@endif
              </td>
              <td>
                <a title="View" href="{{ route('leave_edit',[ 'ref' => $item->ref ]) }}" ><button class="btn btn-sm btn-success" type="button">View</button></a>
                <a title="Delete" href="{{ route('leave_manual_deleted',[ 'ref' => $item->ref ]) }}" ><button class="btn btn-sm btn-danger" type="button" onclick="return confirm('Are you sure to delete this item ?');">Delete</button></a>
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

<script type="text/javascript">
  $('#halfday').on('change', function() {
    if(this.value=='NO') {
      $( "#to_date" ).prop( "disabled", false );
      $( "#to_time" ).prop( "disabled", false );
    }else {
      $('#to_date').val(''); $( "#to_date" ).prop( "disabled", true );
      $('#to_time').val(''); $( "#to_time" ).prop( "disabled", true );
    }
  });
</script>

@endsection