
@if ( Auth::user()->type=='admin' )
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="" />
    <title>MC | Cuti Management</title>
    <link href="{{ url('dash/css/root.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('dash/style.css') }}">
    <link rel="icon" href="{{ url('imgs/logo.png') }}" />
    <link href="https://fonts.googleapis.com/css?family=Changa&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('dash/css/font-awesome.min.css') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <style type="text/css">
    .right a { color:gray; font-weight: bold;  }
    .right .active {  background: rgba(0,0,0,0.2) }

    thead { background: white;  }
    /*Version Mobile*/
    @media only screen and (max-width: 800px) {
      .form-login {  width: auto !important; border-radius: 0; margin-left: 20px; margin-right: 20px; padding: 20px 36px !important; }
      .form-login .title-section { margin-top: 33px !important; }
      #top .inline { display: none; }
      .applogo { padding-left: 127px; width: auto !important; }
      .content { margin-top: -12px  !important; padding-left: 10px !important; padding-right: 10px !important; }
      #example0_filter { float: left; }
      .signOut { width: 100% !important; }
      .top-right { display: none; }
      .payment select { width: 100% !important; }
      .sidebar-open-button-mobile { color: white !important; }
      .page-header .right {
        position: inherit;
        right: 0;
        bottom: 1px;
        min-width: auto;
        text-align: right;
      }
      .page-header .right .btn-group {
        float: right;
        margin-top: 20px;
      }
    } 
    /*Version Web*/
    @media only screen and (min-width: 801px) {
      .tableInvoices { width: 100% !important;  }
    }
    </style>
