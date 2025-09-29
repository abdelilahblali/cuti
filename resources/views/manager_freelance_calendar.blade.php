<?php use \App\Http\Controllers\Admin; ?>
@extends('master.theme')

@section('content')
<style>
.fc-content .fc-title { font-weight:bold; padding-left:10px }
</style>
<link href='https://unpkg.com/@fullcalendar/core@4.4.1/main.min.css' rel='stylesheet' />
<link href='https://unpkg.com/@fullcalendar/daygrid@4.4.1/main.min.css' rel='stylesheet' />
<link href='https://unpkg.com/@fullcalendar/timegrid@4.4.1/main.min.css' rel='stylesheet' />
<script src='https://unpkg.com/@fullcalendar/core@4.4.1/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/interaction@4.4.0/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/daygrid@4.4.1/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/timegrid@4.4.1/main.min.js'></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar2');
    var calendar2 = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
      defaultView: 'dayGridMonth',
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },

      events: [
      <?php foreach($freelance as $l) { ?>
      {
        title: '{{ $l->nom }} {{ $l->pre }}',
        start: '{{ $l->from_date }}',
        end: '{{ $l->to_date }}',
        color:"green",
        url:"{{ route('freelance_update_admin', [ 'ref'=>$l->ref ]) }}"
      },
      <?php } ?>
      
      ]
    });
    calendar2.render();
  });
</script>


<div class="">
  <div class="">
    <div class="row">
      <div class="col-sm-12">
        <div class="home-tab">
          <div class="d-sm-flex align-items-center justify-content-between border-bottom">
            <div>
              <div class="btn-wrapper">
                <a href="{{ url('manager_team') }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-account-multiple-outline "></i> My team</a>
                <a href="{{ url('manager_freelance', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-calendar "></i> Leave</a>
                <a href="{{ url('manager_overtimes', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-av-timer "></i> Over time</a>
                <a href="{{ url('manager_travel', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-wallet-travel "></i> Business Travel</a>
                <a href="{{ url('manager_resign', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-account-arrow-left "></i>Resignation</a>
                @if(Auth::user()->type=='admin')
                <a href="{{ url('manager_recruitment', [ 'act' => '0' ]) }}" class="btn btn-otline-dark align-items-center me-0"><i class="mdi mdi-account-multiple-plus "></i>Recruitment Request</a>
                @endif
                <a href="{{ url('manager_freelance', [ 'act' => '0' ]) }}" class="btn btn-primary text-white me-0"><i class="mdi mdi-clipboard-account "></i> Freelance</a>
              </div>
            </div>
            <div>
              <div class="btn-wrapper">
                @if(Auth::user()->type=='admin')
                <a href="{{ url('manager_freelance_all') }}" class="btn btn-inverse-defulat"><i class="mdi mdi-account-details "></i> All Data</a>
                @endif
                <a href="{{ url('manager_freelance_calendar') }}" class="btn btn-inverse-defulat"><i class="mdi mdi-calendar "></i> Calendar</a>
                <a href="{{ url('manager_freelance_recap') }}" class="btn btn-inverse-defulat"><i class="mdi mdi-table "></i> Recap</a>
                <a href="{{ url('manager_freelance', [ 'act' => '0' ]) }}" class="btn btn-inverse-warning"><i class="mdi mdi-account-multiple-outline "></i> Waiting Approval</a>
                <a href="{{ url('manager_freelance', [ 'act' => '1' ]) }}" class="btn btn-inverse-success"><i class="mdi mdi-calendar "></i> Accepted Leave</a>
                <a href="{{ url('manager_freelance', [ 'act' => '-1' ]) }}" class="btn btn-inverse-danger"><i class="mdi mdi-av-timer "></i> Refused Leave</a>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-md-8 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div id='calendar2'></div>
    </div>
  </div>
</div>





@endsection
