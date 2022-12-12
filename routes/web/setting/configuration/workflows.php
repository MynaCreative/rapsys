<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkflowController as CurrentController;

$subModule   = basename(dirname(__FILE__));
$endpoint = basename(__FILE__, '.php');

Route::prefix("{$module}/{$subModule}")->name("{$module}.{$subModule}.")
->middleware(['auth', 'verified'])
->group(function () use ($endpoint){
    Route::match(['post','put'], $endpoint.'/save', [CurrentController::class, 'save'])->name($endpoint.'.save');
    Route::resource($endpoint, CurrentController::class);
});
