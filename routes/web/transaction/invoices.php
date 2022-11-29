<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController as CurrentController;

$module   = basename(dirname(__FILE__));
$endpoint = basename(__FILE__, '.php');
$modelBinding = str($endpoint)->singular()->replace('-','_');

Route::name("{$module}.")->prefix($module)
->middleware(['auth', 'verified'])
->group(function () use ($endpoint, $modelBinding){
    Route::get($endpoint, [CurrentController::class, 'index'])->name($endpoint.'.index');
    Route::get("{$endpoint}/create", [CurrentController::class, 'create'])->name($endpoint.'.create');
});
