<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController as CurrentController;

$subModule   = basename(dirname(__FILE__));
$endpoint = basename(__FILE__, '.php');
$modelBinding = str($endpoint)->singular()->replace('-','_');

Route::prefix("{$module}/{$subModule}")->name("{$module}.{$subModule}.")
->middleware(['auth', 'verified'])
->group(function () use ($endpoint, $modelBinding){
    Route::match(['post','put'], $endpoint.'/save', [CurrentController::class, 'save'])->name($endpoint.'.save');
    Route::resource($endpoint, CurrentController::class);
});
