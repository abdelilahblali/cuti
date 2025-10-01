<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Home;
use App\Http\Controllers\Admin;
use App\Http\Controllers\CatalogForm;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\Chat;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Signature;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Web

// INDAH MAKE THIS LINE 
// other line from indah

Route::get('/', function () { return view('home'); });
Auth::routes(['verify' => true]);
Route::get('locale/{locale}', function ($locale) { session()->put('locale', $locale); return Redirect::back(); });

Route::post('newAccount', [LoginController::class, 'newAccount'])->name('newAccount');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('/', [App\Http\Controllers\Admin::class, 'index'])->name('index');
Route::get('forgot', [LoginController::class, 'forgot'])->name('forgot');
Route::get('password_reset/{token}/{email}', [LoginController::class, 'password_reset'])->name('password_reset');
Route::post('password_update', [LoginController::class, 'password_update'])->name('password_update');

Route::get('home', [Admin::class, 'home'])->name('home');
Route::get('home', [Admin::class, 'index'])->name('home');

Route::get('admin', [Admin::class, 'admin'])->name('admin');

// users
Route::get('users', [Admin::class, 'users'])->name('users');
Route::get('users_update/{ref}', [Admin::class, 'users_update'])->name('users_update');
Route::post('users_updated/{ref}', [Admin::class, 'users_updated'])->name('users_updated');
Route::get('usersEditAct/{ref}/{act}', [Admin::class, 'usersEditAct'])->name('usersEditAct');
Route::get('usersEtat/{act}', [Admin::class, 'usersEtat'])->name('usersEtat');
Route::get('user_profil', [Admin::class, 'user_profil'])->name('user_profil');
Route::post('user_profil_updated', [Admin::class, 'user_profil_updated'])->name('user_profil_updated');
Route::post('user_photo_updated', [Admin::class, 'user_photo_updated'])->name('user_photo_updated');
Route::get('user_password', [Admin::class, 'user_password'])->name('user_password');
Route::post('user_password_updated', [Admin::class, 'user_password_updated'])->name('user_password_updated');
Route::get('user_notifications', [Admin::class, 'user_notifications'])->name('user_notifications');

// leave
Route::get('leave_add', [Admin::class, 'leave_add'])->name('leave_add');
Route::post('leave_added', [Admin::class, 'leave_added'])->name('leave_added');
Route::get('leave_edit/{ref}', [Admin::class, 'leave_edit'])->name('leave_edit');
Route::post('leave_edited/{ref}', [Admin::class, 'leave_edited'])->name('leave_edited');
Route::get('leave_deleted/{ref}', [Admin::class, 'leave_deleted'])->name('leave_deleted');
Route::get('leave_calendar', [Admin::class, 'leave_calendar'])->name('leave_calendar');
Route::get('leave_recap', [Admin::class, 'leave_recap'])->name('leave_recap');
Route::get('leave_etat/{etat}', [Admin::class, 'leave_etat'])->name('leave_etat');

Route::get('leave_update_admin/{ref}', [Admin::class, 'leave_update_admin'])->name('leave_update_admin');
Route::post('leave_updated_admin/{ref}', [Admin::class, 'leave_updated_admin'])->name('leave_updated_admin');
Route::get('leave_deleted_admin/{ref}', [Admin::class, 'leave_deleted_admin'])->name('leave_deleted_admin');

// overtime
Route::get('overtimes_add', [Admin::class, 'overtimes_add'])->name('overtimes_add');
Route::post('overtimes_added', [Admin::class, 'overtimes_added'])->name('overtimes_added');
Route::get('overtimes_edit/{ref}', [Admin::class, 'overtimes_edit'])->name('overtimes_edit');
Route::post('overtimes_edited/{ref}', [Admin::class, 'overtimes_edited'])->name('overtimes_edited');
Route::get('overtimes_deleted/{ref}', [Admin::class, 'overtimes_deleted'])->name('overtimes_deleted');
Route::get('overtimes_calendar', [Admin::class, 'overtimes_calendar'])->name('overtimes_calendar');
Route::get('overtimes_recap', [Admin::class, 'overtimes_recap'])->name('overtimes_recap');
Route::get('overtimes_etat/{etat}', [Admin::class, 'overtimes_etat'])->name('overtimes_etat');

