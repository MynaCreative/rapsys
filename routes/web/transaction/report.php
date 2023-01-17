<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController as CurrentController;

$module   = basename(dirname(__FILE__));
$endpoint = basename(__FILE__, '.php');

Route::name("{$module}.")->prefix($module)
->middleware(['auth', 'verified'])
->group(function () use ($endpoint){
    Route::resource($endpoint, CurrentController::class);
});
