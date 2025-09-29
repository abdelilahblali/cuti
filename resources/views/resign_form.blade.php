<?php use \App\Http\Controllers\Admin; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Resignation Form</title>
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
        .p1 { font-size: 13px; text-align: justify;line-height: 1.5;}
        .val{font-size: 13px; text-align: justify;text-transform: capitalize;}
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

@foreach($resign as $item)

<div class="top" style="width: 100%; height: 20px; background:#0aa2a5; margin:0; padding: 0; "></div>

<div class="page" style="padding: 50px 60px">
    <!-- <table style="width: 100%; ">
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
    </table> -->

    <h4 style="text-align: center;">LETTER OF VOLUNTARY RESIGNATION</h4>
    <!-- <hr style="margin: 20px 0px; width: 50%; margin-left: 25%; margin-right: 25%;"> -->

    <br>
    <p class="p1" style="text-align: right; font-weight: bold;">Ubud, <?php echo date('jS F Y', strtotime($item->fait)); ?></p>
    <br>

    <p class="p1">
        I, {{ Str::title($item->nom) }} {{$item->pre}} voluntarily resign my position as {{$item->ptitle}}
        in the {{ Str::title($item->dtitle) }} Department of PT Magnitude Construction Bali, effective at the close of business on <?php echo date('jS F Y', strtotime($item->date));?>
    </p>

    <p class="p1">
        My reason for leaving is :  
    </p>

        <table style="width: 80%;">
            <tr>
                <td>
                    <label class="p1">
                        <input name="hire"  type="checkbox" @if($item->reason=='For Better Paying Job') checked @endif>
                        <span>For Better Paying Job</span>
                    </label>
                </td>
                <td>
                    <label class="p1">
                        <input name="hire"  type="checkbox" @if($item->reason=='Retirement') checked @endif>
                        <span>Retirement</span>
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="p1">
                        <input name="hire"  type="checkbox" @if($item->reason=='Health') checked @endif>
                        <span>Health</span>
                    </label>
                </td>
                <td>
                    <label class="p1">
                        <input name="hire"  type="checkbox" @if($item->reason=='Relocation') checked @endif>
                        <span>Relocation</span>
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="p1">
                        <input name="hire"  type="checkbox" @if($item->reason=='Commuting Problems') checked @endif>
                        <span>Commuting Problems</span>
                    </label>
                </td>
                <td>
                    <label class="p1">
                        <input name="hire"  type="checkbox" @if($item->reason=='Continue My Education') checked @endif>
                        <span>Continue My Education</span>
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="p1">
                        <input name="hire"  type="checkbox" @if($item->reason!='For Better Paying Job' or $item->reason!='Retirement' or $item->reason!='Health'  or $item->reason!='Relocation'  or $item->reason!='Commuting Problems'  or $item->reason!='Continue My Education' ) checked @endif>
                        <span>Other @if($item->reason!='For Better Paying Job' or $item->reason!='Retirement' or $item->reason!='Health'  or $item->reason!='Relocation'  or $item->reason!='Commuting Problems'  or $item->reason!='Continue My Education' ) : {{$item->reason}} @endif</span>
                    </label>
                </td>
            </tr>
        </table>

    <p class="p1">
        {{$item->description}}
        <br>
    </p>
        
    <p class="p1">
        My signature on this form indicates my decision to voluntarily resign my position (even when done in lieu of discharge).
        <p class="p1" style="font-weight: bold;">
            I do so with the understanding that the grievance process shall not be available to me to review this action, nor shall i be premitted to revoke this resignation once signed.
        </p>
        <br>
    </p>

    <p class="p1">
        <br>
        Sincerely,
        <br><br><br><br>
        {{ Str::title($item->nom) }} {{$item->pre}}
    </p>
   

   
</div>

<div class="bottom" style="width: 100%; height: 10px; background:#0aa2a5;  bottom: 0; position: absolute; left: 0; right: 0 "></div>
@endforeach

</body>
</html>