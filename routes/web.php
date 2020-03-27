<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/admin', function () {
    if (session()->has('admin') == 0) {
        return view('admin/index');
    } else {
        return redirect('/admin/branch');
    }
})->name('login');

Route::post('/admin/authenticate', 'BranchMasterController@checkLogin');

Route::group(['middleware' => ['admin']], function () {
    /*Branch Master */
    Route::get('/admin/branch', 'BranchMasterController@show')->name('admin.branch');
    Route::post('/admin/branch', 'BranchMasterController@store')->name('admin.addbranch');
    Route::post('/admin/updatebranch', 'BranchMasterController@update')->name('admin.updatebranch');
    Route::delete('/admin/deletebranch/{id}', 'BranchMasterController@delete')->name('admin.deletebranch');

    /*Stream Master */
    Route::get('/admin/stream', 'StreamMasterController@show')->name('admin.stream');
    Route::post('/admin/stream', 'StreamMasterController@store')->name('admin.addstream');
    Route::post('/admin/updatestream', 'StreamMasterController@update')->name('admin.updatestream');
    Route::delete('/admin/deletestream/{id}', 'StreamMasterController@delete')->name('admin.deletestream');

    /*Division Master */
    Route::get('/admin/division', 'DivisionMasterController@show')->name('admin.division');
    Route::post('/admin/division', 'DivisionMasterController@store')->name('admin.adddivision');
    Route::post('/admin/updatedivision', 'DivisionMasterController@update')->name('admin.updatedivision');
    Route::delete('/admin/deletedivision/{id}', 'DivisionMasterController@delete')->name('admin.deletedivision');

    /*Venue Master */
    Route::get('/admin/venue', 'VenueController@show')->name('admin.venue');
    Route::post('/admin/venue', 'VenueController@store')->name('admin.addvenue');
    Route::post('/admin/updatevenue', 'VenueController@update')->name('admin.updatevenue');
    Route::delete('/admin/deletevenue/{id}', 'VenueController@delete')->name('admin.deletevenue');

    /*Event Master */
    Route::get('/admin/event', 'EventMasterController@show')->name('admin.event');
    Route::post('/admin/event', 'EventMasterController@store')->name('admin.addevent');
    Route::post('/admin/updateevent', 'EventMasterController@update')->name('admin.updateevent');
    Route::post('/admin/updatestatus/{eid}/{status}', 'EventMasterController@updatestatus')->name('admin.updatestatus');
    Route::delete('/admin/deleteevent/{id}', 'EventMasterController@delete')->name('admin.deleteevent');

    /*Sub Event Master */
    Route::get('/admin/subevent', 'SubEventMasterController@show')->name('admin.subevent');
    Route::post('/admin/subevent', 'SubEventMasterController@store')->name('admin.addsubevent');
    Route::post('/admin/updatesubevent', 'SubEventMasterController@update')->name('admin.updatesubevent');
    Route::post('/admin/updatesubeventstatus/{eid}/{status}', 'SubEventMasterController@updatestatus')->name('admin.updatesubeventstatus');
    Route::delete('/admin/deletesubevent/{id}', 'SubEventMasterController@delete')->name('admin.deletesubevent');

    /*Role Master */
    Route::get('/admin/role', 'RoleController@show')->name('admin.role');
    Route::post('/admin/role', 'RoleController@store')->name('admin.addrole');
    Route::post('/admin/updaterole', 'RoleController@update')->name('admin.updaterole');    
    Route::delete('/admin/deleterole/{id}', 'RoleController@delete')->name('admin.deleterole');

    /*Choreographer */
    Route::get('/admin/choreographer', 'ChoreographerController@show')->name('admin.choreographer');
    Route::post('/admin/choreographer', 'ChoreographerController@store')->name('admin.addchoreographer');
    Route::post('/admin/updatechoreographer', 'ChoreographerController@update')->name('admin.updatechoreographer');    
    Route::delete('/admin/deletechoreographer/{id}', 'ChoreographerController@delete')->name('admin.deletechoreographer');

    /*Guest*/
    Route::get('/admin/guest', 'GuestController@show')->name('admin.guest');
    Route::post('/admin/guest', 'GuestController@store')->name('admin.addguest');
    Route::post('/admin/updateguest', 'GuestController@update')->name('admin.updateguest');    
    Route::delete('/admin/deleteguest/{id}', 'GuestController@delete')->name('admin.deleteguest');

    /*Manage user*/
    Route::get('/admin/user', 'UserMasterController@show')->name('admin.user');
    Route::post('/admin/user', 'UserMasterController@adminStore')->name('admin.adduser');
    Route::post('/admin/updateuser', 'UserMasterController@update')->name('admin.updateuser');    
    Route::delete('/admin/deleteuser/{id}', 'UserMasterController@delete')->name('admin.deleteuser');

    /*Manage Group*/
    Route::get('/admin/group', 'GroupController@show')->name('admin.group');
    Route::post('/admin/group', 'GroupController@store')->name('admin.addgroup');
    Route::post('/admin/updategroup', 'GroupController@update')->name('admin.updategroup');    
    Route::delete('/admin/deletegroup/{id}', 'GroupController@delete')->name('admin.deletegroup');
    Route::post('/ajaxSubEvent', 'GroupController@getsubevent')->name('ajaxSubEvent');

    /*Session Expire*/
    Route::get('/admin/logout', 'BranchMasterController@destroy');
});
/* Student Route */

Route::middleware('session.has.user')->group(function () {

    Route::get('/student/events', 'UserMasterController@getEvents');
    Route::post('/student/update','UserMasterController@update');
    Route::get('/student/logout', 'UserMasterController@logout');
    Route::get('/student/profile','UserMasterController@userProfile');
    Route::get('/student/change_password','UserMasterController@change_password_form');
    Route::post('/student/change_password','UserMasterController@change_password');
    Route::get('/student/registered_events','UserMasterController@registered_events');
    Route::post('/student/event_registration','EventRegistrationController@store');
    Route::post('/student/sub_event_list','UserMasterController@getSubevent');
});

Route::get('/student/registration', 'UserMasterController@get_data');
Route::post('/student/register', 'UserMasterController@store');
Route::get('/student/login','UserMasterController@get_login_form');
Route::post('/student/login', 'UserMasterController@validateUser');
Route::post('/ajaxbranch', 'UserMasterController@getStream')->name('ajaxbranch');
Route::post('/ajaxstream', 'UserMasterController@getDivision')->name('ajaxstream');
Route::get('/student/forgot_password','UserMasterController@get_forgot_password_form');
Route::post('/send/email','UserMasterController@mail');
Route::get('student/reset_password', 'UserMasterController@reset_password_form');
Route::post('/student/reset_password','UserMasterController@resetPassword');
Route::post('/ajaxGroup', 'GroupController@getGroup')->name('ajaxGroup');