@extends('master.theme')

@section('content')

@if(session()->has('yes')) <div class="col-md-12"><div class="alert alert-success">{{ session()->get('yes') }}</div></div> @endif
@if(session()->has('no')) <div class="col-md-12"><div class="alert alert-danger">{{ session()->get('no') }}</div></div> @endif

<div class="row">
  <div class="col-sm-12">
    <div class="home-tab">
      <div class="d-sm-flex align-items-center justify-content-between border-bottom">
        <div class="btn-wrapper"></div>
        <div class="btn-wrapper">
          <a href="{{ url('salary') }}" class="btn btn-inverse-defulat"><i class="mdi mdi-history "></i> History</a>
          <a href="{{ url('salary_add') }}" class="btn btn-inverse-success"><i class="mdi mdi-plus "></i> New Salary</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Salary History Operations</h4>
      <div class="table-responsive">
        <table id="table2" class="table display nowrap" style="width: 100%;">
          <thead>
            <tr>
              <th>Period</th>
              <th>By</th>
              <th>Done</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          	@foreach($salary as $item)
            <tr>
              <td class="bold">{{ $item->period }}</td>
              <td>{{ $item->by }}</td>
              <td><span><?php echo date('m/d/Y H:i:s', strtotime($item->fait)); ?></span></td>
              <td><a title="View" href="{{ route('salaryslip_receipt_admin',[ 'ref' => $item->ref ]) }}" target="_blank"><button class="btn btn-sm btn-success" type="button">Export  all receives for this period</button></a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @if(count($salary)==0)
        <center><div class="badge badge-danger" style="margin-top: 100px; margin-bottom: 100px;">No items on this list</div></center>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection