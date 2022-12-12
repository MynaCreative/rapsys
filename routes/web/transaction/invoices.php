<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController as CurrentController;

$module   = basename(dirname(__FILE__));
$endpoint = basename(__FILE__, '.php');

Route::name("{$module}.")->prefix($module)
->middleware(['auth', 'verified'])
->group(function () use ($endpoint){
    Route::match(['post','put'], $endpoint.'/save', [CurrentController::class, 'save'])->name($endpoint.'.save');
    Route::resource($endpoint, CurrentController::class);
});
