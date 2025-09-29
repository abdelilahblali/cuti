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
      <?php foreach($leaves as $l) { ?>
      {
        title: '@if($l->act==1) Accepted @elseif($l->act==0) Pending @elseif($l->act==-1) Refused @endif',
        start: '{{ $l->from_date }}',
        end: "<?php echo date('Y-m-d', strtotime($l->to_date . ' 1 day')); ?>" ,
        color:"@if($l->act==1) green @elseif($l->act==0) orange @elseif($l->act==-1) red @endif",
        url:"{{ route('leave_edit', [ 'ref'=>$l->ref ]) }}"
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
      <h4 class="card-title card-title-dash">Summary <?php echo date('Y'); ?></h4>
      <table class="table">
        <thead>
          <tr>
            <th>Month</th>
            <th>Take</th>
            <th>Available</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $months = array( 1=>"Jan" , 2=>"Feb" , 3=>"Mar" , 4=>"Apr" , 5=>"May" , 6=>"June" , 7=>"July" , 8=>"Aug" , 9=>"Sept" , 10=>"Oct" , 11=>"Nov" , 12=>"Dec" );
          $year = date('Y'); $sum=0; 
          ?>

          @for($i=1; $i<=12; $i++)
          <?php $nb_jr = Admin::calc_nb_leaves($i, $year); $sum = $sum + $nb_jr; ?>
            <tr>
              <td>{{ $months[$i] }}</td>
              <td @if($nb_jr!=0) class='red bold' @endif><?php echo $nb_jr; ?></td>
              <td class="bold green"><?php echo cal_days_in_month(CAL_GREGORIAN, $i, $year) - $nb_jr; ?></td>
            </tr>
          @endfor 

          <tr>
            <th>Total</th>
            <th>{{ $sum }}</th>
            <th></th>
          </tr>
          
        </tbody>
      </table>
    </div>
  </div>
</div>


@endsection
