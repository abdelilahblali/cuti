<?php use \App\Http\Controllers\Admin; ?>
@extends('master.theme')

@section('content')
<style>
  .fc-content .fc-title { font-weight:bold; padding-left:10px }
  .span_required { color:red  }
</style>

@if(session()->has('yes')) <div class="col-md-12"><div class="alert alert-success">{{ session()->get('yes') }}</div></div> @endif
@if(session()->has('no')) <div class="col-md-12"><div class="alert alert-danger">{{ session()->get('no') }}</div></div> @endif

<div class="col-md-5 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('usersContractsAdded') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="cli" value="{{ $cli }}" >
        <div class="form-group">
          <label class="sr-only" for="from_date">Start <span class="span_required">*</span></label>
          <input type="date" class="form-control form-control-lg" name="from_date" required>
        </div>
        <div class="form-group">
          <label class="sr-only" for="to_date">End</label>
          <input type="date" class="form-control form-control-lg" name="to_date" >
        </div>
        <div class="form-group">
          <label class="sr-only" for="file">Document <span class="span_required">*</span></label>
          <input type="file" class="form-control form-control-lg" name="file[]" required>
        </div>
        <button type="submit" class="btn btn-success btn-icon-text btn-md"><i class=" mdi mdi-plus  btn-icon-prepend"></i>Add</button>
      </form>
    </div>
  </div>
</div>

<div class="col-md-7 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title card-title-dash">Contratcs</h4>
      <table class="table">
        <thead>
          <tr>
            <th>Start</th>
            <th>End</th>
            <th>Document</th>
            <th>Options</th>
          </tr>
        </thead>
        <tbody>
          @foreach($contracts as $item)
            <tr>
              <td class="green bold"><?php if($item->from_date!=''){ echo date('m/d/Y', strtotime($item->from_date)); } ?></td>
              <td class="red bold"><?php if($item->to_date!=''){ echo date('m/d/Y', strtotime($item->to_date)); } else { echo "Unlimited"; } ?></td>
              <td>@if($item->file!='') <a href="{{ url('public/media/contracts/') }}/{{ $item->file }}" target="_blank"><button class="btn btn-xs btn-primary">View</button></a> @endif</td>
              <td><a title="Delete" href="{{ route('usersContractsDeleted',[ 'ref' => $item->ref ]) }}" ><button class="btn btn-sm btn-danger" type="button" onclick="return confirm('Are you sure to delete this item ?');">Delete</button></a></td>
            </tr>
          @endforeach

          
        </tbody>
      </table>
    </div>
  </div>
</div>


@endsection
