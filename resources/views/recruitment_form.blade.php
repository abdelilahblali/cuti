<?php use \App\Http\Controllers\Admin; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Staff Recruitment Request Form</title>
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
        .inf { font-weight: bold; line-height: 1.7; font-size: 10px;}
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
        label {
            position: relative;
            padding-left: 20px;
            margin-top: -5px;
        }

        label input {
            position: absolute;
            top: 0;
            left: 0;
        }
    </style>
</head>
<body>

@foreach($recruitment as $item)

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

    <h2>RECRUITMENT REQUEST FORM</h2>

    <table style="width: 100%; background: rgba(0,0,0,0.01);  margin-top: 0px; float: left; border:1px solid #ededed; border-top-color:#0aa2a5; padding-top: 10px">
        <tr class="tr2"  style="background: #ededed;">
            <td width="20%">Employee Code</td>
            <td><span class="inf">{{ $item->code }}</span></td>
        </tr>
        <tr class="tr2">
            <td width="20%">Employee Name</td>
            <td><span class="inf">{{Str::upper( $item->pre)}} {{ $item->nom }}</span></td>
        </tr>
        <tr class="tr2"  style="background: #ededed;">
            <td width="20%">Departement</td>
            <td><span class="inf">{{ $item->dtitle }}</span></td>
        </tr>
        <tr class="tr2">
            <td width="20%">Position</td>
            <td><span class="inf">{{ $item->ptitle }}</span></td>
        </tr>
    </table>
    
    <!-- <table style="width: 50%; margin-top: 0px; float: left; border-top:1px solid #0aa2a5; padding-top: 10px">
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
    </table> -->

    <table style="width: 100%;  border:1px solid #ddd; margin-top: 150px;">
        <tr class="tr2">
            <td width="20%">Date of Request</td>
            <td style="padding: 10px 10px;"><span class="inf"><?php echo date('m/d/Y', strtotime($item->fait)); ?></span></td>
        </tr>
        <tr class="tr2"  style="background: #ededed;">
            <td width="20%">Type</td>
            <td style="padding: 10px 10px;">
                <label>
                    <input name="type"  type="checkbox" @if($item->type=='Full Time') checked @endif>
                    <span class="inf">Full Time</span>
                </label>
                <label style="margin-left: 20px;">
                    <input name="type"  type="checkbox"  @if($item->type=='Part Time') checked @endif>
                    <span class="inf">Part Time</span>
                </label>
            </td>
        <tr class="tr2">
            <td width="20%">Hire Reason</td>
            <td style="padding: 10px 10px;">
                 <label>
                    <input name="hire"  type="checkbox" @if($item->hire=='New') checked @endif>
                    <span class="inf">New</span>
                </label>
                <label style="margin-left: 45px;">
                    <input name="hire"  type="checkbox"  @if($item->hire=='Replacing') checked @endif>
                    <span class="inf">Replacing</span>
                </label>
            </td>
        </tr>
        <tr class="tr2"  style="background: #ededed;">
            <td width="20%">Replacing (name) </td>
            <td style="padding: 10px 10px;"><span class="inf">@if($item->hire=='Replacing') {{ $item->replacing }} @else - @endif</span></td>
        </tr>
        <tr class="tr2">
            <td width="20%">Reason </td>
            <td style="padding: 10px 10px;"><span class="inf">{{ $item->reason }}</span></td>
        </tr>
        <tr class="tr2"  style="background: #ededed;">
            <td width="20%">Title</td>
            <td style="padding: 10px 10px;"><span class="inf">{{ $item->title }}</span></td>
        </tr>
        <tr class="tr2" >
            <td width="20%" style="text-align:left;vertical-align:top;padding:7px;">Salary Range</td>
            <td style="padding: 10px 10px;"><span class="inf">@if($item->salary!=''){{ $item->salary }}@else - @endif</span></td>
        </tr>
        <tr class="tr2"  style="background: #ededed;">
            <td width="20%" style="text-align:left;vertical-align:top;padding:20px 10px !important;">Position Description</td>
            <td style="padding: 10px 10px;"><span class="inf">{{ $item->description }}</span></td>
        </tr>
        <tr class="tr2" >
            <td width="20%" style="text-align:left;vertical-align:top;padding:20px 10px !important;">Duties</td>
            <td style="padding: 10px 10px;"><span class="inf">{{ $item->duties }}</span></td>
        </tr>
        <tr class="tr2"  style="background: #ededed;">
            <td width="20%" style="text-align:left;vertical-align:top;padding:20px 10px !important;">Requirements</td>
            <td style="padding: 10px 10px;"><span class="inf">@if($item->requirement!=''){{ $item->requirement }}@else - @endif</span></td>
        </tr>
        <tr class="tr2" >
            <td width="20%" style="text-align:left;vertical-align:top;padding:20px 10px !important;">Equipments</td>
            <td style="padding: 10px 10px;"><span class="inf">@if($item->equipment!=''){{ $item->equipment }}@else - @endif</span></td>
        </tr>
        <tr class="tr2"  style="background: #ededed;">
            <td width="20%" style="text-align:left;vertical-align:top;padding:20px 10px !important;">Additional Requirements</td>
            <td style="padding: 10px 10px;"><span class="inf">@if($item->additional!=''){{ $item->additional }}@else - @endif</span></td>
        </tr>
    </table>
</div>

<div class="bottom" style="width: 100%; height: 10px; background:#0aa2a5;  bottom: 0; position: absolute; left: 0; right: 0 "></div>
@endforeach

</body>
</html>