// Manager
Route::get('manager_team', [Admin::class, 'manager_team'])->name('manager_team');
Route::get('manager_leaves_recap', [Admin::class, 'manager_leaves_recap'])->name('manager_leaves_recap');
Route::post('manager_leaves_recap_update_year', [Admin::class, 'manager_leaves_recap_update_year'])->name('manager_leaves_recap_update_year');
Route::get('manager_leaves_calendar', [Admin::class, 'manager_leaves_calendar'])->name('manager_leaves_calendar');
Route::get('manager_leaves/{etat}', [Admin::class, 'manager_leaves'])->name('manager_leaves');
Route::get('manager_leaves_show/{ref}', [Admin::class, 'manager_leaves_show'])->name('manager_leaves_show');
Route::get('manager_leaves_edit_etat/{ref}/{act}', [Admin::class, 'manager_leaves_edit_etat'])->name('manager_leaves_edit_etat');

Route::get('manager_leaves_delete/{ref}', [Admin::class, 'manager_leaves_delete'])->name('manager_leaves_delete');

Route::get('manager_leaves_all', [Admin::class, 'manager_leaves_all'])->name('manager_leaves_all');
// Manager Overtimes
Route::get('manager_overtimes_calendar', [Admin::class, 'manager_overtimes_calendar'])->name('manager_overtimes_calendar');
Route::get('manager_overtimes_recap', [Admin::class, 'manager_overtimes_recap'])->name('manager_overtimes_recap');
Route::get('manager_overtimes/{etat}', [Admin::class, 'manager_overtimes'])->name('manager_overtimes');
Route::get('manager_overtimes_show/{ref}', [Admin::class, 'manager_overtimes_show'])->name('manager_overtimes_show');
Route::get('manager_overtimes_edit_etat/{ref}/{act}', [Admin::class, 'manager_overtimes_edit_etat'])->name('manager_overtimes_edit_etat');

Route::get('manager_overtime/{etat}', [Admin::class, 'manager_overtime'])->name('manager_overtime');

Route::get('manager_overtimes_all', [Admin::class, 'manager_overtimes_all'])->name('manager_overtimes_all');

// Contracts
Route::get('contracts', [Admin::class, 'contracts'])->name('contracts');
Route::get('usersContracts/{cli}', [Admin::class, 'usersContracts'])->name('usersContracts');
Route::get('usersContractsDeleted/{ref}', [Admin::class, 'usersContractsDeleted'])->name('usersContractsDeleted');
Route::post('usersContractsAdded', [Admin::class, 'usersContractsAdded'])->name('usersContractsAdded');


// Salary
Route::get('salary', [Admin::class, 'salary'])->name('salary');
Route::get('salary_add', [Admin::class, 'salary_add'])->name('salary_add');
Route::post('salary_added', [Admin::class, 'salary_added'])->name('salary_added');

Route::get('salaryslip', [Admin::class, 'salaryslip'])->name('salaryslip');
Route::get('salaryslip_receipt/{ref}', [Admin::class, 'salaryslip_receipt'])->name('salaryslip_receipt');
Route::get('salaryslip_receipt_admin/{ref}', [Admin::class, 'salaryslip_receipt_admin'])->name('salaryslip_receipt_admin');




// leave manual
Route::get('leave_manual', [Admin::class, 'leave_manual'])->name('leave_manual');
Route::post('leave_manual_added', [Admin::class, 'leave_manual_added'])->name('leave_manual_added');
Route::get('leave_manual_deleted/{ref}', [Admin::class, 'leave_manual_deleted'])->name('leave_manual_deleted');


// Departments
Route::get('departments', [Admin::class, 'departments'])->name('departments');
Route::get('departments_add', [Admin::class, 'departments_add'])->name('departments_add');
Route::post('departments_added', [Admin::class, 'departments_added'])->name('departments_added');
Route::get('departments_edit/{ref}', [Admin::class, 'departments_edit'])->name('departments_edit');
Route::post('departments_edited/{ref}', [Admin::class, 'departments_edited'])->name('departments_edited');
Route::get('departments_deleted/{ref}', [Admin::class, 'departments_deleted'])->name('departments_deleted');

