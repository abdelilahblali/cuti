<?php use \App\Http\Controllers\Admin; ?>
@extends('master.theme')

@section('content')
<style>
  .fc-content .fc-title { font-weight:bold; padding-left:10px }
  .span_required { color:red  }
</style>

<div class="col-md-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title card-title-dash">My Contratcs</h4>
      <table id="table2" class="table display nowrap" style="width: 100%;">
        <thead>
          <tr>
            <th>Start</th>
            <th>End</th>
            <th>Document</th>
          </tr>
        </thead>
        <tbody>
          @foreach($contracts as $item)
            <tr>
              <td class="green bold"><?php if($item->from_date!=''){ echo date('m/d/Y', strtotime($item->from_date)); } ?></td>
              <td class="red bold"><?php if($item->to_date!=''){ echo date('m/d/Y', strtotime($item->to_date)); } else { echo "Unlimited"; } ?></td>
              <td>@if($item->file!='') <a href="{{ url('public/media/contracts/') }}/{{ $item->file }}" target="_blank"><button class="btn btn-xs btn-primary">View</button></a> @endif</td>
            </tr>
          @endforeach
        </tbody>
      </table>

      @if(count($contracts)==0)
        <center><div class="badge badge-danger" style="margin-top: 100px; margin-bottom: 100px;">No items on this list</div></center>
        @endif
        
    </div>
  </div>
</div>


@endsection
