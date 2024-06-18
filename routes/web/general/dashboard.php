<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController as CurrentController;

$endpoint = basename(__FILE__, '.php');

Route::middleware(['auth', 'verified'])
    ->controller(CurrentController::class)
    ->group(function () use ($endpoint) {
        Route::get("/", 'index')->name($endpoint);
        Route::get("{$endpoint}/chart/{type}", 'chart')->name($endpoint . '.chart');
    });
