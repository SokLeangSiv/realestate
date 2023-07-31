<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\agentcontroller;
use App\Http\Controllers\userController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Propertcon;

use App\Http\Controllers\Backend\PropertyController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// user method
Route::get('/',[userController::class,'index']);

Route::get('/dashboard', [userController::class,'UserProfile'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard',[userController::class,'UserProfileedit'])->name('dashboard.user.profile');

    Route::post('/user/profile',[userController::class,'UserProfileupdate'])->name('user.profile.store');

    Route::get('/user/profile/logout',[userController::class,'Userlogout'])->name('user.logout');

    Route::get('/user/password/change',[userController::class,'UserPasswordChange'])->name('user.password.change');

    Route::post('/user/password/update',[userController::class,'UserPasswordUpdate'])->name('user.password.update');


});


// end user method


//  admin method

Route::middleware(['auth','role:admin'])->group(function(){

    Route::get('/admin/dashboard',[adminController::class,'admindashboard'])->name('admin.dashboard');

    Route::get('/admin/logout',[admincontroller::class,'Adminlogout'])->name('admin.logout');

    Route::get('/admin/profile',[admincontroller::class,'adminprofile'])->name('admin.profile');
    Route::post('/admin/profile/store',[admincontroller::class,'adminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/profile/password',[admincontroller::class,'adminprofilepassword'])->name('admin.profile.password');

    Route::post('/admin/profile/updatepassword',[admincontroller::class,'AdminUpdatePassword'])->name('admin.updateprofile.password');


});

// end admin method


// agent method
Route::middleware(['auth','role:agent'])->group(function(){

    Route::get('/agent/dashboard',[agentcontroller::class,'agentdashboard'])->name('agent.dashboard');

});

// end agent method

Route::middleware(['auth','role:admin'])->group(function(){



    Route::controller(PropertyController::class)->group(function(){

        Route::get('admin/prperty/type','Alltype')->name('all.type');

        Route::get('admin/prperty/type/add','Addtype')->name('add.type');

        Route::post('admin/prperty/type/store','Storetype')->name('store.type');

        Route::get('admin/prperty/type/edit/{id}','Edittype')->name('edit.type');

        Route::post('admin/prperty/type/update/{id}','Updatetype')->name('update.type');

        Route::get('admin/prperty/type/delete/{id}','Deletetype')->name('delete.type');
    });

    Route::controller(Propertcon::class)->group(function(){

        Route::get('/add/property','Allproperty')->name('property.all');

        Route::get('/add/property/add','Addproperty')->name('add.property');

        Route::post('/add/property/store','Storeproperty')->name('s.property');
    
    });

    Route::controller(PropertyController::class)->group(function(){

        Route::get('admin/amarties/type','allameties')->name('amerties.all');
    
        Route::get('admin/amarties/type/add','addamenties')->name('add.amarties');
    
        Route::post('admin/amarties/type/store','storeamenties')->name('store.amarties');
    
        Route::get('admin/amarties/type/edit/{id}','Editammentie')->name('edit.amarties');
    
        Route::post('admin/amarties/type/update/{id}','Updateamentie')->name('update.amarties');
    
        Route::get('admin/amarties/type/delete/{id}','Deleteamentie')->name('delete.amarties');
    
    
    
       
    });


});











require __DIR__.'/auth.php';
