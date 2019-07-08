<?php
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);
Route::match(['get', 'post'], 'register', function () {
    return abort(403, 'Forbidden');
})->name('register');

Route::get('/test', 'HomeController@test')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/checkrole', function () {
    return view('check');
})->name('checkrole');
Route::get('change', function () {
    return view('admin.changepass');
})->name('change')->middleware('auth');



Route::get('out', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('out')->middleware('auth');

Route::put('pass', 'ChangePassController@postCredentials')->name('pass')->middleware('auth');
Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware' => 'auth'], function () {
    Route::resource('root', 'RootController');
    Route::resource('ware', 'WareController');
    Route::get('resetall', 'RootController@showreset')->name('resetall');
    Route::post('reset', 'RootController@resetAll')->name('reset');
    Route::get('export', 'ExportController@export')->name('export');
    Route::get('exportprd/{id}', 'ExportController@exportprd')->name('exportprd');
    Route::get('exportnote/{id}', 'ExportController@exportnote')->name('exportnote');
    Route::get('showware', 'RootController@showWare')->name('showware');
    Route::get('showproduct/{id}', 'WareController@showProduct')->name('showproduct');
    Route::post('storenote', 'NoteController@store')->name('storenote');

});



Route::post('/testajax', 'WareController@changeUser')->name('testajax');
Route::post('/changeware', 'WareController@changeWare')->name('changeware');



