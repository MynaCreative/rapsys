<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApprovalController as CurrentController;

$endpoint = basename(__FILE__, '.php');

Route::resource($endpoint, CurrentController::class)->middleware(['auth', 'verified']);
