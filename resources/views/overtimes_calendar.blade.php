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
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
      defaultView: 'dayGridMonth',
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },

      events: [
      <?php foreach($overtimes as $l) { ?>
      {
        title: '@if($l->act==1) Accepted @elseif($l->act==0) Pending @elseif($l->act==-1) Refused @endif',
        start: '{{ $l->from_date }}',
        end: '{{ $l->to_date }}',
        color:"@if($l->act==1) green @elseif($l->act==0) orange @elseif($l->act==-1) red @endif",
      },
      <?php } ?>
      
      ]
    });
    calendar.render();
  });
</script>

<div class="col-md-8 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div id='calendar'></div>
    </div>
  </div>
</div>

<div class="col-md-4 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title card-title-dash">Summary</h4>
      <table class="table">
        <thead>
          <tr>
            <th>Month</th>
            <th>Hours</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $months = array( 1=>"Jan" , 2=>"Feb" , 3=>"Mar" , 4=>"Apr" , 5=>"May" , 6=>"June" , 7=>"July" , 8=>"Aug" , 9=>"Sept" , 10=>"Oct" , 11=>"Nov" , 12=>"Dec" );
          $year = date('Y'); $sum=0;
          ?>

          @for($i=1; $i<=12; $i++)
          <?php $nb_hours = Admin::calc_nb_overtimes($i, $year); $sum = $sum + $nb_hours; ?>
            <tr>
              <td>{{ $months[$i] }}</td>
              <td @if($nb_hours!=0) class='green bold' @endif><?php echo $nb_hours; ?></td>
            </tr>
          @endfor 

          <tr>
            <th>Total</th>
            <th>{{ $sum }}</th>
          </tr>
          
        </tbody>
      </table>
    </div>
  </div>
</div>


@endsection
