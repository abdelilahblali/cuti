<?php use \App\Http\Controllers\Admin; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Travel Business Form</title>
    <link rel="stylesheet" type="text/css" href="{{ public_path('bootstrap/css/bootstrap/bootstrap.css') }}">
    <style type="text/css">
        body { font-family: helvetica; }
        .tab1 { width: 100%; font-size: 12px; font-family: helvetica;  }
        .mgt10 { margin-top: 10px  } .mgt20 { margin-top: 0px  } .mgt30 { margin-top: 30px  } .mgt40 { margin-top: 40px  }
        .tr1 { border-right:1px solid rgba(0,0,0,0.1);  }
        .tr2 td { font-size: 11px; padding:5px 6px;   }
        .tr3 td {font-size: 11px; padding:5px 6px; height: 50px;   }
        td { text-align: justify;  }
        h2 { font-size: 18px; font-family: helvetica; }
        h3 { font-size: 14px; font-family: helvetica; }
        html { padding: 0 !important; margin: 0 !important; font-family: helvetica;  }
        .p1 { font-size: 10px }
        .inf { font-weight: bold; }
        .detailsTable {
            border-collapse: collapse;
            width: 100%;
            font-size: 11px;
        }

        .detailsTable td, #detailsTable th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        .detailsTable tr:nth-child(even){background-color: #f2f2f2;}

        .headTD{
            text-align: center;
            font-weight: bold;
            font-size: 11px;
            color: white;
        }
        .rTD{
            text-align: right;
            font-size: 11px;
        }
        .rTDW{
            text-align: right;
            font-weight: bold;
            font-size: 13px;
        }
    </style>
</head>
<body>

@foreach($travel as $item)

    <?php 
        $from_date = strtotime($item->from_date);
        $to_date = strtotime($item->to_date);
        $diff = $to_date - $from_date;
        $days = floor($diff / (60 * 60 * 24));

        $budget = DB::table('travel_details')->where('travel', $item->ref)->sum('budget');
    ?>

<div class="top" style="width: 100%; height: 20px; background:#0aa2a5; margin:0; padding: 0; "></div>

<div class="page" style="padding: 10px 50px">
    <table style="width: 100%; ">
        <tr class="tr1">
            <td width="70%"><img src="https://sales.magnitudeconstruction.com/imgs/logo.png" width="150px" height=""></td>
            <td width="30%">
                <h3 style="color:#0aa2a5">Magnitude Construction</h3>
                <p class="p1" style="border-left: 1px solid #0aa2a5; padding-left: 10px">
                    Jalan Hanoman No.14 <br>
                    80571 Ubud, Indonesia <br>
                    info@magnitudeconstruction.com <br>
                    <strong>www.magnitudeconstruction.com</strong>
                </p>
            </td>
        </tr>
    </table>

    <h2>TRAVEL BUSINESS FORM</h2>
    
    <table style="width: 50%; margin-top: 0px; float: left; border-top:1px solid #0aa2a5; padding-top: 10px">
        <tr class="tr2">
            <td>Employee Code : <span class="inf">{{ $item->code }}</span></td>
        </tr>
        <tr class="tr2">
            <td>Employee Name : <span class="inf">{{Str::upper( $item->pre)}} {{ $item->nom }}</span></td>
        </tr>
    </table>
    <table style="width: 50%; margin-top: 0px;  float: left; border-top:1px solid #0aa2a5; padding-top: 10px">
        <tr class="tr2">
            <td>Department : <span class="inf">{{ $item->dtitle }}</span></td>
        </tr>
        <tr class="tr2">
            <td>Position : <span class="inf">{{ $item->ptitle }}</span></td>
        </tr>
    </table>

    <table style="width: 100%;  border:1px solid #ddd; margin-top: 90px;">
        <tr class="tr2"  style="background: #ededed;">
            <td width="20%">Travel Purpose</td>
            <td><span class="inf">{{ $item->purpose }}</span></td>
        </tr>
        <tr class="tr2">
            <td width="20%">Travel Destination</td>
            <td><span class="inf">{{ $item->destination }}</span></td>
        </tr>
        <tr class="tr2"  style="background: #ededed;">
            <td width="20%">From </td>
            <td><span class="inf"><?php echo date('m/d/Y', strtotime($item->from_date)); ?></span></td>
        </tr>
        <tr class="tr2">
            <td width="20%">To </td>
            <td><span class="inf"><?php echo date('m/d/Y', strtotime($item->to_date)); ?></span></td>
        </tr>
        <tr class="tr2"  style="background: #ededed;">
            <td width="20%">Total Days</td>
            <td><span class="inf"><?php echo $days; ?> Days</span></td>
        </tr>
        <tr class="tr2" >
            <td width="20%" style="text-align:left;vertical-align:top;padding:7px;">Travel Agenda</td>
            <td><span class="inf">{{ $item->agenda }}</span></td>
        </tr>
    </table>

    <table class="detailsTable"  style="width: 100%; margin-top: 30px;" >
        <thead style="background-color: #0aa2a5;">
            <tr>
                <td class="headTD">Type of expense</td>
                <td class="headTD">Description</td>
                <td width="30%" class="headTD">Budget</td>
            </tr>
        </thead>
        <tbody>
        @foreach ($details as $item)
            <tr>
                <td>{{ $item->type }}</td>
                <td>{{ $item->description }}</td>
                <td class="rTD">{{ number_format($item->budget,2) }} IDR</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="rTDW"><span class="inf">TOTAL</span></td>
                <td class="rTDW"><?php echo number_format($budget,2); ?> IDR</td>
          </tr>
        </tfoot>
    </table>

    <table style="width: 100%; margin-top:20px;">
        <tr class="tr3">
            <td>Employee Signature : __________________________________ </td>
            <td>Date : __________________________________ </td>
        </tr>
        <tr class="tr3">
            <td>Supervisor Signature : __________________________________ </td>
            <td>Date : __________________________________ </td>
        </tr>
    </table>
    <table style="width: 100%; margin-top: 20px; border:1px solid #ededed;">
        <tr class="tr2">
            <td style="height: 120px;text-align:left;vertical-align:top;padding:7px;"><span class="inf"> Note :</span></td>
        </tr>
    </table>
</div>

<div class="bottom" style="width: 100%; height: 10px; background:#0aa2a5;  bottom: 0; position: absolute; left: 0; right: 0 "></div>
@endforeach

</body>
</html>