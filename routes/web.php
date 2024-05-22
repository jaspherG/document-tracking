<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
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


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', [HomeController::class, 'viewDashboard'])->name('dashboard');

	Route::get('sample-page-registrar', [HomeController::class, 'samplePageRegistrar'])->name('sample-page-registrar');

	Route::get('profile', [HomeController::class, 'profile'])->name('profile');

	Route::get('StudentManagement', [HomeController::class, 'StudentManagement'])->name('StudentManagement');

	Route::get('Student-List', [HomeController::class, 'StudentList'])->name('Student-List');

	Route::get('Shiftee', [HomeController::class, 'Shiftee'])->name('Shiftee');

	Route::get('Cross-Enroll', [HomeController::class, 'CrossEnroll'])->name('Cross-Enroll');

	Route::get('transferee', [HomeController::class, 'transferee'])->name('transferee');

	Route::get('re-admission', function (Request $request) {
		$user = $request->user();
		return view('laravel-examples/Re-admission', compact(['user']));
	})->name('re-admission');

	Route::get('BSIT', function (Request $request) {
		$user = $request->user();
		return view('BSIT', compact(['user']));
	})->name('BSIT');

	Route::get('BSED-MT', function (Request $request) {
		$user = $request->user();
		return view('BSED-MT', compact(['user']));
	})->name('BSED-MT');

	Route::get('BSED-EN', function (Request $request) {
		$user = $request->user();
		return view('BSED-EN', compact(['user']));
	})->name('BSED-EN');

	Route::get('BPA', function (Request $request) {
		$user = $request->user();
		return view('BPA', compact(['user']));
	})->name('BPA');

	Route::get('tables', function (Request $request) {
		$user = $request->user();
		return view('tables', compact(['user']));
	})->name('tables');

    Route::get('static-sign-in', function () {
		return view('laravel-examples/user-management');
	})->name('sign-in');

    Route::get('static-sign-up', function (Request $request) {
		$user = $request->user();
		return view('static-sign-up',  compact(['user']));
	})->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', [HomeController::class, 'viewDashboard'])->name('sign-up');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');
