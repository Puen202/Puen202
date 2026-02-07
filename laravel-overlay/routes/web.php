<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\IpRangeController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/machines/export', [MachineController::class, 'export'])->name('machines.export')->middleware('permission:machines.view');
    Route::resource('machines', MachineController::class)->middleware('permission:machines.view');

    Route::get('/zones', [ZoneController::class, 'index'])->name('zones.index')->middleware('permission:machines.view');
    Route::post('/zones', [ZoneController::class, 'store'])->name('zones.store')->middleware('permission:machines.edit');
    Route::put('/zones/{zone}', [ZoneController::class, 'update'])->name('zones.update')->middleware('permission:machines.edit');
    Route::delete('/zones/{zone}', [ZoneController::class, 'destroy'])->name('zones.destroy')->middleware('permission:machines.edit');

    Route::get('/maps', [MapController::class, 'index'])->name('maps.index')->middleware('permission:map.view');
    Route::post('/maps/upload', [MapController::class, 'upload'])->name('maps.upload')->middleware('permission:map.edit');
    Route::post('/maps/positions', [MapController::class, 'savePositions'])->name('maps.positions')->middleware('permission:map.edit');

    Route::get('/imports', [ImportController::class, 'index'])->name('imports.index')->middleware('permission:imports.run');
    Route::post('/imports', [ImportController::class, 'run'])->name('imports.run')->middleware('permission:imports.run');

    Route::get('/ip-ranges', [IpRangeController::class, 'index'])->name('ranges.index')->middleware('permission:ranges.manage');
    Route::post('/ip-ranges', [IpRangeController::class, 'store'])->name('ranges.store')->middleware('permission:ranges.manage');
});

require __DIR__.'/auth.php';
