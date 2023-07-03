<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\agentcontroller;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','role:admin'])->group(function(){

    Route::get('/admin/dashboard',[adminController::class,'admindashboard'])->name('admin.dashboard');

    Route::get('/admin/logout',[admincontroller::class,'Adminlogout'])->name('admin.logout');

    Route::get('/admin/profile',[admincontroller::class,'adminprofile'])->name('admin.profile');
    Route::post('/admin/profile/store',[admincontroller::class,'adminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/profile/password',[admincontroller::class,'adminprofilepassword'])->name('admin.profile.password');

    Route::post('/admin/profile/updatepassword',[admincontroller::class,'AdminUpdatePassword'])->name('admin.updateprofile.password');


});

Route::middleware(['auth','role:agent'])->group(function(){

    Route::get('/agent/dashboard',[agentcontroller::class,'agentdashboard'])->name('agent.dashboard');

});


require __DIR__.'/auth.php';
