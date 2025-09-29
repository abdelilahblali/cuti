<?php use \App\Http\Controllers\Admin; ?>
<!DOCTYPE html>
<html>
@foreach($salaryslip as $item)
<head>
    <title>{{ $item->ref }}</title>
    <link rel="stylesheet" type="text/css" href="{{ public_path('bootstrap/css/bootstrap/bootstrap.css') }}">
    <style type="text/css">
        body { font-family: helvetica; }
        .tab1 { width: 100%; font-size: 12px; font-family: helvetica;  }
        .mgt10 { margin-top: 10px  } .mgt20 { margin-top: 0px  } .mgt30 { margin-top: 30px  } .mgt40 { margin-top: 40px  }
        .tr1 { border-right:1px solid rgba(0,0,0,0.1);  }
        .tr2 td { font-size: 9px; padding:5px 6px; font-weight:bold   }
        td { text-align: justify;  }
        h2 { font-size: 18px; font-family: helvetica; }
        h3 { font-size: 14px; font-family: helvetica; }
        html { padding: 0 !important; margin: 0 !important; font-family: helvetica;  }
        .p1 { font-size: 10px }
        .inf { font-weight: bold; }
    </style>
</head>
<body>


<div class="top" style="width: 100%; height: 20px; background:#34605F; margin:0; padding: 0; "></div>

<div class="page" style="padding: 10px 50px">
    <table style="width: 100%; ">
        <tr class="tr1">
            <td width="70%"><img src="https://sales.magnitudeconstruction.com/imgs/logo.png" width="150px" height=""></td>
            <td width="30%">
                <h3 style="color:#34605F">Magnitude Construction</h3>
                <p class="p1" style="border-left: 1px solid #34605F; padding-left: 10px">
                    Jalan Hanoman No.14 <br>
                    80571 Ubud, Indonesia <br>
                    info@magnitudeconstruction.com <br>
                    <strong>www.magnitudeconstruction.com</strong>
                </p>
            </td>
        </tr>
    </table>

    <h2>SALARY SLIP : {{ $item->period }}</h2>

    <?php $months = array( 1=>"Jan" , 2=>"Feb" , 3=>"Mar" , 4=>"Apr" , 5=>"May" , 6=>"June" , 7=>"July" , 8=>"Aug" , 9=>"Sept" , 10=>"Oct" , 11=>"Nov" , 12=>"Dec" ); $year = date('Y'); $sum=0; $sum2=0; $sum_month=0; ?>
    @for($i=1; $i<=12; $i++)
        <?php $nb_hours = Admin::calc_nb_overtimes($i, $year); $sum2 = $sum2 + $nb_hours; if($i==date('m')) { $sum_month = Admin::calc_nb_overtimes($i, $year); } ?>
    @endfor 

    @for($i=1; $i<=12; $i++)
        <?php $sum = $sum + Admin::calc_nb_leaves($i, $year);  ?>
    @endfor
    
    <table style="width: 100%; background: rgba(0,0,0,0.01);  margin-top: 0px; float: left; border:1px solid #ededed; border-top-color:#34605F; padding-top: 10px">
        <tr class="tr2"  style="background: #ededed;">
            <td width="30%">Employee Code</td>
            <td><span class="inf">{{ $item->code }}</span></td>
        </tr>
        <tr class="tr2">
            <td width="30%">Employee Name</td>
            <td><span class="inf">{{ $item->pre }} {{ $item->nom }}</span></td>
        </tr>
        <tr class="tr2"  style="background: #ededed;">
            <td width="30%">Position</td>
            <td><span class="inf">{{ $item->position }}</span></td>
        </tr>
        <tr class="tr2">
            <td width="30%">Available Day Off</td>
            <td><span class="inf">{{ 31 - $sum }}</span></td>
        </tr>
    </table>
</div>

<div class="page" style="padding: 10px 50px; margin-top: 100px; ">
    <h6> <img src="https://cuti.magnitudeconstruction.com/imgs/check.png" style="width: 15px; margin-right:10px; margin-top: 3px;"> INCOME</h6>
    <table style="width: 100%; margin-top: -10px; float: left; border:1px solid #ededed;">
        <tr class="tr2" style="background: #ededed;">
            <td width="30%">Base Salary</td>
            <td><span class="inf">{{ number_format($item->base_salary, 2) }} IDR</span></td>
        </tr>
        <tr class="tr2">
            <td width="30%">Transportation</td>
            <td><span class="inf">{{ number_format($item->transportation, 2) }} IDR</span></td>
        </tr>
        <tr class="tr2" style="background: #ededed;">
            <td width="30%">Overtime</td>
            <td><span class="inf">{{ number_format($item->overtime, 2) }} IDR</span></td>
        </tr>
        <tr class="tr2">
            <td width="30%">BPJS and TAX Allowance</td>
            <td><span class="inf">{{ number_format($item->bpjs, 2) }} IDR</span></td>
        </tr>
        <tr class="tr2" style="background: #ededed;">
            <td width="30%">Bonus</td>
            <td><span class="inf">{{ number_format($item->bonus, 2) }} IDR</span></td>
        </tr>
    </table>
</div>

<div class="page" style="padding: 10px 50px; margin-top: 100px; ">
    <h6><img src="https://cuti.magnitudeconstruction.com/imgs/check.png" style="width: 15px; margin-right:10px; margin-top: 3px;"> GROSS INCOME</h6>
    <table style="width: 100%; margin-top: -10px; float: left; border:1px solid #ededed">
        <tr class="tr2">
            <td width="30%">Base Salary</td>
            <td><span class="inf">{{ number_format($item->gross, 2) }} IDR</span></td>
        </tr>
    </table>
</div>

<div class="page" style="padding: 10px 50px; margin-top: 10px; ">
    <h6><img src="https://cuti.magnitudeconstruction.com/imgs/check.png" style="width: 15px; margin-right:10px; margin-top: 3px;"> DEDUCTION</h6>
    <table style="width: 100%; margin-top: -10px; float: left; border:1px solid #ededed">
        <tr class="tr2" style="background: #ededed;">
            <td width="30%">Income Tax</td>
            <td><span class="inf">{{ number_format($item->income, 2) }} IDR</span></td>
        </tr>
        <tr class="tr2">
            <td width="30%">BPJS Kesehatan</td>
            <td><span class="inf">{{ number_format($item->bpjs_kesehatan, 2) }} IDR</span></td>
        </tr>
        <tr class="tr2" style="background: #ededed;">
            <td width="30%">Other</td>
            <td><span class="inf">{{ number_format($item->other, 2) }} IDR</span></td>
        </tr>
        <tr class="tr2">
            <td width="30%">Total Deduction</td>
            <td><span class="inf">{{ number_format($item->deduction, 2) }} IDR</span></td>
        </tr>
    </table>
</div>

<div class="page" style="padding: 10px 50px; margin-top: 100px; ">
    <h6><img src="https://cuti.magnitudeconstruction.com/imgs/check.png" style="width: 15px; margin-right:10px; margin-top: 3px;"> NETT INCOME</h6>
    <table style="width: 100%; margin-top: -10px; float: left; border:1px solid #c3dfe0; background:#c3dfe0;">
        <tr class="tr2">
            <td width="30%">NETT INCOME</td>
            <td><span class="inf">{{ number_format($item->net, 2) }} IDR</span></td>
        </tr>
    </table>
</div>

<div class="page" style="padding: 10px 50px; margin-top: 100px; width: 100%; ">
    <span style="font-size: 9px; float: right; margin-right: 100px; font-weight: bold; ">
      *Salary is confidential, strictly forbidden to inform to others
    </span>
</div>


<div class="bottom" style="width: 100%; height: 10px; background:#34605F;  bottom: 0; position: absolute; left: 0; right: 0 "></div>


@endforeach

</body>
</html>