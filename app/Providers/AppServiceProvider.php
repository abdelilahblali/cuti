<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use DB;
use App\Http\Controllers\Cmd;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view)
        {                     

            if (Auth::check()) {

                $users_waiting = DB::table('clis')->where('act', 0)->count();              
                $view->with('users_waiting', $users_waiting );

                $notificationsNotRead = DB::table('notification')->where('cli', Auth::user()->ref)->where('vu', 0)->get();              
                $view->with('notificationsNotRead', $notificationsNotRead );

                $users_check_photo = Auth::user()->img; 
                $users_check_manager = Auth::user()->manager;

                $users_check_count = 0;
                if($users_check_photo=='') { $users_check_count+=1; }
                if($users_check_manager=='') { $users_check_count+=1; }

                $view->with('users_check_count', $users_check_count );


                $leaves_waiting = DB::table('leaves')
                ->select('leaves.ref as ref', 'from_date', 'from_time', 'to_date', 'to_time', 'raison', 'leaves.act as act', 'nom', 'pre')
                ->join('clis', 'clis.ref', 'leaves.cli')
                ->where('manager',  Auth::user()->ref)
                ->where('leaves.act', 0)
                ->count();
                $view->with('leaves_waiting', $leaves_waiting );

                $overtimes_waiting = DB::table('overtimes')
                ->select('overtimes.ref as ref', 'from_date', 'from_time', 'to_date', 'to_time', 'raison', 'overtimes.act as act', 'nom', 'pre')
                ->join('clis', 'clis.ref', 'overtimes.cli')
                ->where('manager',  Auth::user()->ref)
                ->where('overtimes.act', 0)
                ->count();
                $view->with('overtimes_waiting', $overtimes_waiting );

                $travel_waiting = DB::table('travel')
                ->select('travel.ref as ref', 'cli', 'position', 'department', 'purpose', 'destination', 'from_date', 'to_date', 'agenda', 'travel.act as act',)
                ->join('clis', 'clis.ref', 'travel.cli')
                ->where('manager',  Auth::user()->ref)
                ->where('travel.act', 0)
                ->count();
                $view->with('travel_waiting', $travel_waiting );

                $resign_waiting = DB::table('resign')
                ->select('resign.ref as ref', 'cli', 'reason', 'date', 'description', 'attach', 'resign.act as act',)
                ->join('clis', 'clis.ref', 'resign.cli')
                ->where('manager',  Auth::user()->ref)
                ->where('resign.act', 0)
                ->count();
                $view->with('resign_waiting', $resign_waiting );

                $recruitment_waiting = DB::table('recruitments')
                ->select('recruitments.ref as ref', 'cli', 'type', 'hire', 'replacing', 'reason', 'title', 'salary', 'description', 'duties', 'requirement', 'equipment', 'additional','recruitments.act as act',)
                ->join('clis', 'clis.ref', 'recruitments.cli')
                // ->where('manager',  Auth::user()->ref)
                ->where('recruitments.act', 0)
                ->count();
                $view->with('recruitment_waiting', $recruitment_waiting );

                $freelance_waiting = DB::table('freelance')
                ->select('freelance.ref as ref', 'from_date', 'from_time', 'to_date', 'to_time', 'freelance.act as act', 'nom', 'pre')
                ->join('clis', 'clis.ref', 'freelance.cli')
                ->where('manager',  Auth::user()->ref)
                ->where('freelance.act', 0)
                ->count();
                $view->with('freelance_waiting', $freelance_waiting );

            }

        });
    }
}
