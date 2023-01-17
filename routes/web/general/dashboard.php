<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController as CurrentController;

$endpoint = basename(__FILE__, '.php');

Route::get('/', CurrentController::class)->middleware(['auth', 'verified'])->name($endpoint);
