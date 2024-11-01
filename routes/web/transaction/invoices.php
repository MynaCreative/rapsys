<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController as CurrentController;

$module   = basename(dirname(__FILE__));
$endpoint = basename(__FILE__, '.php');

Route::name("{$module}.")->prefix($module)
    ->middleware(['auth', 'verified'])
    ->group(function () use ($endpoint) {
        Route::match(['post', 'patch', 'put'], $endpoint . '/save', [CurrentController::class, 'save'])->name($endpoint . '.save');
        Route::get("{$endpoint}/import-sample/{expense}", [CurrentController::class, 'importSample'])->name($endpoint . '.import-sample');
        Route::get("{$endpoint}/revision/{invoice}/{expense}", [CurrentController::class, 'revision'])->name($endpoint . '.revision');
        Route::get("{$endpoint}/smu-preview/{code}", [CurrentController::class, 'smuPreview'])->name($endpoint . '.smu-preview');
        Route::get("{$endpoint}/approval/{invoice}", [CurrentController::class, 'approval'])->name($endpoint . '.approval');
        Route::post("{$endpoint}/delta-validate/{invoice}", [CurrentController::class, 'deltaValidate'])->name($endpoint . '.deltaValidate');
        Route::resource($endpoint, CurrentController::class);
    });
