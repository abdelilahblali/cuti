@extends('master.theme')

@section('content')

@if(session()->has('yes')) <div class="col-md-12"><div class="alert alert-success">{{ session()->get('yes') }}</div></div> @endif
@if(session()->has('no')) <div class="col-md-12"><div class="alert alert-danger">{{ session()->get('no') }}</div></div> @endif



<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Salary History Operations</h4>
      <div class="table-responsive">
        <table id="table2" class="table display nowrap" style="width: 100%;">
          <thead>
            <tr>
              <th>Period</th>
              <th>Done</th>
              <th>Net </th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          	@foreach($salaryslip as $item)
            <tr>
              <td class="bold">{{ $item->period }}</td>
              <td><span><?php echo date('m/d/Y H:i:s', strtotime($item->fait)); ?></span></td>
              <td class="bold">{{ number_format($item->net, 2) }} IDR</td>
              <td>
                <a title="View" href="{{ route('salaryslip_receipt',[ 'ref' => $item->ref ]) }}" target="_blank"><button class="btn btn-sm btn-success" type="button">Receive</button></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @if(count($salaryslip)==0)
        <center><div class="badge badge-danger" style="margin-top: 100px; margin-bottom: 100px;">No items on this list</div></center>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection