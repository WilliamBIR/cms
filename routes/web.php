<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\EnvioController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\PrecioController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\IpkController;

Route::get('/', WelcomeController::class);

/* Home */
Route::middleware(['auth:sanctum', 'verified'])->get('/home', [HomeController::class,'index'])->name('home');
Route::middleware(['auth:sanctum', 'verified'])->post('/home/create',[HomeController::class,'store'])->name('store.home');

/* Sucursal */
Route::middleware(['auth:sanctum', 'verified'])->get('sucursal/{sucursal}',[SucursalController::class,'index'])->name('sucursal');
Route::middleware(['auth:sanctum', 'verified'])->post('/sucursal/create',[SucursalController::class,'store'])->name('store.sucursal');

/* Area */
Route::middleware(['auth:sanctum', 'verified'])->get('area/{area}',[AreaController::class,'index'])->name('area');
Route::middleware(['auth:sanctum', 'verified'])->post('/area/create',[AreaController::class,'store'])->name('store.area');

/* Modelo */
Route::get('modelo/{modelo}',[ModeloController::class,'index'])->name('modelo');

/* Contenido Video */
Route::middleware(['auth:sanctum', 'verified'])->post('modelo/saveVideo',[VideoController::class,'store'])->name('save-video');
Route::post('video/{video}',[VideoController::class,'delete'])->name('delete-video');

Route::middleware(['auth:sanctum', 'verified'])->post('subiripk',[IpkController::class,'FileUploadPost']);



/* Contenido Imagen */
Route::middleware(['auth:sanctum', 'verified'])->post('modelo/saveImage',[ImagenController::class,'store'])->name('save-imagen');
Route::post('image/{image}',[ImagenController::class,'delete'])->name('delete-imagen');

/* Contenido Precios */
Route::post('modelo/savePrice',[PrecioController::class,'store'])->name('save-precio');

/* Envio de Contenido */
Route::post('modelo/envio',[EnvioController::class,'store'])->name('save-precio');

// @LUIS: PARTE PARA GUARDAR FIRMWARE DE IPK
Route::middleware(['auth:sanctum', 'verified'])->post('modelo/saveFirmware',[FirmwareController::class, 'store'])->name('save-firmware');
Route::post('firmware/{firmware}', [FirmwareController::class, 'delete'])->name('delete-video');


Route::middleware(['auth:sanctum', 'verified'])->get('/downloadepk/{file}',[DownloadController::class,'downloadepk']);
Route::middleware(['auth:sanctum', 'verified'])->get('/downloadipk/{file}',[DownloadController::class,'downloadipk']);
Route::middleware(['auth:sanctum', 'verified'])->get('/downloadimg/{file}',[DownloadController::class,'downloadimg']);

