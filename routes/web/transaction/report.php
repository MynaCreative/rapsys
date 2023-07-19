<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController as CurrentController;

$module   = basename(dirname(__FILE__));
$endpoint = basename(__FILE__, '.php');

Route::name("{$module}.")->prefix($module)
    ->middleware(['auth', 'verified'])
    ->group(function () use ($endpoint) {
        Route::get("{$endpoint}/invoice-header", [CurrentController::class, 'invoiceHeader'])->name($endpoint . '.invoice-header');
        Route::get("{$endpoint}/invoice-header-export", [CurrentController::class, 'invoiceHeaderExport'])->name($endpoint . '.invoice-header-export');
        Route::get("{$endpoint}/invoice-line-manual", [CurrentController::class, 'invoiceLineManual'])->name($endpoint . '.invoice-line-manual');
        Route::get("{$endpoint}/invoice-line-manual-export", [CurrentController::class, 'invoiceLineManualExport'])->name($endpoint . '.invoice-line-manual-export');
        Route::get("{$endpoint}/invoice-line-awb", [CurrentController::class, 'invoiceLineAwb'])->name($endpoint . '.invoice-line-awb');
        Route::get("{$endpoint}/invoice-line-awb-export", [CurrentController::class, 'invoiceLineAwbExport'])->name($endpoint . '.invoice-line-awb-export');
        Route::get("{$endpoint}/invoice-line-smu", [CurrentController::class, 'invoiceLineSmu'])->name($endpoint . '.invoice-line-smu');
        Route::get("{$endpoint}/invoice-line-smu-export", [CurrentController::class, 'invoiceLineSmuExport'])->name($endpoint . '.invoice-line-smu-export');
        Route::get("{$endpoint}/oracle-header", [CurrentController::class, 'oracleHeader'])->name($endpoint . '.oracle-header');
        Route::get("{$endpoint}/oracle-header-export", [CurrentController::class, 'oracleHeaderExport'])->name($endpoint . '.oracle-header-export');
        Route::get("{$endpoint}/oracle-line", [CurrentController::class, 'oracleLine'])->name($endpoint . '.oracle-line');
        Route::get("{$endpoint}/oracle-line-export", [CurrentController::class, 'oracleLineExport'])->name($endpoint . '.oracle-line-export');
    });
