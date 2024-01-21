<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\admin\UserController;

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
Route::prefix('admin')->group(function(){
    Route::middleware(['admin.guest'])->group(function () {
        Route::get("/login",[UserController::class,'index'])->name('admin.login');
        Route::post("/authenticate",[UserController::class,'authenticateUser'])->name('authenticate');

    });
    Route::middleware(['admin.auth'])->group(function(){
        Route::get("/dashboard",[UserController::class,'Dashboards'])->name('admin.dashboard');
        Route::get("/logout",[UserController::class,'Logout'])->name('admin.logout');
        Route::get("/employee/{employeeId}",[UserController::class,'edit'])->name('employee.edit');
        Route::post("/employee/{employeeId}",[UserController::class,'addRemark'])->name('employee.remark.add');
        Route::get("/remark/{employeeId}",[UserController::class,'getRemark'])->name('employee.remark.get');
        
    });
});


Route::get('/', function () {
    return view('frontend.home');
});  
 Route::post("/register",[EmployeeController::class,'create'])->name('user.create');