<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeltaController as CurrentController;

$subModule   = basename(dirname(__FILE__));
$endpoint = basename(__FILE__, '.php');

Route::prefix("{$module}/{$endpoint}")->name("{$module}.{$endpoint}.")
    ->middleware(['auth', 'verified'])
    ->group(function () use ($endpoint) {
        Route::get($endpoint . '/smu', [CurrentController::class, 'smu'])->name('smu');
        Route::get($endpoint . '/awb', [CurrentController::class, 'awb'])->name('awb');
        Route::get($endpoint . '/awb-detail', [CurrentController::class, 'awbDetail'])->name('awb-detail');
        Route::get($endpoint . '/awb-batch', [CurrentController::class, 'awbBatch'])->name('awb-batch');
        Route::get($endpoint . '/awb-scan-compliance', [CurrentController::class, 'awbScanCompliance'])->name('awb-scan-compliance');
        Route::get($endpoint . '/cons-detail', [CurrentController::class, 'consDetail'])->name('cons-detail');
    });
