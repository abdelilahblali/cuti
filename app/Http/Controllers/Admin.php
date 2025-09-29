<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use  App\Mail\Notification;
use  App\Mail\Notif;
use PDF;
use Illuminate\Support\Facades\Route;

use \Statickidz\GoogleTranslate;
use DateTime;
use DateInterval;
use DatePeriod;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;


class Admin extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
    * Show the application dashboardboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */

    public function index()
    {
        $clis = DB::table('clis')->where('type', '!=', 'admin')->orderBy('nom', 'asc')->get();

        $All_clis = DB::table('clis')->get();
        foreach ($All_clis as $c) {
            DB::table('clis')->where('username', $c->username)->update([ 'email' => $c->username,  ]);
        }

        $notifications = DB::table('notification')->where('cli', Auth::user()->ref)->orderBy('fait', 'desc')->limit(5)->get();
        $leaves = DB::table('leaves')->where('cli', Auth::user()->ref)->limit(5)->get();
        return view('home', [ 'clis' => $clis, 'notifications' => $notifications , 'leaves' => $leaves, 'aa' => 200,  ]);
    }

    public function home()
    {
        $clis = DB::table('clis')->where('type', '!=', 'admin')->orderBy('nom', 'asc')->get();
        $notifications = DB::table('notification')->where('cli', Auth::user()->ref)->orderBy('fait', 'desc')->limit(5)->get();
        $leaves = DB::table('leaves')->where('cli', Auth::user()->ref)->limit(5)->get();
        return view('home', [ 'clis' => $clis, 'notifications' => $notifications , 'leaves' => $leaves, ]);
    }

    public function admin()
    {
        $clis = DB::table('clis')->where('type', '!=', 'admin')->orderBy('nom', 'asc')->get();
        $notifications = DB::table('notification')->where('cli', Auth::user()->ref)->orderBy('fait', 'desc')->limit(5)->get();
        $leaves = DB::table('leaves')->where('cli', Auth::user()->ref)->limit(5)->get();
        return view('home', [ 'clis' => $clis, 'notifications' => $notifications , 'leaves' => $leaves, ]);
    }    

    // function Leaves

    public static function calc_nb_leaves($month, $year)
    {
        $leaves = DB::table('leaves')->where('cli', Auth::user()->ref)->where('act', 1)->get();
        $nb_jours = 0;  $uniteAdd = 1;
        foreach($leaves as $l)
        {
            $begin = new DateTime($l->from_date);
            $end = date('Y-m-d', strtotime($l->to_date . ' 1 day'));
            $end = new DateTime($end);

            if($l->halfday=='YES'){ $uniteAdd = 0.5; } else { $uniteAdd = 1; }

            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($begin, $interval, $end);

            foreach ($period as $dt) {
                $y = $dt->format("Y");
                $m = $dt->format("m");
                $l = $dt->format("l");
                if($year==$y && $month==$m && $l!='Saturday' && $l!='Sunday'){ $nb_jours = $nb_jours + $uniteAdd; }
            }
        }
        return $nb_jours;
    }

    public static function calc_nb_leaves_byUser($month, $year, $cli)
    {
        $leaves = DB::table('leaves')->where('cli', $cli)->where('act', 1)->get();
        $nb_jours = 0; $uniteAdd = 1;
        foreach($leaves as $l)
        {
            $begin = new DateTime($l->from_date);
            $end = date('Y-m-d', strtotime($l->to_date . ' 1 day'));
            $end = new DateTime($end);

            if($l->halfday=='YES'){ $uniteAdd = 0.5; } else { $uniteAdd = 1; }

            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($begin, $interval, $end);

            foreach ($period as $dt) {
                $y = $dt->format("Y");
                $m = $dt->format("m");
                $l = $dt->format("l");
                if($year==$y && $month==$m && $l!='Saturday' && $l!='Sunday'){ $nb_jours = $nb_jours + $uniteAdd; }
            }
        }
        return $nb_jours;
    }

    // function Overtimes

    public static function calc_nb_overtimes($month, $year)
    {
        $overtimes = DB::table('overtimes')->where('cli', Auth::user()->ref)->where('act', 1)->get();
        $nb_hours = 0;
        foreach($overtimes as $l)
        {
            $m = date('m', strtotime($l->from_date));
            $y = date('Y', strtotime($l->from_date));

            if($year==$y && $month==$m) {
                $start = strtotime($l->from_time);
                $end = strtotime($l->to_time);
                $d = round(abs($end - $start) / 3600,2);
                $nb_hours = $nb_hours + $d;
            }
        }
        return $nb_hours;
    }


    public static function calc_nb_overtimes_byUser($month, $year, $cli)
    {
        $overtimes = DB::table('overtimes')->where('cli', $cli)->where('act', 1)->get();
        $nb_hours = 0;
        foreach($overtimes as $l)
        {
            $m = date('m', strtotime($l->from_date));
            $y = date('Y', strtotime($l->from_date));

            if($year==$y && $month==$m) {
                $start = strtotime($l->from_time);
                $end = strtotime($l->to_time);
                $d = round(abs($end - $start) / 3600,2);
                $nb_hours = $nb_hours + $d;
            }
        }
        return $nb_hours;
    }

    public static function cacul_pourcentage($nombre,$total,$pourcentage)
    { 
      $resultat = ($nombre/$total) * $pourcentage;
      return round($resultat); 
    } 

    public static function calcul_hours($start,$end)
    { 
        $start = strtotime($start);
        $end = strtotime($end);
        $difference = round(abs($end - $start) / 3600,2);
        return $difference;
    } 

    // users ######################
    public function users()
    {

        $departments = DB::table('departments')->orderBy('code', 'asc')->get();
        // DB::table('clis')->update([ 'code' => '',  ]);

        foreach($departments as $d){
            $users = DB::table('clis')->where('department', $d->ref)->get();
            foreach($users as $u) {
                if($u->code=='' && $u->department!='') {
                    
                    $ref = DB::table('clis')->select('code')->orderBy('code','desc')->limit(1)->value('code') ;
                    
                    $maxCode=substr($ref,3,4);
                    $maxCode=(int)$maxCode + 1;
                    $ex=$d->code."-";
                        
                    if($maxCode<10)  $code=$ex."00".$maxCode;
                    else if($maxCode>=10 and $maxCode<100)  $code=$ex."0".$maxCode;
                    else if($maxCode>=100) $code=$ex."".$maxCode;

                    if($code!="") { DB::table('clis')->where('ref', $u->ref)->update([ 'code' => $code,  ]); }
                }
            }
        }

        $users = DB::table('clis')->where('username', '!=', 'admin')->orderBy('nom', 'asc')->get();
        return view('users', ['users' => $users ]);
    }

    // users ######################
    public function users_update($ref)
    {
        $users = DB::table('clis')
        ->where('ref', $ref)
        ->get();

        $departments = DB::table('departments')->get();
        $positions = DB::table('positions')->get();
        $managers = DB::table('clis')->where('category', 'Manager')->get();

        return view('users_update', ['users' => $users, 'departments' => $departments, 'positions' => $positions, 'managers' => $managers ]);
    }

    public function users_updated(Request $req, $ref)
    {

        DB::table('clis')
        ->where('ref', $ref)
        ->update(
        [   'department' => $req->input('department'),
            'position' => $req->input('position'),
            'category' => $req->input('category'),
            'manager' => $req->input('manager'),
        ] );
        return back();
    }

    public static function usersGetManager($ref)
    {
        $user_ref = DB::table('clis')->where('ref', $ref)->value('manager');
        return DB::table('clis')->where('ref', $user_ref)->value('nom').' '.DB::table('clis')->where('ref', $user_ref)->value('pre');;
    }

    public static function usersGetDepartment($ref)
    {
        return DB::table('departments')->where('ref', $ref)->value('title');
    }

    public static function usersGetPosition($ref)
    {
        return DB::table('positions')->where('ref', $ref)->value('title');
    }

    public function usersEtat($act)
    {
        $users = DB::table('clis')
        ->where('username', '!=', 'admin')
        ->where('act', $act)
        ->orderBy('nom', 'asc')
        ->get();
        return view('users', ['users' => $users ]);
    }

    public function usersEditAct($ref, $act)
    {
        DB::table('clis')->where('ref', $ref)->update([ 'act' => $act,  ]);

        // add notification basic
        $fait=date("Y/m/d H:i:s");
        DB::table('notification')->insert(
        ['cli' => $ref,
        'type' => 'information',
        'msg' => 'We inform you that your account is activated',
        'vu' => '0',
        'fait' => $fait  ] );


        //Send notification ***********************************************
        if($act==1){ 
            $user_email = DB::table('clis')->where('ref', $ref)->value('username');
            $user_ref = $ref;
            $notification = 'Account Confirmed';
            $emails = array(); array_push($emails, $user_email); if(count($emails)!=0){ foreach($emails as $em) { if($em!='') { \Mail::to($em)->send(new Notif($notification, $user_ref) ); } } } 
        }

        session()->flash('yes',"Item has been updated successfully"); 
        return back();
    }

    // My Account ######################

    public function user_notifications()
    {
        $notifications = DB::table('notification')->where('cli', Auth::user()->ref)->orderBy('fait', 'desc')->get();
        DB::table('notification')->where('cli', Auth::user()->ref)->update([ 'vu' => 1,  ]);
        return view('notifications', ['notifications' => $notifications ]);
    }

    public function user_profil()
    {
        $manager = DB::table('clis')->where('ref', Auth::user()->ref)->value('manager');
        $managers = DB::table('clis')->where('category', 'Manager')->where('ref', '!=',Auth::user()->ref )->get();

        $departments = DB::table('departments')->get();
        $positions = DB::table('positions')->get();

        return view('user_profil', [ 'managers' => $managers, 'manager' => $manager, 'departments' => $departments, 'positions' => $positions ]);
    }

    public function user_profil_updated(Request $req)
    {
        DB::table('clis')->where('ref', Auth::user()->ref)->update([ 
            'pre' => ucfirst(strtolower($req->input('pre'))),
            'nom' => strtoupper($req->input('nom')),
            'phone' => $req->input('phone'), 

            'department' => $req->input('department'), 
            'position' => $req->input('position'), 

            'manager' => $req->input('manager'),  ]);

        session()->flash('yes',"Information has been updated successfully"); 
        return back();
    }

    public function user_photo_updated(Request $req)
    {
        DB::table('clis')->where('ref', Auth::user()->ref)->update([ 'img' => $req->input('img'), ]);
       
        session()->flash('yes',"The picture has been updated successfully"); 
        return back();
    }

    public function user_password()
    {
        return view('user_password');
    }

    public function user_password_updated(Request $req)
    {
        if($req->input('password')==$req->input('password2') && Auth::user()->username==$req->input('username'))
        {
            DB::table('clis')->where('ref', Auth::user()->ref)->update([ 'password' => Hash::make($req->input('password')), ]);
            session()->flash('yes',"The password has been updated successfully"); 
        } else {
            session()->flash('no',"Incorrect information"); 
        }
        
        return view('user_password');
    }

    // Leave  ######################
    public function leave_add()
    {
        return view('leave_add');
    }

    public function leave_added(Request $req)
    {
        $to_date = $req->input('to_date');
        if($req->input('halfday')=='YES') { $to_date = $req->input('from_date'); }

        $fait=date("Y/m/d H:i:s");
        $id = substr(str_shuffle("1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890"),0,24); $b = date("dmyHis"); $id = $id.$b;
        DB::table('leaves')->insert(
        ['ref' => $id,
        'cli' => Auth::user()->ref,
        'from_date' => $req->input('from_date'),
        'from_time' => $req->input('from_time'),
        'to_date' => $to_date,
        'to_time' => $req->input('to_time'),
        'raison' => $req->input('raison'),
        'note' => $req->input('note'),
        'halfday' => $req->input('halfday'),
        'act' => '0',
        'fait' => $fait  ] );

        // get user infos
        $user_nom = DB::table('clis')->where('ref', Auth::user()->ref)->value('nom');
        $user_pre = DB::table('clis')->where('ref', Auth::user()->ref)->value('pre');

        // get manager infos
        $manager_ref = DB::table('clis')->where('ref', Auth::user()->ref)->value('manager');
        $manager_mail = DB::table('clis')->where('ref', $manager_ref)->value('username');

        // add notification basic
        $fait=date("Y/m/d H:i:s");
        DB::table('notification')->insert(
        ['cli' => $manager_ref,
        'type' => 'information',
        'msg' => 'You have a new leave request awaiting confirmation from : '.$user_nom.' '.$user_pre,
        'vu' => '0',
        'fait' => $fait  ] );

        //Send notification ***********************************************
        $user_email = $manager_mail;
        $user_ref = Auth::user()->ref;
        $notification = 'New Leave Request';
        $emails = array(); array_push($emails, $user_email); if(count($emails)!=0){ foreach($emails as $em) { if($em!='') { \Mail::to($em)->send(new Notif($notification, $user_ref) ); } } } 

        session()->flash('yes',"The request has been added successfully"); 
        return redirect('leave_etat/0');
    }

    public function leave_etat($etat)
    {
        $leaves = DB::table('leaves')->where('cli', Auth::user()->ref)->where('act', $etat)->orderBy('from_date', 'desc')->get();
        return view('leaves', [ 'leaves' => $leaves ]);
    }

    public function leave_edit($ref)
    {
        $leaves = DB::table('leaves')->where('cli', Auth::user()->ref)->where('ref', $ref)->get();
        return view('leave_edit', [ 'leaves' => $leaves ]);
    }

    public function leave_edited(Request $req, $ref)
    {
        $to_date = $req->input('to_date');
        if($req->input('halfday')=='YES') { $to_date = $req->input('from_date'); }

        DB::table('leaves')->where('cli', Auth::user()->ref)->where('ref', $ref)->update([ 
            'from_date' => $req->input('from_date'),
            'from_time' => $req->input('from_time'),
            'to_date' => $to_date,
            'to_time' => $req->input('to_time'),
            'raison' => $req->input('raison'),
            'halfday' => $req->input('halfday'),
            'note' => $req->input('note'),  ]);
        session()->flash('yes',"The request has been updpated successfully"); 
        return back();
    }

    public function leave_update_admin($ref)
    {   
        if(Auth::user()->type=='admin') { 
            $leaves = DB::table('leaves')->where('ref', $ref)->get();
            $cli_ref = DB::table('leaves')->where('ref', $ref)->value('cli');
            $cli_nom = DB::table('clis')->where('ref', $cli_ref)->value('nom');
            $cli_pre = DB::table('clis')->where('ref', $cli_ref)->value('pre');
            return view('leave_update_admin', [ 'leaves' => $leaves, 'cli' => $cli_nom.' '.$cli_pre ]);
        }
    }

    public function leave_updated_admin(Request $req, $ref)
    {
        if(Auth::user()->type=='admin') { 
            $to_date = $req->input('to_date');
            if($req->input('halfday')=='YES') { $to_date = $req->input('from_date'); }

            DB::table('leaves')->where('ref', $ref)->update([ 
                'from_date' => $req->input('from_date'),
                'from_time' => $req->input('from_time'),
                'to_date' => $to_date,
                'to_time' => $req->input('to_time'),
                'raison' => $req->input('raison'),
                'halfday' => $req->input('halfday'),
                'note' => $req->input('note'),  ]);
            session()->flash('yes',"The request has been updpated successfully"); 
            return back();
        }
    }

    public function leave_deleted_admin($ref)
    {   
        if(Auth::user()->type=='admin') { 
            DB::table('leaves')->where('ref', $ref)->delete();
            session()->flash('yes',"The request has been deleted successfully"); 
            return redirect('manager_leaves_calendar');
        }
    }

    public function leave_deleted($ref)
    {
        DB::table('leaves')->where('cli', Auth::user()->ref)->where('ref', $ref)->delete();
        session()->flash('yes',"The request has been deleted successfully"); 
        return back();
    }

    public function leave_calendar()
    {
        $leaves = DB::table('leaves')->where('cli', Auth::user()->ref)->get();
        return view('leave_calendar', [ 'leaves' => $leaves ]);
    }

    // overtime  ######################
    public function overtimes_add()
    {
        return view('overtimes_add');
    }

    public function overtimes_added(Request $req)
    {
        $fait=date("Y/m/d H:i:s");
        $id = substr(str_shuffle("1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890"),0,24); $b = date("dmyHis"); $id = $id.$b;
        DB::table('overtimes')->insert(
        ['ref' => $id,
        'cli' => Auth::user()->ref,
        'from_date' => $req->input('from_date'),
        'from_time' => $req->input('from_time'),
        'to_date' => $req->input('from_date'),
        'to_time' => $req->input('to_time'),
        'raison' => $req->input('raison'),
        'note' => $req->input('note'),
        'act' => '0',
        'fait' => $fait  ] );

        // get user infos
        $user_nom = DB::table('clis')->where('ref', Auth::user()->ref)->value('nom');
        $user_pre = DB::table('clis')->where('ref', Auth::user()->ref)->value('pre');

        // get manager infos
        $manager_ref = DB::table('clis')->where('ref', Auth::user()->ref)->value('manager');
        $manager_mail = DB::table('clis')->where('ref', $manager_ref)->value('username');

        // add notification basic
        $fait=date("Y/m/d H:i:s");
        DB::table('notification')->insert(
        ['cli' => $manager_ref,
        'type' => 'information',
        'msg' => 'You have a new overtime request awaiting confirmation from : '.$user_nom.' '.$user_pre,
        'vu' => '0',
        'fait' => $fait  ] );

        //Send notification ***********************************************
        $user_email = $manager_mail;
        $user_ref = Auth::user()->ref;
        $notification = 'New Overtime Request';
        $emails = array(); array_push($emails, $user_email); if(count($emails)!=0){ foreach($emails as $em) { if($em!='') { \Mail::to($em)->send(new Notif($notification, $user_ref) ); } } } 

        session()->flash('yes',"The request has been added successfully"); 
        return redirect('overtimes_etat/0');
    }

    public function overtimes_etat($etat)
    {
        $overtimes = DB::table('overtimes')->where('cli', Auth::user()->ref)->where('act', $etat)->get();
        return view('overtimes', [ 'overtimes' => $overtimes ]);
    }

    public function overtimes_edit($ref)
    {
        $overtimes = DB::table('overtimes')->where('cli', Auth::user()->ref)->where('ref', $ref)->get();
        return view('overtimes_edit', [ 'overtimes' => $overtimes ]);
    }

    public function overtimes_edited(Request $req, $ref)
    {
        DB::table('overtimes')->where('cli', Auth::user()->ref)->where('ref', $ref)->update([ 
            'from_date' => $req->input('from_date'),
            'from_time' => $req->input('from_time'),
            'to_date' => $req->input('from_date'),
            'to_time' => $req->input('to_time'),
            'raison' => $req->input('raison'),
            'note' => $req->input('note'),  ]);
        session()->flash('yes',"The request has been updpated successfully"); 
        return back();
    }

    public function overtimes_deleted($ref)
    {
        DB::table('overtimes')->where('cli', Auth::user()->ref)->where('ref', $ref)->delete();
        session()->flash('yes',"The request has been deleted successfully"); 
        return back();
    }

    public function overtimes_calendar()
    {
        $overtimes = DB::table('overtimes')->where('cli', Auth::user()->ref)->get();
        return view('overtimes_calendar', [ 'overtimes' => $overtimes ]);
    }

    // manager leaves ######################

    public function manager_team()
    {
        $users = DB::table('clis')
        ->where('username', '!=', 'admin')
        ->where('ref', '!=', Auth::user()->ref)
        ->orderBy('nom', 'asc')
        ->get();

        if(Auth::user()->type!='admin'){
        $users = $users->where('manager', Auth::user()->ref);
        }

        return view('manager_team', ['users' => $users ]);
    }

    public function manager_leaves_recap()
    {
        $users = DB::table('clis')
        ->where('username', '!=', 'admin')
        ->orderBy('nom', 'asc')
        ->get();

        if(Auth::user()->type!='admin'){
        $users = $users->where('manager', Auth::user()->ref);
        }

        $year = date("Y");

        return view('manager_leaves_recap', ['users' => $users, 'year' => $year ]);
    }

    public function manager_leaves_recap_update_year(Request $req)
    {
        $year = $req->input('year');

        $users = DB::table('clis')
        ->where('username', '!=', 'admin')
        ->orderBy('nom', 'asc')
        ->get();

        if(Auth::user()->type!='admin'){
        $users = $users->where('manager', Auth::user()->ref);
        }

        return view('manager_leaves_recap', ['users' => $users, 'year' => $year ]);
    }

    public function manager_leaves($etat)
    {
        $leaves = DB::table('leaves')
        ->select('leaves.ref as ref', 'from_date', 'from_time', 'to_date', 'to_time', 'raison', 'leaves.act as act', 'nom', 'pre')
        ->join('clis', 'clis.ref', 'leaves.cli')
        ->where('manager',  Auth::user()->ref)
        ->where('leaves.act', $etat)
        ->orderBy('from_date', 'desc')
        ->get();
        return view('manager_leaves', [ 'leaves' => $leaves ]);
    }

    public function manager_leaves_all()
    {
        $leaves = DB::table('leaves')
        ->select('leaves.ref as ref', 'from_date', 'from_time', 'to_date', 'to_time', 'raison', 'leaves.act as act', 'nom', 'pre', 'clis.ref as cref')
        ->join('clis', 'clis.ref', 'leaves.cli')
        ->where('leaves.act', 0)
        ->get();
        return view('manager_leaves_all', [ 'leaves' => $leaves ]);
    }

    public function manager_leaves_show($ref)
    {
        $leaves = DB::table('leaves')->where('ref', $ref)->get();
        return view('manager_leaves_show', [ 'leaves' => $leaves ]);
    }

    public function manager_leaves_delete($ref)
    {
        DB::table('leaves')->where('ref', $ref)->delete();
        session()->flash('yes',"The element has been deleted successfully"); 
        return back();
    }

    public function manager_leaves_edit_etat($ref, $act)
    {
        DB::table('leaves')->where('ref', $ref)->update([ 'act' => $act,  ]);

        $user_ref = DB::table('leaves')->where('ref', $ref)->value('cli');
        $user_email = DB::table('clis')->where('ref', $user_ref)->value('username');

        // confirmed
        if($act==1) {
            // add notification basic
            $fait=date("Y/m/d H:i:s");
            DB::table('notification')->insert(
            ['cli' => $user_ref,
            'type' => 'information',
            'msg' => 'We inform you that a request has been accepted by your Manager, you can check in your dashboard',
            'vu' => '0',
            'fait' => $fait  ] );


            //Send notification ***********************************************
            if($act==1){ 
                $notification = 'Leave Confirmed';
                $emails = array(); array_push($emails, $user_email); if(count($emails)!=0){ foreach($emails as $em) { if($em!='') { \Mail::to($em)->send(new Notif($notification, $user_ref) ); } } } 
            }
        }

        // canceled
        if($act==-1) {
            // add notification basic
            $fait=date("Y/m/d H:i:s");
            DB::table('notification')->insert(
            ['cli' => $user_ref,
            'type' => 'information',
            'msg' => 'We inform you that a request has been refused by your Manager, you can check in your dashboard',
            'vu' => '0',
            'fait' => $fait  ] );


            //Send notification ***********************************************
            if($act==1){ 
                $notification = 'Leave Canceled';
                $emails = array(); array_push($emails, $user_email); if(count($emails)!=0){ foreach($emails as $em) { if($em!='') { \Mail::to($em)->send(new Notif($notification, $user_ref) ); } } } 
            }
        }

        session()->flash('yes',"Item has been updated successfully"); 
        return back();
    }

    public function manager_leaves_calendar()
    {
        
        if(Auth::user()->type=='admin'){
            $leaves = DB::table('leaves')
            ->select('leaves.ref as ref', 'from_date', 'from_time', 'to_date', 'to_time', 'raison', 'leaves.act as act', 'nom', 'pre')
            ->join('clis', 'clis.ref', 'leaves.cli')
            ->where('leaves.act', 1)
            ->get();
        } 
        //Gave access to Djime 
        elseif(Auth::user()->username=='djimetandiarchitect@gmail.com'){
            $leaves = DB::table('leaves')
            ->select('leaves.ref as ref', 'from_date', 'from_time', 'to_date', 'to_time', 'raison', 'leaves.act as act', 'nom', 'pre', 'positions.title')
            ->join('clis', 'clis.ref', 'leaves.cli')
            ->leftjoin('positions', 'clis.position', 'positions.ref')
            ->where('leaves.act', 1)
            ->where('manager',  '200223073317169852')
            ->get();

        }
        else {
            $leaves = DB::table('leaves')
            ->select('leaves.ref as ref', 'from_date', 'from_time', 'to_date', 'to_time', 'raison', 'leaves.act as act', 'nom', 'pre')
            ->join('clis', 'clis.ref', 'leaves.cli')
            ->where('manager',  Auth::user()->ref)
            ->where('leaves.act', 1)
            ->get();
        }

        $users = DB::table('clis')
        ->where('username', '!=', 'admin')
        ->orderBy('nom', 'asc')
        ->get();

        if(Auth::user()->type!='admin'){
            $users = $users->where('manager', Auth::user()->ref);
        }

        return view('manager_leaves_calendar', [ 'leaves' => $leaves, 'users' => $users ]);
    }

    public static function manager_leaves_calendar_check($today, $user)
    {
        $leaves = DB::table('leaves')
        ->select('leaves.ref as ref', 'from_date', 'from_time', 'to_date', 'to_time', 'raison', 'leaves.act as act', 'nom', 'pre')
        ->join('clis', 'clis.ref', 'leaves.cli')
        ->where('cli',  $user)
        ->where('leaves.act', 1)
        ->get();

        $vf=0;
        foreach($leaves as $l){

            $from_date=date('Y-m-d', strtotime($l->from_date));
            $to_date=date('Y-m-d', strtotime($l->to_date));

            if($to_date >=$today and $today>=$from_date) { $vf=1; }
        }

        return $vf;
    }

    // manager overtimes ######################

    public function manager_overtimes($etat)
    {
        $overtimes = DB::table('overtimes')
        ->select('overtimes.ref as ref', 'from_date', 'from_time', 'to_date', 'to_time', 'raison', 'overtimes.act as act', 'nom', 'pre')
        ->join('clis', 'clis.ref', 'overtimes.cli')
        ->where('manager',  Auth::user()->ref)
        ->where('overtimes.act', $etat)
        ->orderBy('from_date', 'desc')
        ->get();
        return view('manager_overtimes', [ 'overtimes' => $overtimes ]);
    }

    public function manager_overtimes_all()
    {
        $overtimes = DB::table('overtimes')
        ->select('overtimes.ref as ref', 'from_date', 'from_time', 'to_date', 'to_time', 'raison', 'overtimes.act as act', 'nom', 'pre', 'clis.ref as cref')
        ->join('clis', 'clis.ref', 'overtimes.cli')
        ->where('overtimes.act', 0)
        ->get();
        return view('manager_overtimes_all', [ 'overtimes' => $overtimes ]);
    }

    public function manager_overtimes_show($ref)
    {
        $overtimes = DB::table('overtimes')->where('ref', $ref)->get();
        return view('manager_overtimes_show', [ 'overtimes' => $overtimes ]);
    }

    public function manager_overtimes_edit_etat($ref, $act)
    {
        DB::table('overtimes')->where('ref', $ref)->update([ 'act' => $act,  ]);

        $user_ref = DB::table('overtimes')->where('ref', $ref)->value('cli');
        $user_email = DB::table('clis')->where('ref', $user_ref)->value('username');

        // confirmed
        if($act==1) {
            // add notification basic
            $fait=date("Y/m/d H:i:s");
            DB::table('notification')->insert(
            ['cli' => $user_ref,
            'type' => 'information',
            'msg' => 'We inform you that a request has been accepted by your Manager, you can check in your dashboard',
            'vu' => '0',
            'fait' => $fait  ] );


            //Send notification ***********************************************
            if($act==1){ 
                $notification = 'Overtime Confirmed';
                $emails = array(); array_push($emails, $user_email); if(count($emails)!=0){ foreach($emails as $em) { if($em!='') { \Mail::to($em)->send(new Notif($notification, $user_ref) ); } } } 
            }
        }

        // canceled
        if($act==-1) {
            // add notification basic
            $fait=date("Y/m/d H:i:s");
            DB::table('notification')->insert(
            ['cli' => $user_ref,
            'type' => 'information',
            'msg' => 'We inform you that a request has been refused by your Manager, you can check in your dashboard',
            'vu' => '0',
            'fait' => $fait  ] );


            //Send notification ***********************************************
            if($act==1){ 
                $notification = 'Overtime Canceled';
                $emails = array(); array_push($emails, $user_email); if(count($emails)!=0){ foreach($emails as $em) { if($em!='') { \Mail::to($em)->send(new Notif($notification, $user_ref) ); } } } 
            }
        }

        session()->flash('yes',"Item has been updated successfully"); 
        return back();
    }

    public function manager_overtimes_calendar()
    {
        

        if(Auth::user()->type=='admin'){
            $overtimes = DB::table('overtimes')
            ->select('overtimes.ref as ref', 'from_date', 'from_time', 'to_date', 'to_time', 'raison', 'overtimes.act as act', 'nom', 'pre')
            ->join('clis', 'clis.ref', 'overtimes.cli')
            ->where('overtimes.act', 1)
            ->get();
        } else {
            $overtimes = DB::table('overtimes')
            ->select('overtimes.ref as ref', 'from_date', 'from_time', 'to_date', 'to_time', 'raison', 'overtimes.act as act', 'nom', 'pre')
            ->join('clis', 'clis.ref', 'overtimes.cli')
            ->where('manager',  Auth::user()->ref)
            ->where('overtimes.act', 1)
            ->get();
        }

        $users = DB::table('clis')
        ->where('username', '!=', 'admin')
        ->where('ref', '!=', Auth::user()->ref)
        ->orderBy('nom', 'asc')
        ->get();

        if(Auth::user()->type!='admin'){
            $users = $users->where('manager', Auth::user()->ref);
        }

        return view('manager_overtimes_calendar', [ 'overtimes' => $overtimes, 'users' => $users ]);
    }

    public static function manager_overtimes_calendar_check($today, $user)
    {
        $overtimes = DB::table('overtimes')
        ->select('overtimes.ref as ref', 'from_date', 'from_time', 'to_date', 'to_time', 'raison', 'overtimes.act as act', 'nom', 'pre')
        ->join('clis', 'clis.ref', 'overtimes.cli')
        ->where('cli',  $user)
        ->where('overtimes.act', 1)
        ->get();

        $vf=0;
        foreach($overtimes as $l){

            $from_date=date('Y-m-d', strtotime($l->from_date));
            $to_date=date('Y-m-d', strtotime($l->to_date));

            if($to_date >=$today and $today>=$from_date) { $vf=1; }
        }

        return $vf;
    }

    public function manager_overtimes_recap()
    {
        $users = DB::table('clis')
        ->where('username', '!=', 'admin')
        ->orderBy('nom', 'asc')
        ->get();

        if(Auth::user()->type!='admin'){
        $users = $users->where('manager', Auth::user()->ref);
        }

        return view('manager_overtimes_recap', ['users' => $users ]);
    }


    // Contratcs 

    public function contracts()
    {
        $contracts = DB::table('contracts')
        ->where('cli', Auth::user()->ref)
        ->orderBy('fait', 'desc')
        ->get();

        return view('contracts', ['contracts' => $contracts ]);
    }

    public function usersContracts($cli)
    {
        $contracts = DB::table('contracts')
        ->where('cli', $cli)
        ->orderBy('fait', 'desc')
        ->get();

        return view('usersContracts', ['contracts' => $contracts, 'cli' => $cli ]);
    }

    public function usersContractsAdded(Request $req)
    {
        $id = substr(str_shuffle("1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890"),0,24); $b = date("dmyHis"); $id = $id.$b;

        $fait=date("Y/m/d H:i:s");
        DB::table('contracts')->insert(
        ['ref' => $id,
        'cli' => $req->input('cli'),
        'from_date' => $req->input('from_date'),
        'to_date' => $req->input('to_date'),
        'fait' => $fait  ] );
        
        $file = ""; $input=$req->all(); $file=array();
        if($files=$req->file('file')){
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                Storage::disk('contracts')->put($id.'.'.$extension,  File::get($file));
                $file = $id.'.'.$extension;
                DB::table('contracts')->where('ref', $id)->update([ 'file' => $file,  ]); 
            }
        }

        session()->flash('yes',"Item has been updated successfully"); 
        return back();
    }

    public function usersContractsDeleted($ref)
    {
        DB::table('contracts')->where('ref', $ref)->delete();
        session()->flash('yes',"The request has been deleted successfully"); 
        return back();
    }

    public static function usersContracts_count($cli)
    {
        $contracts_count = DB::table('contracts')
        ->where('cli', $cli)
        ->count();
        return $contracts_count; 
    }


    // Salary 
    public function salary()
    {
        $salary = DB::table('salary')
        ->orderBy('fait', 'desc')
        ->get();

        return view('salary', ['salary' => $salary ]);
    }

    public function salary_add()
    {
        return view('salary_add');
    }

    public function salary_added(Request $req)
    {
        $fait=date("Y/m/d H:i:s");
        $id = substr(str_shuffle("1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890"),0,24); $b = date("dmyHis"); $id = $id.$b;
        DB::table('salary')->insert(
        ['ref' => $id,
        'period' => $req->input('month').'/'.$req->input('year'),
        'by' => Auth::user()->nom.' '.Auth::user()->pre,
        'fait' => $fait  ] );


        $the_file = $req->file('file');

        $spreadsheet = IOFactory::load($the_file->getRealPath());
        $sheet        = $spreadsheet->getActiveSheet();
        $row_limit    = $sheet->getHighestDataRow();
        $column_limit = $sheet->getHighestDataColumn();
        $row_range    = range( 2, $row_limit );
        $column_range = range( 'F', $column_limit );
        $startcount = 2;
        $data = array();

        foreach ( $row_range as $row ) {
            $code = $sheet->getCell( 'A' . $row )->getValue();
            $cli = DB::table('clis')->where('code', $code)->value('ref');
            $mail = DB::table('clis')->where('code', $code)->value('username');

            if($code!='' && $cli!=''){
                $id2 = substr(str_shuffle("1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890"),0,24); $b = date("dmyHis"); $id2 = $id2.$b;
                
                $base_salary = $sheet->getCell( 'F' . $row )->getValue();
                $transportation = $sheet->getCell( 'G' . $row )->getValue();
                $overtime = $sheet->getCell( 'H' . $row )->getValue();
                $bpjs = $sheet->getCell( 'I' . $row )->getValue();
                $bonus = $sheet->getCell( 'J' . $row )->getValue();
                $gross = $base_salary + $transportation + $overtime + $bpjs + $bonus ;
                $income = $sheet->getCell( 'L' . $row )->getValue();
                $bpjs_kesehatan = $sheet->getCell( 'M' . $row )->getValue();
                $other = $sheet->getCell( 'N' . $row )->getValue();
                $deduction = $income + $bpjs_kesehatan + $other;
                $net = $gross - $deduction;

                DB::table('salary_det')->insert(
                ['ref' => $id2,
                'slr' => $id,
                'cli' => $cli,
                'base_salary' => $base_salary,
                'transportation' => $transportation,
                'overtime' => $overtime,
                'bpjs' => $bpjs,
                'bonus' => $bonus,
                'gross' => $gross,
                'income' => $income,
                'bpjs_kesehatan' => $bpjs_kesehatan,
                'other' => $other,
                'deduction' => $deduction,
                'net' => $net,
                'fait' => $fait  ] );

                // add notification basic
                DB::table('notification')->insert(
                ['cli' => $cli,
                'type' => 'information',
                'msg' => 'We inform you that your salary for the period ('.$req->input('month').'/'.$req->input('year').') has been processed',
                'vu' => '0',
                'fait' => $fait  ] );

                //Send notification ***********************************************
                $user_email = $mail;
                $user_ref = Auth::user()->ref;
                $notification = 'Salary Processed';
                $emails = array(); array_push($emails, $user_email); if(count($emails)!=0){ foreach($emails as $em) { if($em!='') { \Mail::to($em)->send(new Notif($notification, $user_ref) ); } } } 

            }
        }

        session()->flash('yes',"Item has been uploaded successfully"); 
        return redirect('salary');
    }


    // SalarySlip 
    public function salaryslip()
    {
        $salaryslip = DB::table('salary')
        ->select('salary_det.ref as ref', 'period', 'salary.fait', 'slr', 'cli', 'base_salary', 'transportation', 'overtime', 'bpjs', 'bonus', 'gross', 'income', 'bpjs_kesehatan', 'other', 'deduction', 'net')
        ->join('salary_det', 'salary.ref', 'salary_det.slr')
        ->join('clis', 'clis.ref', 'salary_det.cli')
        ->where('salary_det.cli', Auth::user()->ref)
        ->orderBy('salary.fait', 'desc')
        ->get();

        return view('salaryslip', ['salaryslip' => $salaryslip ]);
    }

    public function salaryslip_receipt($ref)
    {
        $salaryslip = DB::table('salary')
        ->select('nom', 'pre', 'code', 'position', 'salary_det.ref as ref', 'period', 'salary.fait', 'slr', 'cli', 'base_salary', 'transportation', 'overtime', 'bpjs', 'bonus', 'gross', 'income', 'bpjs_kesehatan', 'other', 'deduction', 'net')
        ->join('salary_det', 'salary.ref', 'salary_det.slr')
        ->join('clis', 'clis.ref', 'salary_det.cli')
        ->where('salary_det.cli', Auth::user()->ref)
        ->where('salary_det.ref', $ref)
        ->orderBy('salary.fait', 'desc')
        ->get();

        $pdf = \PDF::loadView('salaryslip_receipt', [ 'salaryslip'=>$salaryslip ]);
        return $pdf->stream();
    }

    public function salaryslip_receipt_admin($ref)
    {
        $salaryslip = DB::table('salary')
        ->select('nom', 'pre', 'code', 'position', 'salary_det.ref as ref', 'period', 'salary.fait', 'slr', 'cli', 'base_salary', 'transportation', 'overtime', 'bpjs', 'bonus', 'gross', 'income', 'bpjs_kesehatan', 'other', 'deduction', 'net')
        ->join('salary_det', 'salary.ref', 'salary_det.slr')
        ->join('clis', 'clis.ref', 'salary_det.cli')
        ->where('slr', $ref)
        ->orderBy('salary.fait', 'desc')
        ->get();

        $pdf = \PDF::loadView('salaryslip_receipt_admin', [ 'salaryslip'=>$salaryslip ]);
        return $pdf->stream();
    }

    // leave manual
    public function leave_manual()
    {
        $leaves = DB::table('leaves')
        ->select('leaves.ref as ref', 'from_date', 'from_time', 'to_date', 'to_time', 'raison', 'leaves.act as act', 'nom', 'pre')
        ->join('clis', 'clis.ref', 'leaves.cli')
        ->where('manual', 'YES')
        ->get();

        $clis = DB::table('clis')->orderBy('nom', 'asc')->get();

        return view('leave_manual', [ 'leaves'=>$leaves, 'clis'=>$clis ]);
    }

    public function leave_manual_added(Request $req)
    {
        $to_date = $req->input('to_date');
        if($req->input('halfday')=='YES') { $to_date = $req->input('from_date'); }

        $fait=date("Y/m/d H:i:s");
        $id = substr(str_shuffle("1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890"),0,24); $b = date("dmyHis"); $id = $id.$b;
        DB::table('leaves')->insert(
        ['ref' => $id,
        'cli' => $req->input('cli'),
        'from_date' => $req->input('from_date'),
        'from_time' => $req->input('from_time'),
        'to_date' => $to_date,
        'to_time' => $req->input('to_time'),
        'raison' => $req->input('raison'),
        'note' => "Leave added by ".Auth::user()->nom.' '.Auth::user()->pre,
        'halfday' => $req->input('halfday'),
        'manual' => 'YES',
        'act' => '1',
        'fait' => $fait  ] );
        
        session()->flash('yes',"The request has been added successfully"); 
        return back();
    }


    public function leave_manual_deleted($ref)
    {
        DB::table('leaves')->where('cli', Auth::user()->ref)->where('ref', $ref)->delete();
        session()->flash('yes',"The request has been deleted successfully"); 
        return back();
    }

    // Departments
    public function departments()
    {
        $departments = DB::table('departments')->orderBy('code','desc')->get();
        return view('departments', [ 'departments'=>$departments ]);
    }

    public function departments_add()
    {
        $maxCode = DB::table('departments')->select('code')->orderBy('code','desc')->limit(1)->value('code') ;
        $maxCode=$maxCode + 1;
        if($maxCode<10)  $code="0".$maxCode;
        else if($maxCode>=10 and $maxCode<100)  $code=$maxCode;
        return view('departments_add', [ 'code'=>$code ]);
    }

    public function departments_added(Request $req)
    {
        $nb = DB::table('departments')->where('code', $req->input('code'))->count();

        if($nb==0) {
            $fait=date("Y/m/d H:i:s");
            $id = substr(str_shuffle("1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890"),0,24); $b = date("dmyHis"); $id = $id.$b;
            DB::table('departments')->insert(
            ['ref' => $id,
            'code' => $req->input('code'),
            'title' => $req->input('title'),
            'fait' => $fait  ] );
            session()->flash('yes',"The request has been added successfully"); 
        } else { session()->flash('no',"The code already exists");  }
        return back();
    }

    public function departments_deleted($ref)
    {
        DB::table('departments')->where('ref', $ref)->delete();
        session()->flash('yes',"The request has been deleted successfully"); 
        return back();
    }

    public function departments_edit($ref)
    {
        $departments = DB::table('departments')->where('ref', $ref)->get();
        return view('departments_edit', [ 'departments'=>$departments ]);
    }

    public function departments_edited(Request $req, $ref)
    {
        DB::table('departments')->where('ref', $ref)->update(
        ['code' => $req->input('code'),
        'title' => $req->input('title'),] );
        session()->flash('yes',"The request has been updated successfully"); 
        return back();
    }

    // Positions
    public function positions()
    {
        $positions = DB::table('positions')->orderBy('code','desc')->get();
        return view('positions', [ 'positions'=>$positions ]);
    }

    public function positions_add()
    {
        $maxCode = DB::table('positions')->select('code')->orderBy('code','desc')->limit(1)->value('code') ;
        $maxCode=$maxCode + 1;
        if($maxCode<10)  $code="0".$maxCode;
        else if($maxCode>=10 and $maxCode<100)  $code=$maxCode;
        return view('positions_add', [ 'code'=>$code ]);
    }

    public function positions_added(Request $req)
    {
        $nb = DB::table('positions')->where('code', $req->input('code'))->count();

        if($nb==0) {
            $fait=date("Y/m/d H:i:s");
            $id = substr(str_shuffle("1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890"),0,24); $b = date("dmyHis"); $id = $id.$b;
            DB::table('positions')->insert(
            ['ref' => $id,
            'code' => $req->input('code'),
            'title' => $req->input('title'),
            'fait' => $fait  ] );
            session()->flash('yes',"The request has been added successfully"); 
        } else { session()->flash('no',"The code already exists");  }
        return back();
    }

    public function positions_deleted($ref)
    {
        DB::table('positions')->where('ref', $ref)->delete();
        session()->flash('yes',"The request has been deleted successfully"); 
        return back();
    }

    public function positions_edit($ref)
    {
        $positions = DB::table('positions')->where('ref', $ref)->get();
        return view('positions_edit', [ 'positions'=>$positions ]);
    }

    public function positions_edited(Request $req, $ref)
    {
        DB::table('positions')->where('ref', $ref)->update(
        ['code' => $req->input('code'),
        'title' => $req->input('title'),] );
        session()->flash('yes',"The request has been updated successfully"); 
        return back();
    }

    // Business Travel  ######################
    public function travel_add()
    {
        return view('travel_add');
    }

    public function travel_added(Request $req)
    {
        $fait=date("Y/m/d H:i:s");
        $ref = substr(str_shuffle("1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890"),0,24); $b = date("dmyHis"); $ref = $ref.$b;
        DB::table('travel')->insert(
        ['ref' => $ref,
        'cli' => Auth::user()->ref,
        'position' => Auth::user()->position,
        'department' => Auth::user()->department,
        'purpose' => $req->input('purpose'),
        'destination' => $req->input('destination'),
        'from_date' => $req->input('from_date'),
        'to_date' => $req->input('to_date'),
        'agenda' => $req->input('agenda'),
        'act' => '0',
        'fait' => $fait  ] );

        session()->flash('yes',"The request has been added successfully"); 
        return response()->json([
            'data' => ['travel' => $ref]
        ]);
    }

    public function travel_etat($etat)
    {
        $travel = DB::table('travel')->where('cli', Auth::user()->ref)->where('act', $etat)->get();
        return view('travel', [ 'travel' => $travel ]);
    }

    public function travel_edit($ref)
    {
        $travel = DB::table('travel')->where('cli', Auth::user()->ref)->where('ref', $ref)->get();
        return view('travel_edit', [ 'travel' => $travel ]);
    }

    public function travel_edited(Request $req, $ref)
    {
        DB::table('travel')->where('cli', Auth::user()->ref)->where('ref', $ref)->update([ 
            'purpose' => $req->input('purpose'),
            'destination' => $req->input('destination'),
            'from_date' => $req->input('from_date'),
            'to_date' => $req->input('to_date'),
            'agenda' => $req->input('agenda'),]);

        session()->flash('yes',"The request has been updpated successfully"); 
        return back();
    }
    public function travel_deleted($ref)
    {
        DB::table('travel')->where('cli', Auth::user()->ref)->where('ref', $ref)->delete();
        DB::table('travel_details')->where('cli', Auth::user()->ref)->where('travel', $ref)->delete();
        session()->flash('yes',"The request has been deleted successfully"); 
        return back();
    }

    public function travel_detail_added(Request $req)
    {
        $fait=date("Y/m/d H:i:s");
        $ref = substr(str_shuffle("1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890"),0,24); $b = date("dmyHis"); $ref = $ref.$b;
        $travel = $req->input('travel');
        DB::table('travel_details')->insert(
        ['ref' => $ref,
        'cli' => Auth::user()->ref,
        'travel' => $req->input('travel'),
        'type' => $req->input('type'),
        'description' => $req->input('description'),
        'budget' => $req->input('budget'),
        'fait' => $fait  ] );

        session()->flash('yes',"The request has been added successfully"); 
        return response()->json([
            'data' => ['travel' => $travel]
        ]);
    }

    public function travelJSON(Request $req) {
        $travel = DB::table('travel_details')->where('cli', Auth::user()->ref)->where('travel', $req->input('travel'))->get();

        return response()->json([
            'message' => 'Successfully retrieved details!',
            'data' => $travel,
        ]);
    }

    public function travel_sent_notif(Request $req)
    {
        // get user infos
        $user_nom = DB::table('clis')->where('ref', Auth::user()->ref)->value('nom');
        $user_pre = DB::table('clis')->where('ref', Auth::user()->ref)->value('pre');

        // get manager infos
        $manager_ref = DB::table('clis')->where('ref', Auth::user()->ref)->value('manager');
        $manager_mail = DB::table('clis')->where('ref', $manager_ref)->value('username');

        // add notification basic
        $fait=date("Y/m/d H:i:s");
        DB::table('notification')->insert(
        ['cli' => $manager_ref,
        'type' => 'information',
        'msg' => 'You have a new travel business request awaiting confirmation from : '.$user_nom.' '.$user_pre,
        'vu' => '0',
        'fait' => $fait  ] );

        //Send notification ***********************************************
        $user_email = $manager_mail;
        $user_ref = Auth::user()->ref;
        $notification = 'New Travel Business Request Request';
        $emails = array(); array_push($emails, $user_email); if(count($emails)!=0){ foreach($emails as $em) { if($em!='') { \Mail::to($em)->send(new Notif($notification, $user_ref) ); } } } 

        session()->flash('yes',"Your travel business already sent to your manager!"); 
        return redirect('travel_etat/0');
    }

    public function travel_saved(Request $req)
    {
        session()->flash('yes',"Your travel business has been saved!"); 
        return redirect('travel_etat/0');
    }

    public function travelProof_added(Request $req, $ref)
    {
        // save invoice
        $input=$req->all(); $invoice="";
        if($files=$req->file('invoice')){
            foreach($files as $file){                
                $id = substr(str_shuffle("1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890"),0,8); $b = date("dmyHis"); $id = $id.$b;
                $extension = $file->getClientOriginalExtension();
                Storage::disk('travel')->put('Invoice'.$id.'.'.$extension,  File::get($file));
                $invoice = 'Invoice'.$id.'.'.$extension; 
                DB::table('travel')->where('ref', $ref)->update(['invoice' => $invoice]);
            }
        }
        session()->flash('yes',"Invoice has been uploaded successfully");
        return back(); 
    }

    public function travelProof_deleted($ref)
    {
        $file = DB::table('travel')->where('ref', $ref)->value('invoice'); 
        if (file_exists(storage_path('../media/travel/'.$file)))  { unlink(storage_path('../media/travel/'.$file)); }
        DB::table('travel')->where('ref', $ref)->update(['invoice' => null]);

        session()->flash('Validation',"Invoice has been deleted successfully");
        return back();
    } 

    // MANAGER BUSINESS TRAVEL

    public function manager_travel($etat)
    {
        $travel = DB::table('travel')
        ->select('nom','pre','travel.ref as ref', 'purpose', 'destination', 'from_date', 'to_date', 'agenda', 'travel.act as act', 'travel.fait as fait')
        ->join('clis', 'clis.ref', 'travel.cli')
        ->where('manager', Auth::user()->ref)
        ->where('travel.act', $etat)
        ->get();

        // if(Auth::user()->type!='admin'){
        //     $travel = $travel->where('manager', Auth::user()->ref);
        // }
            
        return view('manager_travel', [ 'travel' => $travel ]);
    }

    public function manager_travel_all()
    {
        $travel = DB::table('travel')
        ->select('nom','pre','travel.ref as ref', 'purpose', 'destination', 'from_date', 'to_date', 'agenda', 'travel.act as act', 'travel.fait as fait')
        ->join('clis', 'clis.ref', 'travel.cli')
        // ->where('travel.act', 1)
        ->get();
            
        return view('manager_travel_all', [ 'travel' => $travel ]);
    }

    public function manager_travel_show($ref)
    {
        $travel = DB::table('travel')->where('ref', $ref)->get();
        $details = DB::table('travel_details')->where('travel', $ref)->get();
        return view('manager_travel_show', [ 'travel' => $travel, 'details'=>$details ]);
    }

    public function manager_travel_delete($ref)
    {
        DB::table('travel')->where('ref', $ref)->delete();
        DB::table('travel_details')->where('travel', $ref)->delete();
        session()->flash('yes',"The element has been deleted successfully"); 
        return back();
    }

    public function manager_travel_edit_etat($ref, $act)
    {
        DB::table('travel')->where('ref', $ref)->update([ 'act' => $act,  ]);

        $user_ref = DB::table('travel')->where('ref', $ref)->value('cli');
        $user_email = DB::table('clis')->where('ref', $user_ref)->value('username');

        // confirmed
        if($act==1) {
            // add notification basic
            $fait=date("Y/m/d H:i:s");
            DB::table('notification')->insert(
            ['cli' => $user_ref,
            'type' => 'information',
            'msg' => 'We inform you that a request has been accepted by your Manager, you can check in your dashboard',
            'vu' => '0',
            'fait' => $fait  ] );


            //Send notification ***********************************************
            if($act==1){ 
                $notification = 'Travel Business Confirmed';
                $emails = array(); array_push($emails, $user_email); if(count($emails)!=0){ foreach($emails as $em) { if($em!='') { \Mail::to($em)->send(new Notif($notification, $user_ref) ); } } } 
            }
        }

        // canceled
        if($act==-1) {
            // add notification basic
            $fait=date("Y/m/d H:i:s");
            DB::table('notification')->insert(
            ['cli' => $user_ref,
            'type' => 'information',
            'msg' => 'We inform you that a request has been refused by your Manager, you can check in your dashboard',
            'vu' => '0',
            'fait' => $fait  ] );


            //Send notification ***********************************************
            if($act==-1){ 
                $notification = 'Travel Business Canceled';
                $emails = array(); array_push($emails, $user_email); if(count($emails)!=0){ foreach($emails as $em) { if($em!='') { \Mail::to($em)->send(new Notif($notification, $user_ref) ); } } } 
            }
        }

        session()->flash('yes',"Travel business status has been updated successfully"); 
        return back();
    }

    // Travel Business Form
    public function travelbusiness_form($ref)
    {
        $travel = DB::table('travel')
        ->select('travel.ref as ref','clis.nom', 'clis.pre', 'clis.code', 'travel.purpose', 'travel.destination', 'travel.from_date', 'travel.to_date', 'travel.agenda', 'positions.title as ptitle', 'departments.title as dtitle' )
        ->leftjoin('positions', 'positions.ref', 'travel.position')
        ->leftjoin('departments', 'departments.ref', 'travel.department')
        ->join('clis', 'clis.ref', 'travel.cli')
        ->where('travel.ref', $ref)
        ->orderBy('travel.fait', 'desc')
        ->get();

        $details = DB::table('travel_details')
        ->select('travel_details.travel', 'travel_details.type', 'travel_details.description', 'travel_details.budget')
        ->leftjoin('travel', 'travel.ref', 'travel_details.travel')
        ->where('travel_details.travel', $ref)
        ->get();

        $pdf = \PDF::loadView('travelbusiness_form', [ 'travel'=>$travel, 'details'=>$details ]);
        return $pdf->stream();
    }

    // Recruitment New Staff  ######################
    public function recruitment_add()
    {
        return view('recruitment_add');
    }

    public function recruitment_added(Request $req)
    {
        $fait=date("Y/m/d H:i:s");
        $ref = substr(str_shuffle("1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890"),0,24); $b = date("dmyHis"); $ref = $ref.$b;
        DB::table('recruitments')->insert(
        ['ref' => $ref,
        'cli' => Auth::user()->ref,
        'type' => $req->input('type'),
        'hire' => $req->input('hire'),
        'replacing' => $req->input('replacing'),
        'reason' => $req->input('reason'),
        'title' => $req->input('title'),
        'salary' => $req->input('salary'),
        'description' => $req->input('description'),
        'duties' => $req->input('duties'),
        'equipment' => $req->input('equipment'),
        'requirement' => $req->input('requirement'),
        'additional' => $req->input('additional'),
        'act' => '0',
        'fait' => $fait  ] );

         // get user infos
         $user_nom = DB::table('clis')->where('ref', Auth::user()->ref)->value('nom');
         $user_pre = DB::table('clis')->where('ref', Auth::user()->ref)->value('pre');
 
         // get manager infos
         
         $manager_ref = '160223064350968903';
         $manager_mail = 'prita@magnitude-construction.com';
 
         // add notification basic
         $fait=date("Y/m/d H:i:s");
         DB::table('notification')->insert(
         ['cli' => $manager_ref,
         'type' => 'information',
         'msg' => 'You have a new request for recruitment request new staff awaiting confirmation from : '.$user_nom.' '.$user_pre,
         'vu' => '0',
         'fait' => $fait  ] );
 
         //Send notification ***********************************************
         $user_email = $manager_mail;
         $user_ref = Auth::user()->ref;
         $notification = 'Recruitment Request New Staff';
         $emails = array(); array_push($emails, $user_email); if(count($emails)!=0){ foreach($emails as $em) { if($em!='') { \Mail::to($em)->send(new Notif($notification, $user_ref) ); } } } 

        session()->flash('yes',"The request has been added successfully"); 
        return redirect('recruitment_etat/0');
    }

    public function recruitment_etat($etat)
    {
        $recruitment = DB::table('recruitments')->where('cli', Auth::user()->ref)->where('act', $etat)->get();
        return view('recruitment', [ 'recruitment' => $recruitment ]);
    }

    public function recruitment_edit($ref)
    {
        $recruitment = DB::table('recruitments')->where('cli', Auth::user()->ref)->where('ref', $ref)->get();
        return view('recruitment_edit', [ 'recruitment' => $recruitment ]);
    }

    public function recruitment_edited(Request $req, $ref)
    {
        DB::table('recruitments')->where('cli', Auth::user()->ref)->where('ref', $ref)->update([ 
            'type' => $req->input('type'),
            'hire' => $req->input('hire'),
            'replacing' => $req->input('replacing'),
            'reason' => $req->input('reason'),
            'title' => $req->input('title'),
            'salary' => $req->input('salary'),
            'description' => $req->input('description'),
            'duties' => $req->input('duties'),
            'equipment' => $req->input('equipment'),
            'requirement' => $req->input('requirement'),
            'additional' => $req->input('additional'),]);

        session()->flash('yes',"The request has been updpated successfully"); 
        return back();
    }

    public function recruitment_deleted($ref)
    {
        DB::table('recruitments')->where('cli', Auth::user()->ref)->where('ref', $ref)->delete();
        session()->flash('yes',"The request has been deleted successfully"); 
        return back();
    }

     // MANAGER BUSINESS TRAVEL

    public function manager_recruitment($etat)
    {
        $recruitment = DB::table('recruitments')
        ->select('nom', 'pre', 'recruitments.ref as ref', 'recruitments.type', 'recruitments.hire', 'recruitments.reason', 'recruitments.duties', 'recruitments.title', 'recruitments.act as act')
        ->join('clis', 'clis.ref', 'recruitments.cli')
        // ->where('cli', Auth::user()->ref)
        ->where('recruitments.act', $etat)
        ->get();

        return view('manager_recruitment', [ 'recruitment' => $recruitment ]);
    }

    public function manager_recruitment_show($ref)
    {
        $recruitment = DB::table('recruitments')->where('ref', $ref)->get();
        return view('manager_recruitment_show', [ 'recruitment' => $recruitment ]);
    }

    public function manager_recruitment_edit_etat($ref, $act)
    {
        DB::table('recruitments')->where('ref', $ref)->update([ 'act' => $act,  ]);

        $user_ref = DB::table('recruitments')->where('ref', $ref)->value('cli');
        $user_email = DB::table('clis')->where('ref', $user_ref)->value('username');

        // confirmed
        if($act==1) {
            // add notification basic
            $fait=date("Y/m/d H:i:s");
            DB::table('notification')->insert(
            ['cli' => $user_ref,
            'type' => 'information',
            'msg' => 'We inform you that a request has been accepted by HR Manager, you can check in your dashboard',
            'vu' => '0',
            'fait' => $fait  ] );


            //Send notification ***********************************************
            if($act==1){ 
                $notification = 'Recruitment Request New Staff Confirmed';
                $emails = array(); array_push($emails, $user_email); if(count($emails)!=0){ foreach($emails as $em) { if($em!='') { \Mail::to($em)->send(new Notif($notification, $user_ref) ); } } } 
            }
        }

        // canceled
        if($act==-1) {
            // add notification basic
            $fait=date("Y/m/d H:i:s");
            DB::table('notification')->insert(
            ['cli' => $user_ref,
            'type' => 'information',
            'msg' => 'We inform you that a request has been refused by HR Manager, you can check in your dashboard',
            'vu' => '0',
            'fait' => $fait  ] );


            //Send notification ***********************************************
            if($act==-1){ 
                $notification = 'Recruitment Request New Staff Canceled';
                $emails = array(); array_push($emails, $user_email); if(count($emails)!=0){ foreach($emails as $em) { if($em!='') { \Mail::to($em)->send(new Notif($notification, $user_ref) ); } } } 
            }
        }

        session()->flash('yes',"Recruitment Request New Staff status has been updated successfully"); 
        return back();
    }

    public function manager_recruitment_delete($ref)
    {
        DB::table('recruitments')->where('ref', $ref)->delete();
        session()->flash('yes',"The element has been deleted successfully"); 
        return back();
    }

    // Recruitment Form
    public function recruitment_form($ref)
    {
        $recruitment = DB::table('recruitments')
        ->select('recruitments.ref as ref','clis.nom', 'clis.pre', 'clis.code', 'positions.title as ptitle', 'departments.title as dtitle', 'recruitments.type', 'recruitments.hire', 'recruitments.replacing', 'recruitments.reason',
        'recruitments.title', 'recruitments.salary', 'recruitments.description', 'recruitments.duties', 'recruitments.requirement', 'recruitments.equipment', 'recruitments.additional', 'recruitments.fait as fait', )
        ->join('clis', 'clis.ref', 'recruitments.cli')
        ->rightjoin('positions', 'positions.ref', 'clis.position')
        ->rightjoin('departments', 'departments.ref', 'clis.department')
        ->where('recruitments.ref', $ref)
        ->orderBy('recruitments.fait', 'desc')
        ->get();

        $pdf = \PDF::loadView('recruitment_form', [ 'recruitment'=>$recruitment]);
        return $pdf->stream();
    }


    // Resignation  ######################
    public function resign_add()
    {
        return view('resign_add');
    }

    public function resign_added(Request $req)
    {
        $reason = $req->input('reason');
        if($req->input('reason')=='Other') { $reason = $req->input('other'); }

        $fait=date("Y/m/d H:i:s");
        $ref = substr(str_shuffle("1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890"),0,24); $b = date("dmyHis"); $ref = $ref.$b;
        DB::table('resign')->insert(
        ['ref' => $ref,
        'cli' => Auth::user()->ref,
        'reason' => $reason,
        'date' => $req->input('date'),
        'description' => $req->input('description'),
        'act' => '0',
        'fait' => $fait  ] );

        $attach = "";
        // NB ! Change fichier config/filesystems.php
        $input=$req->all();
        $attach=array();
        if($files=$req->file('attach')){
            foreach($files as $file){
                $fait=date("Y/m/d H:i:s");
                $extension = $file->getClientOriginalExtension();
                Storage::disk('resign')->put("Attachment".$ref.'.'.$extension,  File::get($file));
                $attach = "Attachment".$ref.'.'.$extension;
                DB::table('resign')->where('ref', $ref)->update([ 'attach' => $attach,  ]); 
            }
        }

         // get user infos
         $user_nom = DB::table('clis')->where('ref', Auth::user()->ref)->value('nom');
         $user_pre = DB::table('clis')->where('ref', Auth::user()->ref)->value('pre');
 
         // get manager infos
         $manager_ref = DB::table('clis')->where('ref', Auth::user()->ref)->value('manager');
         $manager_mail = DB::table('clis')->where('ref', $manager_ref)->value('username');
 
         // add notification basic
         $fait=date("Y/m/d H:i:s");
         DB::table('notification')->insert(
         ['cli' => $manager_ref,
         'type' => 'information',
         'msg' => 'You have a new resignation request awaiting confirmation from : '.$user_nom.' '.$user_pre,
         'vu' => '0',
         'fait' => $fait  ] );
 
         //Send notification ***********************************************
         $user_email = $manager_mail;
         $user_ref = Auth::user()->ref;
         $notification = 'New Resignation Request';
         $emails = array(); array_push($emails, $user_email); if(count($emails)!=0){ foreach($emails as $em) { if($em!='') { \Mail::to($em)->send(new Notif($notification, $user_ref) ); } } } 

        session()->flash('yes',"The request has been added successfully"); 
        return redirect('resign_etat/0');
    }

    public function resign_etat($etat)
    {
        $resign = DB::table('resign')->where('cli', Auth::user()->ref)->where('act', $etat)->get();
        return view('resign', [ 'resign' => $resign ]);
    }

    public function resign_edit($ref)
    {
        $resign = DB::table('resign')->where('cli', Auth::user()->ref)->where('ref', $ref)->get();
        return view('resign_edit', [ 'resign' => $resign ]);
    }

    public function resign_edited(Request $req, $ref)
    {
        $reason = $req->input('reason');
        if($req->input('reason')=='Other') { $reason = $req->input('other'); }
        
        DB::table('resign')->where('cli', Auth::user()->ref)->where('ref', $ref)->update([ 
            'reason' => $reason,
            'date' => $req->input('date'),
            'description' => $req->input('description') ] );

        $attach = "";
        // NB ! Change fichier config/filesystems.php
        $input=$req->all();
        $attach=array();
        if($files=$req->file('attach')){
            foreach($files as $file){
                $fait=date("Y/m/d H:i:s");
                $extension = $file->getClientOriginalExtension();
                Storage::disk('resign')->put("Attachment".$ref.'.'.$extension,  File::get($file));
                $attach = "Attachment".$ref.'.'.$extension;
                DB::table('resign')->where('ref', $ref)->update([ 'attach' => $attach,  ]); 
            }
        }

        session()->flash('yes',"The request has been updpated successfully"); 
        return back();
    }

    public function resign_deleted($ref)
    {
        $attach = DB::table('resign')->where('ref', $ref)->value('attach'); 
        if($attach!=''){
        if (file_exists(storage_path('../media/resign/'.$attach)))  { unlink(storage_path('../media/resign/'.$attach)); }}
        DB::table('resign')->where('cli', Auth::user()->ref)->where('ref', $ref)->delete();
        session()->flash('yes',"The request has been deleted successfully"); 
        return back();
    }

    public function resign_attach_deleted($ref)
    {   
        $attach = DB::table('resign')->where('ref', $ref)->value('attach'); 
        if (file_exists(storage_path('../media/resign/'.$attach)))  { unlink(storage_path('../media/resign/'.$attach)); }
        DB::table('resign')->where('ref', $ref)->update(['attach' => '' ]); 

        session()->flash('yes',"Attachment has been deleted successfully");
        return back();
    }

    // Manager Resignation
    public function manager_resign($etat)
    {
        $resign = DB::table('resign')
        ->select('nom', 'pre', 'resign.ref as ref', 'resign.reason', 'resign.date', 'resign.description', 'resign.attach', 'resign.act as act')
        ->join('clis', 'clis.ref', 'resign.cli')
        ->where('manager', Auth::user()->ref)
        ->where('resign.act', $etat)
        ->get();

        // if(Auth::user()->type!='admin'){
        //     $resign = $resign->where('manager', Auth::user()->ref);
        // }

        return view('manager_resign', [ 'resign' => $resign ]);
    }

    public function manager_resign_all()
    {
        $resign = DB::table('resign')
        ->select('nom', 'pre', 'resign.ref as ref', 'resign.reason', 'resign.date', 'resign.description', 'resign.attach', 'resign.act as act')
        ->join('clis', 'clis.ref', 'resign.cli')
        // ->where('resign.act', 1)
        ->get();

        return view('manager_resign_all', [ 'resign' => $resign ]);
    }

    public function manager_resign_show($ref)
    {
        $resign = DB::table('resign')->where('ref', $ref)->get();
        return view('manager_resign_show', [ 'resign' => $resign ]);
    }

    public function manager_resign_edit_etat($ref, $act)
    {
        DB::table('resign')->where('ref', $ref)->update([ 'act' => $act,  ]);

        $user_ref = DB::table('resign')->where('ref', $ref)->value('cli');
        $user_email = DB::table('clis')->where('ref', $user_ref)->value('username');

        // confirmed
        if($act==1) {
            // add notification basic
            $fait=date("Y/m/d H:i:s");
            DB::table('notification')->insert(
            ['cli' => $user_ref,
            'type' => 'information',
            'msg' => 'We inform you that a request has been accepted by your manager, you can check in your dashboard',
            'vu' => '0',
            'fait' => $fait  ] );


            //Send notification ***********************************************
            if($act==1){ 
                $notification = 'Resignation Request Confirmed';
                $emails = array(); array_push($emails, $user_email); if(count($emails)!=0){ foreach($emails as $em) { if($em!='') { \Mail::to($em)->send(new Notif($notification, $user_ref) ); } } } 
            }
        }

        // canceled
        if($act==-1) {
            // add notification basic
            $fait=date("Y/m/d H:i:s");
            DB::table('notification')->insert(
            ['cli' => $user_ref,
            'type' => 'information',
            'msg' => 'We inform you that a request has been refused by your manager, you can check in your dashboard',
            'vu' => '0',
            'fait' => $fait  ] );


            //Send notification ***********************************************
            if($act==-1){ 
                $notification = 'Resignation Request Canceled';
                $emails = array(); array_push($emails, $user_email); if(count($emails)!=0){ foreach($emails as $em) { if($em!='') { \Mail::to($em)->send(new Notif($notification, $user_ref) ); } } } 
            }
        }

        session()->flash('yes',"Resignation Request status has been updated successfully"); 
        return back();
    }

    public function manager_resign_delete($ref)
    {
        $attach = DB::table('resign')->where('ref', $ref)->value('attach'); 
        if($attach!=''){
        if (file_exists(storage_path('../media/resign/'.$attach)))  { unlink(storage_path('../media/resign/'.$attach)); }}
        DB::table('resign')->where('ref', $ref)->delete();
        session()->flash('yes',"The element has been deleted successfully"); 
        return back();
    }

    public function manager_resign_checklist($ref)
    {
        $resign = DB::table('resign')
        ->where('resign.ref', $ref)
        ->get(); 

        return view('manager_resign_checklist', [ 'resign'=>$resign]);
    }
    
    public function manager_resign_checklist_updated(Request $req, $ref)
    {
        DB::table('resign')->where('ref', $ref)->update([ 
            'a1' => $req->input('a1'),  
            'a2' => $req->input('a2'),  
            'a3' => $req->input('a3'),  
            'a4' => $req->input('a4'),  
            'a5' => $req->input('a5'),  
            'a6' => $req->input('a6'),  
            'a7' => $req->input('a7'),  
            'a8' => $req->input('a8'),  
            'b1' => $req->input('b1'),  
            'b2' => $req->input('b2'),  
            'b3' => $req->input('b3'),  
            'b4' => $req->input('b4'),  
            'b5' => $req->input('b5'),  
            'b6' => $req->input('b6'),  
            'b7' => $req->input('b7'),
            'c1' => $req->input('c1'),  
            'c2' => $req->input('c2'),  
            'c3' => $req->input('c3'),  
            'c4' => $req->input('c4'),  
            'c5' => $req->input('c5'),  
            'c6' => $req->input('c6'),  
            'c7' => $req->input('c7'),  
            'c8' => $req->input('c8'),  
            'c9' => $req->input('c9'),  
            'c10' => $req->input('c10'),  
            'd1' => $req->input('d1'),  
            'd2' => $req->input('d2'),  
            'd3' => $req->input('d3'),  
            'd4' => $req->input('d4'),  
            'e1' => $req->input('e1'),  
            'e2' => $req->input('e2'),  
            'e3' => $req->input('e3'), 
        ]); 
        session()->flash('yes',"Resignation Checklist has been updated successfully"); 
        return back();
    }

    // Resign Form
    public function resign_form($ref)
    {
        $resign = DB::table('resign')
        ->select('resign.ref as ref','clis.nom', 'clis.pre', 'clis.code', 'positions.title as ptitle', 'departments.title as dtitle', 'resign.reason', 'resign.date', 'resign.description', 'resign.attach', 'resign.fait as fait', )
        ->join('clis', 'clis.ref', 'resign.cli')
        ->rightjoin('positions', 'positions.ref', 'clis.position')
        ->rightjoin('departments', 'departments.ref', 'clis.department')
        ->where('resign.ref', $ref)
        ->orderBy('resign.fait', 'desc')
        ->get();

        $pdf = \PDF::loadView('resign_form', [ 'resign'=>$resign]);
        return $pdf->stream();
    }

    public function resign_checklist($ref)
    {
        $resign = DB::table('resign')
        ->select('resign.ref as ref','clis.nom', 'clis.pre', 'clis.code','clis.manager', 'positions.title as ptitle', 'departments.title as dtitle', 'resign.reason', 'resign.date', 'resign.description', 'resign.attach', 'resign.fait as fait',
        'a1','a2','a3','a4','a5','a6','a7','a8','b1','b2','b3','b4','b5','b6','b7', 'c1','c2','c3','c4','c5','c6','c7','c8','c9','c10','d1','d2','d3','d4','e1','e2','e3',)
        ->join('clis', 'clis.ref', 'resign.cli')
        ->rightjoin('positions', 'positions.ref', 'clis.position')
        ->rightjoin('departments', 'departments.ref', 'clis.department')
        ->where('resign.ref', $ref)
        ->orderBy('resign.fait', 'desc')
        ->get();

        foreach($resign as $item){
           $nom = DB::table('clis')->where('ref', $item->manager)->value('nom');
           $pre = DB::table('clis')->where('ref', $item->manager)->value('pre');
        }
        $pdf = \PDF::loadView('resign_checklist', [ 'resign'=>$resign, 'nom'=>$nom, 'pre'=>$pre]);
        return $pdf->stream();
    }

     // freelance  ######################
     public function freelance_add()
     {
         return view('freelance_add');
     }

     public function freelance_added(Request $req)
    {
        $fait=date("Y/m/d H:i:s");
        $id = substr(str_shuffle("1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890"),0,24); $b = date("dmyHis"); $id = $id.$b;
        DB::table('freelance')->insert(
        ['ref' => $id,
        'cli' => Auth::user()->ref,
        'from_date' => $req->input('from_date'),
        'from_time' => $req->input('from_time'),
        'to_date' => $req->input('from_date'),
        'to_time' => $req->input('to_time'),
        'note' => $req->input('note'),
        'act' => '0',
        'fait' => $fait  ] );

        // get user infos
        $user_nom = DB::table('clis')->where('ref', Auth::user()->ref)->value('nom');
        $user_pre = DB::table('clis')->where('ref', Auth::user()->ref)->value('pre');

        // get manager infos
        $manager_ref = DB::table('clis')->where('ref', Auth::user()->ref)->value('manager');
        $manager_mail = DB::table('clis')->where('ref', $manager_ref)->value('username');

        // add notification basic
        $fait=date("Y/m/d H:i:s");
        DB::table('notification')->insert(
        ['cli' => $manager_ref,
        'type' => 'information',
        'msg' => 'You have a new freelance request awaiting confirmation from : '.$user_nom.' '.$user_pre,
        'vu' => '0',
        'fait' => $fait  ] );

        //Send notification ***********************************************
        $user_email = $manager_mail;
        $user_ref = Auth::user()->ref;
        $notification = 'New Freelance Request';
        $emails = array(); array_push($emails, $user_email); if(count($emails)!=0){ foreach($emails as $em) { if($em!='') { \Mail::to($em)->send(new Notif($notification, $user_ref) ); } } } 

        session()->flash('yes',"The request has been added successfully"); 
        return redirect('freelance_etat/0');
    }

    public function freelance_etat($etat)
    {
        $freelance = DB::table('freelance')->where('cli', Auth::user()->ref)->where('act', $etat)->get();
        return view('freelance', [ 'freelance' => $freelance ]);
    }

     public function freelance_deleted($ref)
    {
        DB::table('freelance')->where('cli', Auth::user()->ref)->where('ref', $ref)->delete();
        session()->flash('yes',"The request has been deleted successfully"); 
        return back();
    }

    public function freelance_edit($ref)
    {
        $freelance = DB::table('freelance')->where('cli', Auth::user()->ref)->where('ref', $ref)->get();
        return view('freelance_edit', [ 'freelance' => $freelance ]);
    }

    public function freelance_edited(Request $req, $ref)
    {
        DB::table('freelance')->where('cli', Auth::user()->ref)->where('ref', $ref)->update([ 
            'from_date' => $req->input('from_date'),
            'from_time' => $req->input('from_time'),
            'to_date' => $req->input('from_date'),
            'to_time' => $req->input('to_time'),
            'note' => $req->input('note'),  ]);
        session()->flash('yes',"The request has been updpated successfully"); 
        return back();
    }

    public function freelance_calendar()
    {
        $freelance = DB::table('freelance')->where('cli', Auth::user()->ref)->get();
        return view('freelance_calendar', [ 'freelance' => $freelance ]);
    }

    public static function calc_nb_freelance($month, $year)
    {
        $freelance = DB::table('freelance')->where('cli', Auth::user()->ref)->where('act', 1)->get();
        $nb_hours = 0;
        foreach($freelance as $l)
        {
            $m = date('m', strtotime($l->from_date));
            $y = date('Y', strtotime($l->from_date));

            if($year==$y && $month==$m) {
                $start = strtotime($l->from_time);
                $end = strtotime($l->to_time);
                $d = round(abs($end - $start) / 3600,2);
                $nb_hours = $nb_hours + $d;
            }
        }
        return $nb_hours;
    }

    // manager freelance ######################

    public function manager_freelance($etat)
    {
        $freelance = DB::table('freelance')
        ->select('freelance.ref as ref', 'from_date', 'from_time', 'to_date', 'to_time', 'freelance.act as act', 'note', 'nom', 'pre')
        ->join('clis', 'clis.ref', 'freelance.cli')
        ->where('manager',  Auth::user()->ref)
        ->where('freelance.act', $etat)
        ->orderBy('from_date', 'desc')
        ->get();
        return view('manager_freelance', [ 'freelance' => $freelance ]);
    }

    public function manager_freelance_all()
    {
        $freelance = DB::table('freelance')
        ->select('freelance.ref as ref', 'from_date', 'from_time', 'to_date', 'to_time', 'freelance.act as act', 'nom', 'pre', 'clis.ref as cref', 'note')
        ->join('clis', 'clis.ref', 'freelance.cli')
        ->where('freelance.act', 0)
        ->get();
        return view('manager_freelance_all', [ 'freelance' => $freelance ]);
    }

    public function manager_freelance_show($ref)
    {
        $freelance = DB::table('freelance')->where('ref', $ref)->get();
        return view('manager_freelance_show', [ 'freelance' => $freelance ]);
    }

    public function manager_freelance_edit_etat($ref, $act)
    {
        DB::table('freelance')->where('ref', $ref)->update([ 'act' => $act,  ]);

        $user_ref = DB::table('freelance')->where('ref', $ref)->value('cli');
        $user_email = DB::table('clis')->where('ref', $user_ref)->value('username');

        // confirmed
        if($act==1) {
            // add notification basic
            $fait=date("Y/m/d H:i:s");
            DB::table('notification')->insert(
            ['cli' => $user_ref,
            'type' => 'information',
            'msg' => 'We inform you that a request has been accepted by your Manager, you can check in your dashboard',
            'vu' => '0',
            'fait' => $fait  ] );


            //Send notification ***********************************************
            if($act==1){ 
                $notification = 'Freelance Confirmed';
                $emails = array(); array_push($emails, $user_email); if(count($emails)!=0){ foreach($emails as $em) { if($em!='') { \Mail::to($em)->send(new Notif($notification, $user_ref) ); } } } 
            }
        }

        // canceled
        if($act==-1) {
            // add notification basic
            $fait=date("Y/m/d H:i:s");
            DB::table('notification')->insert(
            ['cli' => $user_ref,
            'type' => 'information',
            'msg' => 'We inform you that a request has been refused by your Manager, you can check in your dashboard',
            'vu' => '0',
            'fait' => $fait  ] );


            //Send notification ***********************************************
            if($act==1){ 
                $notification = 'Overtime Canceled';
                $emails = array(); array_push($emails, $user_email); if(count($emails)!=0){ foreach($emails as $em) { if($em!='') { \Mail::to($em)->send(new Notif($notification, $user_ref) ); } } } 
            }
        }

        session()->flash('yes',"Item has been updated successfully"); 
        return back();
    }

    public function manager_freelance_calendar()
    {        

        if(Auth::user()->type=='admin'){
            $freelance = DB::table('freelance')
            ->select('freelance.ref as ref', 'from_date', 'from_time', 'to_date', 'to_time', 'freelance.act as act', 'nom', 'pre', 'note')
            ->join('clis', 'clis.ref', 'freelance.cli')
            ->where('freelance.act', 1)
            ->get();
        } else {
            $freelance = DB::table('freelance')
            ->select('freelance.ref as ref', 'from_date', 'from_time', 'to_date', 'to_time', 'freelance.act as act', 'nom', 'pre', 'note')
            ->join('clis', 'clis.ref', 'freelance.cli')
            ->where('manager',  Auth::user()->ref)
            ->where('freelance.act', 1)
            ->get();
        }

        $users = DB::table('clis')
        ->where('username', '!=', 'admin')
        ->where('ref', '!=', Auth::user()->ref)
        ->orderBy('nom', 'asc')
        ->get();

        if(Auth::user()->type!='admin'){
            $users = $users->where('manager', Auth::user()->ref);
        }

        return view('manager_freelance_calendar', [ 'freelance' => $freelance, 'users' => $users ]);
    }

    public function manager_freelance_recap()
    {
        $users = DB::table('clis')
        ->where('username', '!=', 'admin')
        ->orderBy('nom', 'asc')
        ->get();

        if(Auth::user()->type!='admin'){
        $users = $users->where('manager', Auth::user()->ref);
        }

        return view('manager_freelance_recap', ['users' => $users ]);
    }

    public static function calc_nb_freelance_byUser($month, $year, $cli)
    {
        $freelance = DB::table('freelance')->where('cli', $cli)->where('act', 1)->get();
        $nb_hours = 0;
        foreach($freelance as $l)
        {
            $m = date('m', strtotime($l->from_date));
            $y = date('Y', strtotime($l->from_date));

            if($year==$y && $month==$m) {
                $start = strtotime($l->from_time);
                $end = strtotime($l->to_time);
                $d = round(abs($end - $start) / 3600,2);
                $nb_hours = $nb_hours + $d;
            }
        }
        return $nb_hours;
    }

    public function freelance_update_admin($ref)
    {   
        if(Auth::user()->type=='admin') { 
            $freelance = DB::table('freelance')->where('ref', $ref)->get();
            $cli_ref = DB::table('freelance')->where('ref', $ref)->value('cli');
            $cli_nom = DB::table('clis')->where('ref', $cli_ref)->value('nom');
            $cli_pre = DB::table('clis')->where('ref', $cli_ref)->value('pre');
            return view('freelance_update_admin', [ 'freelance' => $freelance, 'cli' => $cli_nom.' '.$cli_pre ]);
        }
    }

    public function freelance_updated_admin(Request $req, $ref)
    {
        if(Auth::user()->type=='admin') { 

            DB::table('freelance')->where('ref', $ref)->update([ 
                'from_date' => $req->input('from_date'),
                'from_time' => $req->input('from_time'),
                'to_date' => $req->input('from_date'),
                'to_time' => $req->input('to_time'),
                'note' => $req->input('note'),  ]);
            session()->flash('yes',"The request has been updpated successfully"); 
            return back();
        }
    }

    public function freelance_deleted_admin($ref)
    {   
        if(Auth::user()->type=='admin') { 
            DB::table('freelance')->where('ref', $ref)->delete();
            session()->flash('yes',"The request has been deleted successfully"); 
            return redirect('manager_freelance_calendar');
        }
    }

    
 

    
       



}


