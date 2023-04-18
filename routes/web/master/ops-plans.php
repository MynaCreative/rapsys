<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpsPlanController as CurrentController;

$module   = basename(dirname(__FILE__));
$endpoint = basename(__FILE__, '.php');
$modelBinding = str($endpoint)->singular()->replace('-', '_');

Route::name("{$module}.")->prefix($module)
    ->middleware(['auth', 'verified'])
    ->group(function () use ($endpoint, $modelBinding) {
        Route::match(['post', 'put'], $endpoint . '/save', [CurrentController::class, 'save'])->name($endpoint . '.save');
        Route::post("{$endpoint}/import", [CurrentController::class, 'import'])->name($endpoint . '.import');
        Route::get("{$endpoint}/import-sample", [CurrentController::class, 'importSample'])->name($endpoint . '.import-sample');
        Route::get("{$endpoint}/export", [CurrentController::class, 'export'])->name($endpoint . '.export');
        Route::delete("{$endpoint}/{{$modelBinding}}/restore", [CurrentController::class, 'restore'])->name($endpoint . '.restore')->withTrashed();
        Route::resource($endpoint, CurrentController::class);
    });
