<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShiftCreateController;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */

Route::get('/', function () {
    return view ('welcome');
});

Auth::routes(
    [
        'register' => false,
    ]
);

Route::get('/home', 'HomeController@index')->name('home');

// 'owner'権限以上のみアクセス可能
Route::group(['middleware' => ['auth', 'can:owner-higher']], function () {
    // UserManagementController
    Route::get('/user', 'UserManagementController@index')->name('user');
    Route::get('/user/register', 'UserManagementController@create')->name('user.create');
    Route::post('/user/register', 'UserManagementController@store')->name('user.store');
    Route::get('/user/userid/{userid?}', 'UserManagementController@edit')->name('user.edit');
    Route::post('/user/userid/{userid?}', 'UserManagementController@update')->name('user.update');
    Route::get('/user/delete/userid/{userid?}', 'UserManagementController@destroy')->name('user.destroy');
    // ShiftPeriodSelectController
    Route::get('/shift/period/select', 'ShiftPeriodSelectController@get')->name('shift.period.select');
    Route::post('/shift/period/select', 'ShiftPeriodSelectController@post')->name('shift.period.select.send');
    // SubmitStatusDisplayController
    Route::get('/shift/submit_status', 'SubmitStatusDisplayController')->name('shift.submit.status')
    ->middleware('shift.session.check');
    // SubmitCloseController
    Route::get('/shift/submit/close', 'SubmitCloseController')->name('shift.submit.close');
    // ShiftCreateController
    Route::get('/shift/create', 'ShiftCreateController@index')->name('shift.create')
    ->middleware('shift.session.check');
    Route::get('/shift/add', 'ShiftCreateController@add')->name('shift.add');
    Route::post('/shift/store', 'ShiftCreateController@store')->name('shift.store');
    // CreateStatusController
    Route::get('/created','CreateStatusController@create')->name('created');
    Route::get('/not_created', 'CreateStatusController@back')->name('not.created');
    // StampKeyDisplayController
    Route::get('/stamp/key','StampKeyDisplayController@index')->name('stamp.key');
    Route::get('/stamp/key/update','StampKeyDisplayController@update')->name('stamp.key.update');
    // AttendanceStaffSelectController
    Route::get('/attendance/staff/select','AttendanceStaffSelectController')->name('attendance.staff.select')
    ->middleware('attendance.session.check');
    // AttendanceManagementController
    Route::get('/attendance/userid/{userid?}', 'AttendanceManagementController@index')->name('attendance.index')
    ->middleware('attendance.session.check');
    Route::get('/attendance/register', 'AttendanceManagementController@create')->name('attendance.create')
    ->middleware('attendance.session.check');
    Route::post('/attendance/register', 'AttendanceManagementController@store')->name('attendance.store');
    Route::get('/attendance/stampid/{stampid?}', 'AttendanceManagementController@edit')->name('attendance.edit');
    Route::post('/attendance/stampid/{stampid?}', 'AttendanceManagementController@update')->name('attendance.update');
    Route::get('/attendance/delete/stampid/{stampid?}', 'AttendanceManagementController@destroy')->name('attendance.delete');
    // SalaryConfirmController
    Route::get('/salary/confirm/{userid?}', 'SalaryConfirmController')->name('salary.confirm');
});

// 'staff'権限以上のみアクセス可能
Route::group(['middleware' => ['auth', 'can:staff-higher']], function () {
    // ShiftDisplayController
    Route::get('/shift','ShiftDisplayController')->name('shift');
    // AttendancePeriodSelectController
    Route::get('/attendance/period/select','AttendancePeriodSelectController@get')->name('attendance.period.select');
    Route::post('/attendance/period/select','AttendancePeriodSelectController@post')->name('attendance.period.select.send');
    // ShiftSubmitController
    Route::get('/shift/submit', 'ShiftSubmitController@index')->name('shift.submit');
    Route::post('/shift/submit/store', 'ShiftSubmitController@store')->name('shift.submit.store');
    Route::get('/shift/submit/update/{submittalid?}', 'ShiftSubmitController@update')->name('shift.submit.update');
    Route::get('/shift/submit/delete/{submittalid?}', 'ShiftSubmitController@destroy')->name('shift.submit.destroy');
    // SubmitStatusController
    Route::get('/submitted', 'SubmitStatusController@submit')->name('submitted');
    Route::get('/not_submitted', 'SubmitStatusController@back')->name('not.submitted');
    // AttendanceStampController
    Route::get('/stamp','AttendanceStampController@index')->name('stamp');
    Route::post('/stamp','AttendanceStampController@store')->name('stamp.store');
    Route::get('/stamp/show','AttendanceStampController@show')->name('stamp.show');
    Route::post('/stamp/show','AttendanceStampController@update')->name('stamp.update');
});

// 'accountant'権限以上のみアクセス可能
Route::group(['middleware' => ['auth', 'can:accountant-higher']], function () {
    // LogoutController
    Route::get('/logout', 'LogoutController')->name('logout');
    // TopController
    Route::get('/top', 'TopController')->name('top');
    // AccountManagementController
    Route::get('/account','AccountManagementController@index')->name('account');
    Route::post('/account','AccountManagementController@update')->name('account.update');
    // PayrollPeriodSelectController
    Route::get('/payroll/period/select','PayrollPeriodSelectController@get')->name('payroll.period.select');
    Route::post('/payroll/period/select','PayrollPeriodSelectController@post')->name('payroll.period.select.send');
    // PayrollDisplayController
    Route::get('/payroll/display','PayrollDisplayController')->name('payroll')
    ->middleware('payroll.session.check');
});