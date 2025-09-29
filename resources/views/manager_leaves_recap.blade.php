<?php use \App\Http\Controllers\Admin; ?>
@extends('master.theme')

@section('content')
<style>
.fc-content .fc-title { font-weight:bold; padding-left:10px }
.table th, .table td { font-size: 12px; }
</style>

<div class="">
  <div class="">
    <div class="row">
      <div class="col-sm-12">
        <div class="home-tab">
          <div class="d-sm-flex align-items-center justify-content-between border-bottom">
            <div>
              <div class="btn-wrapper">
                <a href="{{ url('manager_team') }}" class="btn btn-otline-dark align-items-center"><i class="mdi mdi-account-multiple-outline "></i> My team</a>
                <a href="{{ url('manager_leaves', [ 'act' => '0' ]) }}" class="btn btn-primary text-white"><i class="mdi mdi-calendar "></i> Leave</a>
                <a href="{{ url('manager_overtimes', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center"><i class="mdi mdi-av-timer "></i> Over time</a>
                <a href="{{ url('manager_travel', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-wallet-travel "></i> Business Travel</a>
                <a href="{{ url('manager_resign', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-account-arrow-left "></i>Resignation</a>
                @if(Auth::user()->type=='admin')
                <a href="{{ url('manager_recruitment', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-account-multiple-plus "></i>Recruitment Request</a>
                @endif
                <a href="{{ url('manager_freelance', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-clipboard-account "></i> Freelance</a>
              </div>
            </div>
            <div>
              <div class="btn-wrapper">
               @if(Auth::user()->type=='admin')
                <a href="{{ url('manager_leaves_all') }}" class="btn btn-inverse-defulat"><i class="mdi mdi-account-details "></i> All Data</a>
                @endif
                <a href="{{ url('manager_leaves_calendar') }}" class="btn btn-inverse-defulat"><i class="mdi mdi-calendar "></i> Calendar</a>
                <a href="{{ url('manager_leaves_recap') }}" class="btn btn-inverse-defulat"><i class="mdi mdi-table "></i> Recap</a>
                <a href="{{ url('manager_leaves', [ 'act' => '0' ]) }}" class="btn btn-inverse-warning"><i class="mdi mdi-account-multiple-outline "></i> Waiting Approval</a>
                <a href="{{ url('manager_leaves', [ 'act' => '1' ]) }}" class="btn btn-inverse-success"><i class="mdi mdi-calendar "></i> Accepted Leave</a>
                <a href="{{ url('manager_leaves', [ 'act' => '-1' ]) }}" class="btn btn-inverse-danger"><i class="mdi mdi-av-timer "></i> Refused Leave</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-md-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">

      <form method="POST" action="{{ route('manager_leaves_recap_update_year') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <select name="year" id="year" class="form-control">
                <option value="2023">2023</option>
                <option value="2024">2024</option>
              </select>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-success btn-icon-text btn-xs"><i class=" mdi mdi-refresh"></i></button>
            </div>
          </div>
        </div>
      </form>

      <h4 class="card-title card-title-dash">Summary <?php echo $year; ?></h4>
      <?php $months = array( 1=>"Jan" , 2=>"Feb" , 3=>"Mar" , 4=>"Apr" , 5=>"May" , 6=>"June" , 7=>"July" , 8=>"Aug" , 9=>"Sept" , 10=>"Oct" , 11=>"Nov" , 12=>"Dec" ); ?>
      <table id="table2" class="table display nowrap" style="width: 100%;">
        <thead>
          <tr>
            <th>Name</th>
            @foreach($months as $m)
            <th>{{ $m }}</th>
            @endforeach
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $u)
          <tr>
            <th>{{ $u->nom }} {{ $u->pre }}</th>
            <?php $i=1; $total_take=0; ?>
            @foreach($months as $m)
            <th>
              <?php $nb_jr = Admin::calc_nb_leaves_byUser($i, $year, $u->ref);  $total_take = $total_take + $nb_jr;
              $nb_jr_month = cal_days_in_month(CAL_GREGORIAN, $i, $year);
              $days_take = $nb_jr_month-$nb_jr; 
              $pourcent = Admin::cacul_pourcentage($days_take, $nb_jr_month, 100); ?>
              <span class="@if($nb_jr!=0) red @endif">{{ $nb_jr }}</span> / <span class="green">{{ $nb_jr_month-$nb_jr }}</span>
            </th>
            <?php $i+=1; ?>
            @endforeach
            <th>
              <span class="@if($total_take!=0) red @endif">{{ $total_take }}</span>
            </th>
          </tr>
          @endforeach
        </tbody>
      </table>

      
    </div>
  </div>
</div>




@endsection