</head>
<body>
    <div id="top" class="clearfix" style="background: black !important">
        <div class="applogo" style="padding-top: 9px, color:white; font-size: 20px; padding-top: 15px">
            <span style="font-weight: bold">MY PROJECT BALI</span>
        </div>
        <a href="#" class="sidebar-open-button-mobile"><i class="fa fa-bars"></i></a>
        <div class="col-md-2"></div>
        <ul class="top-right" style="background-color: #0AA2A5; padding:10px 8px">
            <li class=" link">
                <a href="#" style="padding-top: 2px; padding-right: 20px; padding-left: 20px">Welcome <b>{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</b></a>
            </li>
        </ul>
    </div>
    <div class="sidebar clearfix">
        <ul class="sidebar-panel nav nav title-nav-ul">
          <li class="title-nav">Customers</li>
        </ul>
        <ul class="sidebar-panel nav">
          <li>
            <a href="{{ route('client') }}"><span class="icon color5"><i class="fa fa-list"></i></span>
            <span class="panel_menu">All customers</span></a>
          </li>
          <!-- @if($msgs_no_lu!=0)
          <li>
            <a href="{{ route('clientMsgNoLu') }}"><span class="icon color5"><i class="fa fa-envelope" style="color:red"></i></span>
            <span class="panel_menu" style="color:red">New Messages</span></a>
          </li>
          @endif -->
          <li>
            <a href="{{ route('steps') }}" onclick="alert('The page may take one minute or more to load, click ok and wait for it to load please');"><span class="icon color5"><i class="fa fa-sitemap"></i></span>
            <span class="panel_menu">Steps</span></a>
          </li>
          <li>
            <a href="{{ route('recap') }}" onclick="alert('The page may take one minute or more to load, click ok and wait for it to load please');"><span class="icon color5"><i class="fa fa-table"></i></span>
            <span class="panel_menu">Summary</span></a>
          </li>
        </ul>
        <!-- <ul class="sidebar-panel nav nav title-nav-ul">
          <li class="title-nav">Documents</li>
        </ul>
        <ul class="sidebar-panel nav">
          <li>
            <a href="{{ route('docAdd') }}"><span class="icon color5"><i class="fa fa-plus"></i></span>
            <span class="panel_menu">Add new</span></a>
          </li>
          <li>
            <a href="{{ route('doc') }}"><span class="icon color5"><i class="fa fa-list"></i></span>
            <span class="panel_menu">List</span></a>
          </li>
        </ul> -->

        <ul class="sidebar-panel nav nav title-nav-ul">
          <li class="title-nav">Bases</li>
        </ul>
        <ul class="sidebar-panel nav">
          <li>
            <a href="{{ route('days', ['typ' => 'Rainy days' ]) }}"><span class="icon color5"><i class="fa fa-umbrella"></i></span>
            <span class="panel_menu">Rainy days</span></a>
          </li>
          <li>
            <a href="{{ route('days', ['typ' => 'Ceremony days' ]) }}"><span class="icon color5"><i class="fa fa-moon-o"></i></span>
            <span class="panel_menu">Ceremony days</span></a>
          </li>
          <li>
            <a href="{{ route('days', ['typ' => 'Public Holidays' ]) }}"><span class="icon color5"><i class="fa fa-birthday-cake"></i></span>
            <span class="panel_menu">Public Holidays</span></a>
          </li>

          <li>
            <a href="{{ route('holidays_total') }}"><span class="icon color5"><i class="fa fa-list"></i></span>
            <span class="panel_menu">Total</span></a>
          </li>
        </ul>

        <ul class="sidebar-panel nav nav title-nav-ul">
          <li class="title-nav">Outils</li>
        </ul>
        <ul class="sidebar-panel nav">
          <li>
            <a href="{{ route('emails') }}"><span class="icon color5"><i class="fa fa-bell"></i></span>
            <span class="panel_menu">Notifications</span></a>
          </li>
        </ul>

        <ul class="sidebar-panel nav nav title-nav-ul">
          <li class="title-nav">Account</li>
        </ul>
        <ul class="sidebar-panel nav">
          <li>
            <a href="{{ route('password') }}"><span class="icon color5"><i class="fa fa-unlock"></i></span>
            <span class="panel_menu">Password</span></a>
          </li>
        </ul>
        <ul class="sidebar-panel nav signOut" style="position: fixed; bottom: 0; background-color: red; width: 195px; margin-left: 0; padding-left: 20px">
          <li>
            <a href="{{ route('logout' ) }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="icon color5"><i class="fa fa-power-off" style="color: white"></i></span>
            <span class="panel_menu" style="color: white">Sign Out</span></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>   
          </li>
        </ul>
    </div>
    <div class="content">
        @yield('content') 
    </div>

    <!-- Datatable ************************************** -->
    <!-- ************************************************ -->
    <script type="text/javascript" src="{{ url('datatable/jquery-3.5.1.js') }}"></script>
    <script type="text/javascript" src="{{ url('datatable/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('datatable/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('datatable/dataTables.fixedHeader.min.js') }}"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.1/js/dataTables.fixedColumns.min.js"></script>



    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>



    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#oneColumnTable').DataTable( {

                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],

                scrollY: "800px",
                scrollCollapse: true,
                responsive: false,
                paging: false,
                footer: true,
                scrollX: true,
                order: [[ 0, "desc" ]],
                lengthMenu: [[-1, 20, 30, 50], ["All", 20, 30, 50]],
                fixedColumns:   {
                    leftColumns: 1
                }
                
            } );
            new $.fn.dataTable.FixedHeader( table );
        } );

        $(document).ready(function() {
            var table = $('#tableExport').DataTable( {
                scrollY: "800px",
                scrollCollapse: true,
                responsive: false,
                paging: false,
                footer: true,
                scrollX: true,
                order: [[ 0, "desc" ]],
                lengthMenu: [[-1, 20, 30, 50], ["All", 20, 30, 50]],

                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                fixedColumns:   {
                    leftColumns: 1
                }
            } );
            new $.fn.dataTable.FixedHeader( table );
        } );

        $(document).ready(function() {
            var table = $('#tableNoOrder').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                scrollY: "800px",
                scrollCollapse: true,
                responsive: false,
                paging: false,
                footer: true,
                scrollX: true,
                lengthMenu: [[-1, 20, 30, 50], ["All", 20, 30, 50]],
            } );
            new $.fn.dataTable.FixedHeader( table );
        } );
    </script>

    <script type="text/javascript">

      $(".sidebar-open-button-mobile").on("click",function(){
        if($(".sidebar").css("display") == "block"){
          $(".sidebar").css("display","none")
        }else{
          $(".sidebar").css("display","block")
        }
      });
    </script>
</body>
</html>
@endif
