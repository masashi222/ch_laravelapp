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
    return view('welcome');
});

// TopController
Route::get('owner/top', 'TopController@owner')->name('owner.top');
Route::get('staff/top', 'TopController@staff')->name('staff.top');
Route::get('admin/top', 'TopController@admin')->name('admin.top');
Route::get('accountant/top','TopController@accountant')->name('accountant.top');

// ShiftCreateController
Route::get('owner/shift', 'ShiftCreateController@shift')->name('owner.shift');
Route::get('owner/shift_period_select', 'ShiftCreateController@shift_period_select')->name('owner.shift_period_select');
Route::post('owner/shift_period_select', 'ShiftCreateController@shift_period_select_send')->name('owner.shift_period_select_send');
Route::get('owner/shift_submit_check', 'ShiftCreateController@shift_submit_check')->name('owner.shift_submit_check');
Route::get('owner/shift_create', 'ShiftCreateController@shift_create')->name('owner.shift_create');
Route::post('owner/shift_create', 'ShiftCreateController@shift_create_add')->name('owner.shift_create_add');

// AttendanceManagementContrller
Route::get('owner/attendance_period_select', 'AttendanceManagementController@attendance_period_select')->name('owner.attendance_period_select');
Route::post('owner/attendance_period_select', 'AttendanceManagementController@attendance_period_select_send')->name('owner.attendance_period_select_send');
Route::get('owner/attendance_staff_select', 'AttendanceManagementController@attendance_staff_select')->name('owner.attendance_staff_select');
Route::get('owner/attendance_info', 'AttendanceManagementController@attendance_info')->name('owner.attendance_info');
Route::get('owner/attendance_info_delete', 'AttendanceManagementController@attendance_info_delete')->name('owner.attendance_info_delete');
Route::post('owner/salary_confirm', 'AttendanceManagementController@salary_confirm')->name('owner.salary_confirm');
Route::get('owner/attendance_info_change', 'AttendanceManagementController@attendance_info_change')->name('owner.attendance_info_change');
Route::post('owner/attendance_info_change', 'AttendanceManagementController@attendance_info_change_send')->name('owner.attendance_info_change_send');
Route::get('owner/attendance_info_register', 'AttendanceManagementController@attendance_info_register')->name('owner.attendance_info_register');
Route::post('owner/attendance_info_register', 'AttendanceManagementController@attendance_info_register_send')->name('owner.attendance_info_register_send');
Route::get('owner/payroll_period_select', 'AttendanceManagementController@payroll_period_select')->name('owner.payroll_period_select');
Route::post('owner/payroll_period_select', 'AttendanceManagementController@payroll_period_select_send')->name('owner.payroll_period_select_send');
Route::get('owner/payroll', 'AttendanceManagementController@payroll')->name('owner.payroll');
Route::get('owner/stamp_key', 'AttendanceManagementController@stamp_key')->name('owner.stamp_key');

// UserManagementController
Route::get('owner/user', 'UserManagementController@user')->name('owner.user');
Route::get('owner/user_info_delete', 'UserManagementController@user_info_delete')->name('owner.user_info_delete');
Route::get('owner/user_info_change', 'UserManagementController@user_info_change')->name('owner.user_info_change');
Route::post('owner/user_info_change', 'UserManagementController@user_info_change_send')->name('owner.user_info_change_send');
Route::get('owner/user_info_register', 'UserManagementController@user_info_register')->name('owner.user_info_register');
Route::post('owner/user_info_registe', 'UserManagementController@user_info_register_send')->name('owner.user_info_register_send');

// ShiftSubmitController
Route::get('staff/shift_submit', 'ShiftSubmitController@shift_submit')->name('staff.shift_submit');

// AttendanceStampController
Route::get('staff/attendance_info', 'AttendanceStampController@attendance_info')->name('staff.attendance_info');
Route::get('staff/stamp', 'AttendanceStampController@stamp')->name('staff.stamp');

// OwnerManagementController
Route::get('admin/owner', 'OwnerManagementController@owner')->name('admin.owner');
Route::get('admin/owner_info_delete','OwnerManagementController@owner_info_delete')->name('admin.owner_info_delete');
Route::get('admin/owner_info_change','OwnerManagementController@owner_info_change')->name('admin.owner_info_change');
Route::post('admin/owner_info_change','OwnerManagementController@owner_info_change_send')->name('admin.owner_info_change_send');
Route::get('admin/owner_info_register','OwnerManagementController@owner_info_register')->name('admin.owner_info_register');
Route::post('admin/owner_info_register','OwnerManagementController@owner_info_register_send')->name('admin.owner_info_register_send');
