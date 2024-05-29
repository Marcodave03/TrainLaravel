<?php

use App\Http\Controllers\EmployeeController;
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


Route::get('/pegawai',[EmployeeController::class,'index'])->name('pegawai');
Route::get('/tambahpegawai',[EmployeeController::class,'tambahpegawai'])->name('tambahpegawai');

//insert database
Route::post('/insertdata',[EmployeeController::class,'insertdata'])->name('insertdata');

//Update
Route::get('/tampilkandata/{id}',[EmployeeController::class,'tampilkandata'])->name('tampilkandata');
Route::post('/updatedata/{id}',[EmployeeController::class,'updatedata'])->name('updatedata');

//Delete
Route::get('/delete/{id}',[EmployeeController::class,'delete'])->name('delete');

//Export PDF
Route::get('/exportpdf',[EmployeeController::class,'exportpdf'])->name('exportpdf');

//Export Excel
Route::get('/exportexcel',[EmployeeController::class,'exportexcel'])->name('exportexcel');

//Import Excel
Route::post('/importexcel',[EmployeeController::class,'importexcel'])->name('importexcel');
