<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>MAGNITUDE | HUMAN RESOURCES</title>
  <link rel="stylesheet" href="{{ url('theme/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ url('theme/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ url('theme/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ url('theme/vendors/typicons/typicons.css') }}">
  <link rel="stylesheet" href="{{ url('theme/vendors/simple-line-icons/css/simple-line-icons.css') }}">
  <link rel="stylesheet" href="{{ url('theme/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ url('theme/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ url('theme/js/select.dataTables.min.css') }}">
  <link rel="stylesheet" href="{{ url('theme/css/vertical-layout-light/style.css') }}">
  <link rel="shortcut icon" href="{{ url('imgs/icon2.png') }}" />
  <style type="text/css">
    .logo-panel { background:black !important }
    .sidebar-icon-only .sidebar .nav .nav-item .nav-link i.menu-icon { color:#34605F !important }
    .content-wrapper { background:white !important }
    .navbar .navbar-menu-wrapper .navbar-nav .nav-item .welcome-text { margin-bottom: 0px !important; }
    .navbar .navbar-menu-wrapper .navbar-nav .nav-item .welcome-text { font-weight: bold; font-size: 23px; line-height: 38px; color: #8D8D8D; margin-bottom: 10px; }
    .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .navbar-dropdown .dropdown-item i { font-size:20px !important }
    .sidebar .nav .nav-item.active > .nav-link i, .sidebar .nav .nav-item.active > .nav-link .menu-title, .sidebar .nav .nav-item.active > .nav-link .menu-arrow { color:#484848 }
    .bold { font-weight: bold; }
    .sidebar .nav .nav-item.active > .nav-link { background:transparent !important; }
    .dropdown .dropdown-menu .dropdown-item { font-size: 13px; padding: .25rem 1.5rem; }

    .formular input { padding-left: 15px !important; font-weight:bold; }
    .formular select { padding-left: 15px !important; font-weight:bold; background: white !important; color: black; }
    .formular textarea { padding-left: 15px !important; font-weight:bold; background: white !important; color: black; line-height: 25px; }

    .badge-warning { font-weight:bold !important }
    .badge-success { font-weight:bold !important }
    .badge-danger { font-weight:bold !important}

    .red { color:red }
    .green { color:green }

    .sidebar { background:black;  }
    .sidebar .nav .nav-item .nav-link .menu-title { color:white }
    .sidebar .nav .nav-item .nav-link i.menu-icon  { color:white }
    .sidebar .nav .nav-item.nav-category   { color:#F4F5F7 !important }
    .sidebar .nav .nav-item.active > .nav-link i, .sidebar .nav .nav-item.active > .nav-link .menu-title, .sidebar .nav .nav-item.active > .nav-link .menu-arrow  { color:#34605F !important }

    .sidebar .nav .nav-item .nav-link { padding: 2px 35px 2px 35px !important; }
    .sidebar .nav .nav-item.nav-category { padding: 6px 0px 5px 0px !important; }

      @media (max-width: 480px) {
        .navbar .navbar-brand-wrapper { height: auto !important; }
        .navbar .navbar-brand-wrapper .brand-logo-mini img { width:100% !important }
        .navbar .navbar-menu-wrapper { width: calc(100% - 130px); }
        .navbar .navbar-brand-wrapper { width: 130px; }
        .navbar { margin-top:-6px !important }
      }

    body {
      width: 125%;
      transform-origin: top left;
      transform: scale(80%);
    }

    .btn-success{
      background-color:#34605f !important;
      border-color:#34605f !important;
    }
    

    table.dataTable tbody tr { border-color: #f4f1f1 !important; }
  </style>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="{{ url('uploadimg/croppie.js')  }}"></script>
  <link rel="stylesheet" href="{{ url('uploadimg/croppie.css')  }}" />

  <script type="text/javascript">
    document.body.style.zoom = "50%";
  </script>

  <!-- datatables -->
  <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.3.2/css/fixedHeader.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/4.2.2/css/fixedColumns.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowgroup/1.3.1/css/rowGroup.dataTables.min.css">

  <!-- style custom -->
  <style type="text/css">
    .dtfh-floatingparenthead { background: var(--lionadmin-body-bg) !important; top:65px !important;  }
    .table > thead { background: var(--lionadmin-body-bg) !important;}
    .table.dataTable thead tr > .dtfc-fixed-left, table.dataTable thead tr > .dtfc-fixed-right, table.dataTable tfoot tr > .dtfc-fixed-left, table.dataTable tfoot tr > .dtfc-fixed-right { background: var(--lionadmin-table-bg) !important }
    #tableVentes thead tr{ background: var(--lionadmin-body-bg) !important  }
    .dt-buttons { width: 200px !important; float: left; }
    .dt-buttons .dt-button {  background:#34605f !important; color:white !important; border:0 !important; border-radius:4px !important; font-size: 11px; padding: 3px 10px;   }
    tr { border-style: 0 !important; }
    #tableVentes_filter input { border: 1px dotted var(--lionadmin-input-border-color); font-size: 12px; margin-bottom: 8px; }
    #tableVentes_filter label {  }
    .table.dataTable tbody tr > .dtfc-fixed-left, table.dataTable tbody tr > .dtfc-fixed-right { background: var(--lionadmin-navbar-top-bg-color)  }
    .table-group th {   background: transparent !important; padding-left: 0 !important;   font-weight: bold; font-size: 15px; padding: 15px 0px !important; color:#0BA2A5 }
    .table-group th:before { content: url("{{ url('imgs/map.png')  }}"); width: 20px; height: 20px; }
  </style>

</head>
<body>

  @if($users_check_count!=0 && !Route::is('user_profil'))
  <div class="profil_check" style="position: fixed; z-index: 999 !important; background:rgba(0, 0, 0, 0.9); width: 100%; min-height: 100%;">
    <div class="profil_check_msg" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%); text-align: center;">
      <i class=" mdi mdi-alert " style="color:red; font-size:40px"></i>
      <h6 style="color:white; font-weight: bold;">
        Some information is missing : <br><br>
        @if(Auth::user()->manager=='') <span style="margin-bottom: -10px; display: block;">You need to choose your manager</span> <br> @endif
        @if(Auth::user()->img=='') <span style="margin-bottom: -10px; display: block;">You need to make your profil picture</span> <br> @endif
        @if(Auth::user()->phone=='') <span style="margin-bottom: -10px; display: block;">You need to put your number phone</span> <br> @endif
        <br>
        <a href="{{ url('user_profil') }}">Go to my profil page</a>
      </h6>
    </div>
  </div>
  @endif

  <div class="container-scroller">
    
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start logo-panel">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu" style="color: white;"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="{{ url('home') }}">
            <img src="{{ url('imgs/logo_white.png') }}" alt="" />
          </a>
          <a class="navbar-brand brand-logo-mini" href="{{ url('home') }}">
            <img src="{{ url('imgs/logo_white.png') }}" alt="" />
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text">Welcome, <span class="text-black fw-bold">{{ Auth::user()->nom }} {{ Auth::user()->pre }}</span></h1>
            <h3 class="welcome-sub-text">Your performance summary this week </h3>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          
          @if(Auth::user()->category=='Manager')
          <li class="nav-item dropdown"> 
            <a href="{{ url('manager_team') }}"><button class="btn btn-outline-primary btn-icon-text btn-sm">My team</button></a>
          </li>
          <li class="nav-item dropdown"> 
            <a href="{{ url('manager_leaves_calendar') }}"><button class="btn btn-outline-primary btn-icon-text btn-sm">Presence Today</button></a>
          </li>
            @if($leaves_waiting!=0)
              <li class="nav-item dropdown"> 
                <a href="{{ url('manager_leaves', [ 'act' => '0' ]) }}"><button class="btn btn-warning btn-icon-text btn-sm">Leaves : Waiting Approval</button></a>
              </li>
            @endif
            @if($overtimes_waiting!=0)
              <li class="nav-item dropdown"> 
                <a href="{{ url('manager_overtimes', [ 'act' => '0' ]) }}"><button class="btn btn-warning btn-icon-text btn-sm">Overtimes : Waiting Approval</button></a>
              </li>
            @endif
            @if($travel_waiting!=0)
              <li class="nav-item dropdown"> 
                <a href="{{ url('manager_travel', [ 'act' => '0' ]) }}"><button class="btn btn-warning btn-icon-text btn-sm">Travel Business : Waiting Approval</button></a>
              </li>
            @endif
            @if($resign_waiting!=0)
              <li class="nav-item dropdown"> 
                <a href="{{ url('manager_resign', [ 'act' => '0' ]) }}"><button class="btn btn-warning btn-icon-text btn-sm">Resignations : Waiting Approval</button></a>
              </li>
            @endif
          @endif
          @if(Auth::user()->type=='admin')
            @if($recruitment_waiting!=0)
              <li class="nav-item dropdown"> 
                <a href="{{ url('manager_recruitment', [ 'act' => '0' ]) }}"><button class="btn btn-warning btn-icon-text btn-sm">Recruitments : Waiting Approval</button></a>
              </li>
            @endif
            {{-- @if($freelance_waiting!=0)
              <li class="nav-item dropdown"> 
                <a href="{{ url('manager_freelance', [ 'act' => '0' ]) }}"><button class="btn btn-warning btn-icon-text btn-sm">Freelance : Waiting Approval</button></a>
              </li>
            @endif --}}
          @endif

          <li class="nav-item dropdown"> 
            <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="icon-bell"></i>
              @if(count($notificationsNotRead)!=0) 
              <span class="count"></span>
              @endif
            </a>

            @if(count($notificationsNotRead)!=0)
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="countDropdown">
              <a class="dropdown-item py-3" href="{{ url('user_notifications') }}">
                @if(count($notificationsNotRead)!=0)
                <p class="mb-0 font-weight-medium float-left">You have <?php echo count($notificationsNotRead); ?> new notifications </p>
                <span class="badge badge-pill badge-primary float-right">Mark as read</span>
                @endif
              </a>
              <div class="dropdown-divider"></div>
              @foreach($notificationsNotRead as $notif)
              <a class="dropdown-item preview-item py-3">
                <div class="preview-thumbnail">
                  <i class="mdi mdi-alert m-auto text-primary"></i>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject fw-normal text-dark mb-1">{{ $notif->msg }}</h6>
                  <p class="fw-light small-text mb-0"> {{ $notif->fait }} </p>
                </div>
              </a>
              @endforeach
            </div>
            @endif
          </li>
          <li class="nav-item dropdown"> 
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              @if(Auth::user()->img!='')
              <img class="img-xs rounded-circle" src="{{ url('media/profil/') }}/{{ Auth::user()->img }}" >
              @else
              <img class="img-xs rounded-circle" src="{{ url('imgs/no-profil_magnitude.jpg') }}">
              @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown" style="padding: 0 !important;">
              <div class="dropdown-header" style="padding: 18px 15px 5px 15px !important;">
                <div class="col-md-4">
                  @if(Auth::user()->img!='')
                  <img class="img-md " src="{{ url('media/profil/') }}/{{ Auth::user()->img }}" style="width: 60px; margin-left: 12px;">
                  @else
                  <img class="img-md " src="{{ url('imgs/no-profil_magnitude.jpg') }}" style="width: 60px; margin-left: 12px;">
                  @endif  
                </div>
                <div class="col-md-8">
                  <p class="mb-1 mt-1 font-weight-semibold" style="margin-top: 10px !important; font-weight: bold; margin-left: 12px;">{{ Auth::user()->nom }} {{ Auth::user()->pre }}</p>
                </div>
              </div>
              <a class="dropdown-item" href="{{ url('user_profil') }}"><i class="dropdown-item-icon mdi mdi-account-outline me-2"></i> My Profile @if($users_check_count!=0)<span class="badge badge-pill badge-danger">{{ $users_check_count }}</span>@endif</a>
              <a class="dropdown-item" href="{{ url('user_password') }}"><i class="dropdown-item-icon mdi  mdi mdi-lock-outline  me-2"></i> Password</a>
              <a class="dropdown-item" href="{{ url('user_notifications') }}"><i class="dropdown-item-icon mdi mdi-message-text-outline me-2"></i> Notifications</a>
              <a class="dropdown-item" href="{{ route('logout' ) }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="dropdown-item-icon mdi mdi-power me-2"></i>Sign Out</a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      
      <nav class="sidebar sidebar-offcanvas menu-panel" id="sidebar">
        <ul class="nav">
          <li class="nav-item"><a class="nav-link" href="{{ url('home') }}"><i class="mdi mdi-grid-large menu-icon"></i><span class="menu-title">Dashboard</span></a></li>          

          <li class="nav-item nav-category">Leave</li>
          <li class="nav-item"><a class="nav-link" href="{{ url('leave_add') }}"><i class="menu-icon mdi mdi  mdi mdi-library-plus "></i><span class="menu-title">Request</span></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('leave_etat', [ 'act' => '0' ]) }}"><i class="menu-icon mdi mdi mdi-timer-sand "></i><span class="menu-title">Waiting Approval</span></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('leave_etat', [ 'act' => '1' ]) }}"><i class="menu-icon mdi mdi mdi-thumb-up-outline "></i><span class="menu-title">Confirmed</span></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('leave_calendar') }}"><i class="menu-icon mdi mdi mdi-calendar-multiple-check "></i><span class="menu-title">Calendar</span></a></li>

          <li class="nav-item nav-category">Over time</li>
          <li class="nav-item"><a class="nav-link" href="{{ url('overtimes_add') }}"><i class="menu-icon mdi mdi  mdi mdi-library-plus "></i><span class="menu-title">Request</span></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('overtimes_etat', [ 'act' => '0' ]) }}"><i class="menu-icon mdi mdi mdi-timer-sand "></i><span class="menu-title">Waiting Approval</span></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('overtimes_etat', [ 'act' => '1' ]) }}"><i class="menu-icon mdi mdi mdi-thumb-up-outline "></i><span class="menu-title">Confirmed</span></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('overtimes_calendar') }}"><i class="menu-icon mdi mdi mdi-calendar-multiple-check "></i><span class="menu-title">Calendar</span></a></li>

          <!-- New Section -->
          <li class="nav-item nav-category">Freelance</li>
          <li class="nav-item"><a class="nav-link" href="{{ url('freelance_add') }}"><i class="menu-icon mdi mdi  mdi mdi-library-plus "></i><span class="menu-title">Request</span></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('freelance_etat', [ 'act' => '0' ]) }}"><i class="menu-icon mdi mdi mdi-timer-sand "></i><span class="menu-title">Waiting Approval</span></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('freelance_etat', [ 'act' => '1' ]) }}"><i class="menu-icon mdi mdi mdi-thumb-up-outline "></i><span class="menu-title">Confirmed</span></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('freelance_calendar') }}"><i class="menu-icon mdi mdi mdi-calendar-multiple-check "></i><span class="menu-title">Calendar</span></a></li>

          <!-- New Section -->
          <li class="nav-item nav-category">Business Travel</li>
          <li class="nav-item"><a class="nav-link" href="{{ url('travel_add') }}"><i class="menu-icon mdi mdi  mdi mdi-library-plus "></i><span class="menu-title">Request</span></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('travel_etat', [ 'act' => '0' ]) }}"><i class="menu-icon mdi mdi mdi-timer-sand "></i><span class="menu-title">Waiting Approval</span></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('travel_etat', [ 'act' => '1' ]) }}"><i class="menu-icon mdi mdi mdi-thumb-up-outline "></i><span class="menu-title">Confirmed</span></a></li>

          <li class="nav-item nav-category">Contrat & Salary</li>
          <li class="nav-item"><a class="nav-link" href="{{ url('salaryslip') }}"><i class="menu-icon mdi mdi mdi-cash-multiple"></i><span class="menu-title">Salary Slip</span></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('contracts') }}"><i class="menu-icon mdi mdi mdi-file-document "></i><span class="menu-title">My Contrat</span></a></li>

          <!-- New Section -->
          @if(Auth::user()->category=='Manager')
          <li class="nav-item nav-category">Recruitment Staff</li>
          <li class="nav-item"><a class="nav-link" href="{{ url('recruitment_add') }}"><i class="menu-icon mdi mdi  mdi mdi-library-plus "></i><span class="menu-title">Request</span></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('recruitment_etat', [ 'act' => '0' ]) }}"><i class="menu-icon mdi mdi mdi-timer-sand "></i><span class="menu-title">Waiting Approval</span></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('recruitment_etat', [ 'act' => '1' ]) }}"><i class="menu-icon mdi mdi mdi-thumb-up-outline "></i><span class="menu-title">Confirmed</span></a></li>
          @endif  

          <!-- New Section -->
          <li class="nav-item nav-category">Resignation</li>
          <li class="nav-item"><a class="nav-link" href="{{ url('resign_add') }}"><i class="menu-icon mdi mdi  mdi mdi-library-plus "></i><span class="menu-title">Request</span></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('resign_etat', [ 'act' => '0' ]) }}"><i class="menu-icon mdi mdi mdi-timer-sand "></i><span class="menu-title">Waiting Approval</span></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('resign_etat', [ 'act' => '1' ]) }}"><i class="menu-icon mdi mdi mdi-thumb-up-outline "></i><span class="menu-title">Confirmed</span></a></li>

          @if(Auth::user()->type=='admin')
          <li class="nav-item nav-category">Administration</li>
          <li class="nav-item"><a class="nav-link" href="{{ url('usersEtat', [ 'act' => '0' ]) }}"><i class="menu-icon mdi mdi mdi-timer-sand "></i><span class="menu-title">Registrations</span>@if($users_waiting!=0)<label class="badge badge-danger">{{ $users_waiting }}</label>@endif</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('users') }}"><i class="menu-icon mdi mdi-library-plus "></i><span class="menu-title">Accounts</span></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('salary') }}"><i class="menu-icon mdi mdi-cash-multiple  "></i><span class="menu-title">Salary</span></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('leave_manual') }}"><i class="menu-icon mdi mdi-vector-difference-ba   "></i><span class="menu-title">Leave</span></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('departments') }}"><i class="menu-icon mdi mdi-sitemap   "></i><span class="menu-title">Departments</span></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('positions') }}"><i class="menu-icon mdi mdi-star   "></i><span class="menu-title">Positions</span></a></li>
          @endif  

          <li class="nav-item nav-category">My Account</li>
          <li class="nav-item"><a class="nav-link" href="{{ url('user_profil') }}"><i class="menu-icon mdi mdi mdi-account-card-details  "></i><span class="menu-title">My Profil</span></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('user_password') }}"><i class="menu-icon mdi mdi mdi mdi-lock-open-outline  "></i><span class="menu-title">Password</span></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('user_notifications') }}"><i class="menu-icon mdi mdi mdi mdi-message-text-outline  "></i><span class="menu-title">Notifications</span></a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('logout' ) }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="menu-icon mdi mdi-power "></i><span class="menu-title">Sign Out</span></a></li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>   
        </ul>
      </nav>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            @yield('content') 
          </div>
        </div>
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><a href="https://www.magnitudeconstruction.com/" target="_blank">Magnitude</a> Copyright © <?php echo date('Y'); ?> All rights reserved.</span>
          </div>
        </footer>
      </div>
    </div>
  </div>


  <script src="{{ url('theme/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ url('theme/vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ url('theme/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ url('theme/vendors/progressbar.js/progressbar.min.js') }}"></script>

  <script src="{{ url('theme/js/off-canvas.js') }}"></script>
  <script src="{{ url('theme/js/hoverable-collapse.js') }}"></script>
  <script src="{{ url('theme/js/template.js') }}"></script>
  <script src="{{ url('theme/js/settings.js') }}"></script>
  <script src="{{ url('theme/js/todolist.js') }}"></script>
  <script src="{{ url('theme/js/jquery.cookie.js') }}" type="text/javascript"></script>

  <!-- ************************************************ -->
  <!-- Datatable ************************************** -->
  <!-- ************************************************ -->
  <script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.3.2/js/dataTables.fixedHeader.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/4.2.2/js/dataTables.fixedColumns.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.3.1/js/dataTables.rowGroup.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#table1').DataTable( {
          order: [[7, 'asc'], [1, 'desc']],
          fixedHeader: true,
          fixedColumns:   { leftColumns: 1 },
          scrollCollapse: false,
          scrollX: true,
          paging: false,
          rowGroup: {
            dataSrc: [ 7 ],
            className: 'table-group'
          },
          columnDefs: [ {
              targets: [ 1 ],
              visible: false
          } ],
          dom: 'Bfrtip', buttons: [ 'copy', 'excel', ]
      } );
    } );
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#table2').DataTable( {
          order: [[0, 'desc']],
          fixedHeader: true,
          fixedColumns:   { leftColumns: 1 },
          scrollCollapse: false,
          scrollX: true,
          paging: false,
          dom: 'Bfrtip', buttons: [ 'copy', 'excel', ]
      } );
    } );
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#table3').DataTable( {
          order: [[0, 'desc']],
          fixedHeader: true,
          fixedColumns:   { leftColumns: 1 },
          scrollCollapse: false,
          scrollX: true,
          paging: false,
          dom: 'Bfrtip', buttons: [ 'copy', 'excel', ]
      } );
    } );
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#table4').DataTable( {
          order: [[0, 'desc']],
          fixedHeader: true,
          fixedColumns:   { leftColumns:2 },
          scrollCollapse: false,
          scrollX: true,
          paging: false,
          dom: 'Bfrtip', buttons: [ 'copy', 'excel', ]
      } );
    } );
  </script>

</body>

</html>

