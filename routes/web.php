<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\UbicacionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnValueMap;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/nosotros', function () {
    return view('nosotros');
})->name('nosotros');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/servicios', function () {
    return view('servicios');
})->name('servicios');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/registro', [AuthController::class, 'showRegisterForm'])->name('registro');
Route::post('/registro', [AuthController::class, 'register']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login')->with('success', 'Sesión cerrada exitosamente.');
})->name('logout');


Route::get('/reporte', function(){ 
    return view('reporte');
})->name('reporte');

Route::get('/reporte/tipo', [ReporteController::class, 'mostrarReportePorTipo'])->name('reporte.tipo');

Route::get('/reporte/ubicacion', [ReporteController::class, 'mostrarReportePorUbicacion'])->name('reporte.ubicacion');


Route::get('/movimiento', [UbicacionController::class, 'mostrarFormularioMovimiento'])->name('movimiento');

Route::post('/movimiento', [MovimientoController::class, 'store'])->name('movimiento.store');






