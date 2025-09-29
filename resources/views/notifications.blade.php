@extends('master.theme')

@section('content')

<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Notifications</h4>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Message</th>
              <th>Sent</th>
            </tr>
          </thead>
          <tbody>
          	@foreach($notifications as $item)
            <tr @if($item->vu==0) style="background: rgba(255, 0, 0, 0.05);" @endif>
              <td class="bold">{{ $item->msg }}</td>
              <td><?php echo date('m/d/Y H:i:s', strtotime($item->fait)); ?></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection