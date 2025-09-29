<?php use \App\Http\Controllers\Admin; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Resignation Checklist Form</title>
    <link rel="stylesheet" type="text/css" href="{{ public_path('bootstrap/css/bootstrap/bootstrap.css') }}">
    <style type="text/css">
        .tab1 { width: 100%; font-size: 12px; font-family: helvetica;  }
        .mgt10 { margin-top: 10px  } .mgt20 { margin-top: 0px  } .mgt30 { margin-top: 30px  } .mgt40 { margin-top: 40px  }
        .tr1 { border-right:1px solid rgba(0,0,0,0.1);  }
        .tr2 { font-size: 11px;   }
        .tr3 td { font-size: 11px; height: 70px;   }
        .td1 { border:1px solid rgba(0,0,0,0.1); }
        .var { background: rgba(0,0,0,0.05); padding: 3px; font-weight: bold  }
        td { text-align: justify;  }
        h1 { font-size: 14px }
        h3 { font-size: 14px; font-family: helvetica; }
        h4 { font-size: 12px; font-family: helvetica; }
        .t1 td { font-size: 11px  }
        .span1 { font-size: 12px; font-family: helvetica;  }
        .table1 { width: 100%; font-size: 11px; font-family: helvetica; border:1px solid rgba(0,0,0,0.1); padding: 10px }
        html { padding: 0 !important; margin: 0 !important; font-family: helvetica;  }
        .p1 { font-size: 10px }
        .p2 { font-size: 11px }
        .p3 { font-size: 15px; color: white;  }
        .inf { font-weight: bold; }
        .rotate1 { 
            -webkit-transform: rotate(20deg);
            -moz-transform: rotate(20deg);
            -o-transform: rotate(20deg);
            -ms-transform: rotate(20deg);
            transform: rotate(20deg); 
            margin-left: 130px; 
            width: 160px;
            margin-top: 30px;
        }
        .cachet { position: relative; }
        .signatureDate { padding-left: 150px; position: absolute; top:45px; left: 60px; font-size: 12px; font-weight: bold; color:#545454;  }
        .topLeft{text-align:left;vertical-align:top;padding-bottom: 5px;}
        .topCenter{text-align:center;vertical-align:top;padding-bottom: 5px;}
        .header {
            position: fixed;
            top: 0;
            width: 100%;
            height: 60px;
        }
        .footer {
                position: fixed;
                bottom: 0;
                width: 100%;
                height: 50px;
                font-size: 6pt;
                color: #777;
        }
    </style>
</head>
<body>

    <header class="header">
        <div class="top" style="width: 100%; height: 20px; background:#0aa2a5; margin:0; padding: 0; "></div>
    </header>
    <footer class="footer">
        <div class="bottom" style="width: 100%; height: 10px; background:#0aa2a5;  bottom: 0; position: absolute; left: 0; right: 0 "></div>
    </footer>

@foreach($resign as $item)


<div class="page" style="padding: 40px 60px">
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

    <br>
    <h3 style="text-align: center;">RESIGNATION CHECKLIST</h3>
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

    <table style="width: 100%;  border:1px solid #ddd; margin-top: 60px;">
        <tr class="tr2">
            <td width="20%">Manager</td>
            <td><span class="inf">{{Str::upper( $pre)}} {{ $nom }}<br></span></td>
        </tr>
        <tr class="tr2" style="background: #ededed;" >
            <td width="20%">Notice Periode</td>
            <td><span class="inf"><?php echo date('m/d/Y', strtotime($item->fait)); ?></span></td>
        </tr>
        <tr class="tr2">
            <td width="20%">Effective Resign Date</td>
            <td><span class="inf"><?php echo date('m/d/Y', strtotime($item->date)); ?></span></td>
        </tr>
        <tr class="tr2" style="background: #ededed;">
            <td width="20%">Reason</td>
            <td><span class="inf">{{ $item->reason }} <br></span></td>
        </tr>
        <tr class="tr2">
            <td width="20%">Description</td>
            <td><span class="inf">{{ $item->description }} <br></span></td>
        </tr>
    </table>
    <h4 class="card-title">Internal Communications</h4>
    <table style="width: 100%;" >
        <tbody>
        <tr class="tr2">
            <td class="topCenter">1</td>
            <td class="topLeft">Thank the employee for their contributions to your business, regardless of the circumstances of their departure</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="a1" id="a1" value="Yes" @if($item->a1=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">2</td>
            <td class="topLeft">Inform all relevant internal stakeholders that offboarding is being initiated</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="a2" id="a2" value="Yes" @if($item->a2=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">3</td>
            <td class="topLeft">Notify HR to prepare relevant paperwork, final paychecks, and termination of benefits</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="a3" id="a3" value="Yes" @if($item->a3=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">4</td>
            <td class="topLeft">Outline the offboarding process to the employee</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="a4" id="a4" value="Yes" @if($item->a4=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">5</td>
            <td class="topLeft">Inform the employee's team members and the wider company of their departure and finish date</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="a5" id="a5" value="Yes" @if($item->a5=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">6</td>
            <td class="topLeft">Create a transition plan</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="a6" id="a6" value="Yes" @if($item->a6=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">7</td>
            <td class="topLeft">Schedule an exit interview</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="a7" id="a7" value="Yes" @if($item->a7=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">8</td>
            <td class="topLeft">Initiate the process of recruiting for the employee's position, if applicable</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="a8" id="a8" value="Yes" @if($item->a8=='Yes') checked @endif></td>
        </tr>
        </tbody>
    </table>
    <h4 class="card-title">Handover Process</h4>
    <table  style="width: 100%;" >
        <tbody>
        <tr class="tr2">
            <td class="topCenter">1</td>
            <td class="topLeft">Create an offboarding messaging channel to keep all stakeholders informed of the handover process</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="b1" id="b1" value="Yes" @if($item->b1=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">2</td>
            <td class="topLeft">Ask the employee to document any required knowledge transfer</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="b2" id="b2" value="Yes" @if($item->b2=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">3</td>
            <td class="topLeft">Determine which team members will take over the departing employee's responsibilities, if applicable</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="b3" id="b3" value="Yes" @if($item->b3=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">4</td>
            <td class="topLeft">Inform team members of any temporary redistribution of responsibilities, re-routing of emails, etc.</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="b4" id="b4" value="Yes" @if($item->b4=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">5</td>
            <td class="topLeft">Notify internal and external stakeholders of their updated point of contact</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="b5" id="b5" value="Yes" @if($item->b5=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">6</td>
            <td class="topLeft">Schedule handover meetings with internal stakeholders, as required</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="b6" id="b6" value="Yes" @if($item->b6=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">7</td>
            <td class="topLeft">Schedule handover meetings with external clients, as required</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="b7" id="b7" value="Yes" @if($item->b7=='Yes') checked @endif></td>
        </tr>
        </tbody>
    </table>
    
    <div style="page-break-after: always;" ></div>

    <h4 class="card-title" style="margin-top: 70px;">Device and System Access</h4>
    <table  style="width: 100%;" >
        <tbody>
        <tr class="tr2"><tr class="tr2">
            <td class="topCenter">1</td>
            <td class="topLeft">Create a list of all company devices, equipment, access cards, etc. to retrieve, if one does not already exist</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="c1" id="c1" value="Yes" @if($item->c1=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">2</td>
            <td class="topLeft">Inform the employee of when and where this equipment must be returned</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="c2" id="c2" value="Yes" @if($item->c2=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">3</td>
            <td class="topLeft">Create a list of all apps and files the employee has access to, if one does not already exist</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="c3" id="c3" value="Yes" @if($item->c3=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">4</td>
            <td class="topLeft">Inform the employee of when their access to company resources will be revoked</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="c4" id="c4" value="Yes" @if($item->c4=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">5</td>
            <td class="topLeft">Identify any files or systems that the employee has sole ownership of, and arrange for transfer of ownership</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="c5" id="c5" value="Yes" @if($item->c5=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">6</td>
            <td class="topLeft">Reset two-factor authentication (2FA) to remove the departing employee's contact details</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="c6" id="c6" value="Yes" @if($item->c6=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">7</td>
            <td class="topLeft">If operating BYOD (Bring Your Own Device), arrange for company files and access to be removed from the employee's personal devices</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="c7" id="c7" value="Yes" @if($item->c7=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">8</td>
            <td class="topLeft">Revoke and reset all system, app, and software access on the appropriate date</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="c8" id="c8" value="Yes" @if($item->c8=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">9</td>
            <td class="topLeft">Deactivate the employee's profiles on company apps, such as Slack</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="c9" id="c9" value="Yes" @if($item->c9=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">10</td>
            <td class="topLeft">Re-route employee emails and any other critical communications on the appropriate date</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="c10" id="c10" value="Yes" @if($item->c10=='Yes') checked @endif></td>
        </tr>
        </tbody>
    </table>

    <h4 class="card-title">Remote Employees</h4>
    <table  style="width: 100%;" >
        <tbody>
        <tr class="tr2">
            <td class="topCenter">1</td>
            <td class="topLeft">Ensure all handover meetings and exit interviews are scheduled virtually</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="d1" id="d1" value="Yes" @if($item->d1=='Yes') checked @endif></td>
            </tr>
        <tr class="tr2">
            <td class="topCenter">2</td>
            <td class="topLeft">Arrange for all company equipment to be returned by courier, if applicable</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="d2" id="d2" value="Yes" @if($item->d2=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">3</td>
            <td class="topLeft">Remotely wipe or secure company devices before they are transferred to a courier</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="d3" id="d3" value="Yes" @if($item->d3=='Yes') checked @endif></td>
        </tr>
            <tr class="tr2">
            <td class="topCenter">4</td>
            <td class="topLeft">Terminate VPN access</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="d4" id="d4" value="Yes" @if($item->d4=='Yes') checked @endif></td>
        </tr>
        </tbody>
    </table>

    <h4 class="card-title">Exit Interview</h4>
    <table  style="width: 100%;" >
    <tbody>
        <tr class="tr2">
            <td class="topCenter">1</td>
            <td class="topLeft">Perform exit interview and document all feedback</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="e1" id="e1" value="Yes" @if($item->e1=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">2</td>
            <td class="topLeft">Provide employer reference and other exit documentation, as required</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="e2" id="e2" value="Yes" @if($item->e2=='Yes') checked @endif></td>
        </tr>
        <tr class="tr2">
            <td class="topCenter">3</td>
            <td class="topLeft">Update employee's contact details so they can be reached in future if needed</td>
            <td class="topCenter"><input type="checkbox" class="form-check-input " name="e3" id="e3" value="Yes" @if($item->e3=='Yes') checked @endif></td>
        </tr>
        </tbody>
    </table>
    <table style="width: 100%; margin-top:20px;">
        <tr class="tr3">
            <td>Employee Signature : __________________________________ </td>
            <td>Date : __________________________________ </td>
        </tr>
        <tr class="tr3">
            <td>Manager Signature : __________________________________ </td>
            <td>Date : __________________________________ </td>
        </tr>
    </table>
</div>

@endforeach

</body>
</html>