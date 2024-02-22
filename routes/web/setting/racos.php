<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RacosController as CurrentController;

$subModule   = basename(dirname(__FILE__));
$endpoint = basename(__FILE__, '.php');

Route::prefix("{$module}/{$endpoint}")->name("{$module}.{$endpoint}.")
    ->middleware(['auth', 'verified'])
    ->group(function () use ($endpoint) {
        Route::get($endpoint . '/info', [CurrentController::class, 'info'])->name('info');
    });
