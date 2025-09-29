@extends('master.theme')

@section('content')

<style type="text/css">
  .span_Manager { background:#0AA2A5; color:white; font-weight:bold; padding:5px 8px; border-radius:5px }
  .span_User { background:#0b54a3; color:white; font-weight:bold; padding:5px 8px; border-radius:5px }
</style>

@if(session()->has('yes')) <div class="col-md-12"><div class="alert alert-success">{{ session()->get('yes') }}</div></div> @endif
@if(session()->has('no')) <div class="col-md-12"><div class="alert alert-danger">{{ session()->get('no') }}</div></div> @endif

<div class="">
  <div class="">
    <div class="row">
      <div class="col-sm-12">
        <div class="home-tab">
          <div class="d-sm-flex align-items-center justify-content-between border-bottom">
            <div>
              <div class="btn-wrapper">
                <a href="{{ url('positions_add') }}" class="btn btn-otline-dark align-items-center"><i class="mdi mdi-plus "></i> Add new position</a>
                <a href="{{ url('positions') }}" class="btn btn-otline-dark align-items-center"><i class="mdi mdi-file "></i> List of positions</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="col-lg-12 grid-margin stretch-card">


  <div class="card">
    <div class="card-body">
      <h4 class="card-title">positions</h4>

      <div class="row">
        
      </div>

      <div class="table-responsive">
        <table id="table2" class="table display nowrap" style="width: 100%;">
          <thead>
            <tr>
              <th>Code</th>
              <th>Title</th>
              <th>Created</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          	@foreach($positions as $item)
            <tr>
              <td class="bold">{{ $item->code }}</td>
              <td>{{ $item->title }}</td>
              <td><?php echo date('m/d/Y H:i:s', strtotime($item->fait)); ?></td>
              <td>
                <a title="Update" href="{{ route('positions_edit',[ 'ref' => $item->ref ]) }}" ><button class="btn btn-sm btn-success" type="button">Update</button></a>
                <a title="Delete" href="{{ route('positions_deleted',[ 'ref' => $item->ref ]) }}" ><button class="btn btn-sm btn-danger" type="button" onclick="return confirm('Are you sure to delete this item ?');">Delete</button></a>
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