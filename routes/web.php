<?php

use Illuminate\Support\Facades\Route;
use
App\Http\Controllers\LandingPageController;
use
App\Http\Controllers\Medicinecontroller;
use App\Http\Controllers\UserController;

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

Route::middleware(['isGuest'])->group(function(){
Route::get('/',[UserController::class,'login'])->name('login');
Route::post('/login/auth',[UserController::class,'loginAuth'])->name('login.auth');
});
Route::middleware(['isLogin'])->group(function(){
    Route::get('/logout',[UserController::class,'logout'])->name('logout');

    Route::middleware(['isAdmin'])->group(function(){

Route::get('/landing', [LandingPageController :: class,'index']) -> name('landing_page') ;

Route::get('/Medicines', [Medicinecontroller :: class,'index']) -> name('medicine') ;
Route::get('/Medicines/add', [Medicinecontroller :: class,'create']) -> name('medicine.add') ;
Route::post('/Medicines/add',[Medicinecontroller ::class,'store'])->name('medicine.add.store');
Route::delete('/Medicines/delete/{id}', [Medicinecontroller ::class,'destroy'])->name('medicine.delete');
Route::get('Medicines/edit/{id}', [MedicineController::class,'edit'])->name('medicine.edit');
Route::patch('/medicines/edit/{id}', [MedicineController::class, 'update'])->name('medicine.edit.update');
Route::put('/Medicines/update-stock/{id}',[MedicineController::class,'stockEdit'])->name('medicine.stock.edit');

Route::get('/User',[UserController ::class,'index'])->name('Users');
Route::get('/User/absen',[UserController ::class,'userLogin'])->name('Users.absen'); 
Route::post('/User/tambah-akun',[UserController ::class,'store'])->name('Users.tambah.akun'); 
Route::delete('Users/delete/{id}',[UserController::class,'destroy'])->name('Users.delete');
Route::get('Users/edit/{id}',[UserController::class,'edit'])->name('Users.edit');
Route::patch('Users/update/{id}',[UserController::class,'update'])->name('Users.edit.update');

    });
Route::get('/landing', [LandingPageController :: class,'index']) -> name('landing_page') ;

Route::get('/Medicines', [Medicinecontroller :: class,'index']) -> name('medicine') ;
Route::get('/Medicines/add', [Medicinecontroller :: class,'create']) -> name('medicine.add') ;
Route::post('/Medicines/add',[Medicinecontroller ::class,'store'])->name('medicine.add.store');
Route::delete('/Medicines/delete/{id}', [Medicinecontroller ::class,'destroy'])->name('medicine.delete');
Route::get('Medicines/edit/{id}', [MedicineController::class,'edit'])->name('medicine.edit');
Route::patch('/medicines/edit/{id}', [MedicineController::class, 'update'])->name('medicine.edit.update');
Route::put('/Medicines/update-stock/{id}',[MedicineController::class,'stockEdit'])->name('medicine.stock.edit');

Route::get('/User',[UserController ::class,'index'])->name('Users');
Route::get('/User/absen',[UserController ::class,'userLogin'])->name('Users.absen'); 
Route::post('/User/tambah-akun',[UserController ::class,'store'])->name('Users.tambah.akun'); 
Route::delete('Users/delete/{id}',[UserController::class,'destroy'])->name('Users.delete');
Route::get('Users/edit/{id}',[UserController::class,'edit'])->name('Users.edit');
Route::patch('Users/update/{id}',[UserController::class,'update'])->name('Users.edit.update');
    });