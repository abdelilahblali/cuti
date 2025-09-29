<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use auth;
use DB;
use  App\Mail\Notif;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }


    public function username()
    {
        return 'username'; // or whatever field you use to login
    }

    public function login(Request $req)
    {
        $act = DB::table('clis')->where('username', $req->input('username'))->value('act');

        if($act=='1') {
            if(\Auth::attempt($req->only('username', 'password'))){
                return redirect('home');
            } else {
                session()->flash('no',"The information is incorrect");
                return back(); 
            }
        } elseif($act=='0') {
            session()->flash('no',"Your account not activated"); 
            return back();
        } else {
            session()->flash('no',"The information is incorrect"); 
            return back();
        }


        // if($type=='admin') {
        //     if(\Auth::attempt($req->only('username', 'password'))){
        //         return redirect('home');
        //     }
        //     return redirect('login')->withError('Login details are not valid');
        // } elseif($type=='user') {
        //     $code = DB::table('clis')->where('username', $req->input('username'))->value('code');
        //     $AccountActive = DB::connection('mysql2')->table('ventes')->where('cod', $code)->value('AccountActive');

        //     if($AccountActive==1){
        //         if(\Auth::attempt($req->only('username', 'password'))){
        //             return redirect('home');
        //         }
        //     }
        //     return redirect('login')->withError('Login details are not valid');
        // }


    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'email', 'max:255', 'unique:clis'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'nom' => ['required', 'string', 'max:255'],
            'pre' => ['required', 'string', 'max:255'],
        ]);
    }

    public function newAccount(Request $req)
    {
        // vars
        $fait=date("Y/m/d H:i:s");
        $ref = substr(str_shuffle("1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890"),0,6); $b = date("dmyHis"); $ref = $b.$ref;
        
        // insert
        $nb = DB::table('clis')->where('username', $req->input('username'))->count();
        if($nb==0) {
            DB::table('clis')->insert(
            ['ref' => $ref, 
            'username' => $req->input('username'),
            'password' => Hash::make($req->input('pass1')),
            'email' => $req->input('username'),
            'nom' => strtoupper($req->input('nom')),
            'pre' => ucfirst(strtolower($req->input('pre'))),
            'type' => 'user',
            'act' => '0',
            'fait' => $fait  ] );

            //Send notification ***********************************************
            
            $user_ref = $ref;
            $notification = 'New Account';
            $emails = array(); 
            array_push($emails, "hr@magnitudeconstruction.com"); 
            if(count($emails)!=0){ foreach($emails as $em) { if($em!='') { \Mail::to($em)->send(new Notif($notification, $user_ref) ); } } } 

            session()->flash('yes',"Your account is validating, you will receive an email when your account is confirmed"); 
        } else {
            session()->flash('no',"This email already used"); 
        }

        return back();
    }

    public function forgot()
    {
        return view('forgot');
    }
   
    public function password_reset($token, $email)
    {
        $nb = DB::table('password_resets')->where('email', $email)->where('token', $token)->count();
        if($nb!=0) { return view('auth.password_reset' , [ 'token'=>$token, 'email'=>$email  ]); } else { return redirect('forgot'); }
    }

    public function password_update(Request $req)
    {
        DB::table('clis')->where('username', $req->input('email'))->update([ 'password' => Hash::make($req->input('password')),  ]);
        session()->flash('yes',"Password updated !"); 
        return redirect('login');
    }
}
