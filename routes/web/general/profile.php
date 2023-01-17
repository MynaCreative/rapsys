<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController as CurrentController;

$endpoint = basename(__FILE__, '.php');

Route::get('/'.$endpoint, CurrentController::class)->middleware(['auth', 'verified'])->name($endpoint);