// Positions
Route::get('positions', [Admin::class, 'positions'])->name('positions');
Route::get('positions_add', [Admin::class, 'positions_add'])->name('positions_add');
Route::post('positions_added', [Admin::class, 'positions_added'])->name('positions_added');
Route::get('positions_edit/{ref}', [Admin::class, 'positions_edit'])->name('positions_edit');
Route::post('positions_edited/{ref}', [Admin::class, 'positions_edited'])->name('positions_edited');
Route::get('positions_deleted/{ref}', [Admin::class, 'positions_deleted'])->name('positions_deleted');

// Business Travel
Route::get('travel_add', [Admin::class, 'travel_add'])->name('travel_add');
Route::post('travel_added', [Admin::class, 'travel_added'])->name('travel_added');
Route::get('travel_edit/{ref}', [Admin::class, 'travel_edit'])->name('travel_edit');
Route::post('travel_edited/{ref}', [Admin::class, 'travel_edited'])->name('travel_edited');
Route::get('travel_deleted/{ref}', [Admin::class, 'travel_deleted'])->name('travel_deleted');
Route::get('travel_etat/{etat}', [Admin::class, 'travel_etat'])->name('travel_etat');
Route::get('travel/json', [Admin::class, 'travelJSON'])->name('travelJSON');
Route::post('travel_detail_added', [Admin::class, 'travel_detail_added'])->name('travel_detail_added');
Route::post('travel_sent_notif', [Admin::class, 'travel_sent_notif'])->name('travel_sent_notif');
Route::post('travel_saved', [Admin::class, 'travel_saved'])->name('travel_saved');
Route::get('travelbusiness_form/{ref}', [Admin::class, 'travelbusiness_form'])->name('travelbusiness_form');
Route::post('travelProof_added/{ref}', [Admin::class, 'travelProof_added'])->name('travelProof_added');
Route::get('travelProof_deleted/{ref}', [Admin::class, 'travelProof_deleted'])->name('travelProof_deleted');


// Manager Business Travel
Route::get('manager_travel/{etat}', [Admin::class, 'manager_travel'])->name('manager_travel');
Route::get('manager_travel_show/{ref}', [Admin::class, 'manager_travel_show'])->name('manager_travel_show');
Route::get('manager_travel_edit_etat/{ref}/{act}', [Admin::class, 'manager_travel_edit_etat'])->name('manager_travel_edit_etat');
Route::get('manager_travel_delete/{ref}', [Admin::class, 'manager_travel_delete'])->name('manager_travel_delete');
Route::get('manager_travel_all', [Admin::class, 'manager_travel_all'])->name('manager_travel_all');


// Recruitments
Route::get('recruitment_add', [Admin::class, 'recruitment_add'])->name('recruitment_add');
Route::post('recruitment_added', [Admin::class, 'recruitment_added'])->name('recruitment_added');
Route::get('recruitment_edit/{ref}', [Admin::class, 'recruitment_edit'])->name('recruitment_edit');
Route::post('recruitment_edited/{ref}', [Admin::class, 'recruitment_edited'])->name('recruitment_edited');
Route::get('recruitment_deleted/{ref}', [Admin::class, 'recruitment_deleted'])->name('recruitment_deleted');
Route::get('recruitment_etat/{etat}', [Admin::class, 'recruitment_etat'])->name('recruitment_etat');
Route::get('recruitment_form/{ref}', [Admin::class, 'recruitment_form'])->name('recruitment_form');

// Manager Recruitments
Route::get('manager_recruitment/{etat}', [Admin::class, 'manager_recruitment'])->name('manager_recruitment');
Route::get('manager_recruitment_show/{ref}', [Admin::class, 'manager_recruitment_show'])->name('manager_recruitment_show');
Route::get('manager_recruitment_edit_etat/{ref}/{act}', [Admin::class, 'manager_recruitment_edit_etat'])->name('manager_recruitment_edit_etat');
Route::get('manager_recruitment_delete/{ref}', [Admin::class, 'manager_recruitment_delete'])->name('manager_recruitment_delete');

