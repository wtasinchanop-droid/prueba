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

Route::get('/', function () {
    return redirect('/login');
});

// Ruta personalizada para servir Livewire JS
Route::get('/livewire/livewire.js', function () {
    $path = public_path('vendor/livewire/livewire.js');
    if (file_exists($path)) {
        return response()->file($path, [
            'Content-Type' => 'application/javascript',
            'Cache-Control' => 'public, max-age=31536000'
        ]);
    }
    abort(404);
});

// Ruta de prueba para assets
Route::get('/test-assets', function () {
    return view('test-assets');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/productos', function () {
        return view('productos');
    })->name('productos');
    Route::get('/clientes', function () {
        return view('clientes');
    })->name('clientes');
    Route::get('/facturas', function () {
        return view('facturas');
    })->name('facturas');
    Route::get('/facturas/{id}', function ($id) {
        $factura = \App\Models\Factura::with(['producto', 'cliente'])->findOrFail($id);
        return view('factura-detalle', compact('factura'));
    })->name('factura.detalle');
});
