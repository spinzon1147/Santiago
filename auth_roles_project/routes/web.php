<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    Route::resource('productos', ProductoController::class);
    Route::resource('ventas', VentaController::class);
    Route::resource('compras', CompraController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('proveedores', ProveedorController::class);
    Route::resource('inventarios', InventarioController::class);

    Route::prefix('reportes')->name('reportes.')->group(function () {
        Route::get('/', fn () => view('reportes.index'))->name('index');
        Route::get('ventas', [ReportController::class, 'ventasPdf'])->name('ventas');
        Route::get('compras', [ReportController::class, 'comprasPdf'])->name('compras');
        Route::get('productos', [ReportController::class, 'productosPdf'])->name('productos');
    });

    Route::get('ventas/{id}/factura', [VentaController::class, 'facturaPdf'])->name('ventas.factura');

    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