// Resignation
Route::get('resign_add', [Admin::class, 'resign_add'])->name('resign_add');
Route::post('resign_added', [Admin::class, 'resign_added'])->name('resign_added');
Route::get('resign_edit/{ref}', [Admin::class, 'resign_edit'])->name('resign_edit');
Route::post('resign_edited/{ref}', [Admin::class, 'resign_edited'])->name('resign_edited');
Route::get('resign_deleted/{ref}', [Admin::class, 'resign_deleted'])->name('resign_deleted');
Route::get('resign_etat/{etat}', [Admin::class, 'resign_etat'])->name('resign_etat');
Route::get('resign_attach_deleted/{ref}', [Admin::class, 'resign_attach_deleted'])->name('resign_attach_deleted');
Route::get('resign_form/{ref}', [Admin::class, 'resign_form'])->name('resign_form');
Route::get('resign_checklist/{ref}', [Admin::class, 'resign_checklist'])->name('resign_checklist');

// Manager Resignation
Route::get('manager_resign/{etat}', [Admin::class, 'manager_resign'])->name('manager_resign');
Route::get('manager_resign_show/{ref}', [Admin::class, 'manager_resign_show'])->name('manager_resign_show');
Route::get('manager_resign_edit_etat/{ref}/{act}', [Admin::class, 'manager_resign_edit_etat'])->name('manager_resign_edit_etat');
Route::get('manager_resign_delete/{ref}', [Admin::class, 'manager_resign_delete'])->name('manager_resign_delete');
Route::get('manager_resign_all', [Admin::class, 'manager_resign_all'])->name('manager_resign_all');
Route::get('manager_resign_checklist/{ref}', [Admin::class, 'manager_resign_checklist'])->name('manager_resign_checklist');
Route::post('manager_resign_checklist_updated/{ref}', [Admin::class, 'manager_resign_checklist_updated'])->name('manager_resign_checklist_updated');


//Freelance
Route::get('freelance_add', [Admin::class, 'freelance_add'])->name('freelance_add');
Route::post('freelance_added', [Admin::class, 'freelance_added'])->name('freelance_added');
Route::get('freelance_edit/{ref}', [Admin::class, 'freelance_edit'])->name('freelance_edit');
Route::post('freelance_edited/{ref}', [Admin::class, 'freelance_edited'])->name('freelance_edited');
Route::get('freelance_deleted/{ref}', [Admin::class, 'freelance_deleted'])->name('freelance_del eted');
Route::get('freelance_calendar', [Admin::class, 'freelance_calendar'])->name('freelance_calendar');
Route::get('freelance_recap', [Admin::class, 'freelance_recap'])->name('freelance_recap');
Route::get('freelance_etat/{etat}', [Admin::class, 'freelance_etat'])->name('freelance_etat');

// Manager Freelance
Route::get('manager_freelance_calendar', [Admin::class, 'manager_freelance_calendar'])->name('manager_freelance_calendar');
Route::get('manager_freelance_recap', [Admin::class, 'manager_freelance_recap'])->name('manager_freelance_recap');
Route::get('manager_freelance/{etat}', [Admin::class, 'manager_freelance'])->name('manager_freelance');
Route::get('manager_freelance_show/{ref}', [Admin::class, 'manager_freelance_show'])->name('manager_freelance_show');
Route::get('manager_freelance_edit_etat/{ref}/{act}', [Admin::class, 'manager_freelance_edit_etat'])->name('manager_freelance_edit_etat');
Route::get('manager_freelance/{etat}', [Admin::class, 'manager_freelance'])->name('manager_freelance');
Route::get('manager_freelance_all', [Admin::class, 'manager_freelance_all'])->name('manager_freelance_all');
Route::get('freelance_update_admin/{ref}', [Admin::class, 'freelance_update_admin'])->name('freelance_update_admin');
Route::post('freelance_updated_admin/{ref}', [Admin::class, 'freelance_updated_admin'])->name('freelance_updated_admin');
Route::get('freelance_deleted_admin/{ref}', [Admin::class, 'freelance_deleted_admin'])->name('freelance_deleted_admin');


// After Git
Route::get('testing/{ref}', [Admin::class, 'testing'])->name('testing');
Route::get('indah/{ref}', [Admin::class, 'indah'])->name('indah');
Route::get('indah2/{ref}', [Admin::class, 'indah2'])->name('indah2');


// i m Abdel , the KING of UBUD :D :D








