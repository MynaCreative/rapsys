<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Foundation\Application;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/masters/item-expenses', function () {
    return Inertia::render('ItemExpense/Index');
})->name('masters.item-expenses');

Route::get('/masters/area', function () {
    return Inertia::render('Area/Index');
})->name('masters.area');

Route::get('/masters/product', function () {
    return Inertia::render('Product/Index');
})->name('masters.product');

Route::get('/masters/department', function () {
    return Inertia::render('Department/Index');
})->name('masters.department');

Route::get('/masters/vendor', function () {
    return Inertia::render('Vendor/Index');
})->name('masters.vendor');

Route::get('/masters/invoice-type', function () {
    return Inertia::render('InvoiceType/Index');
})->name('masters.invoice-type');

Route::get('/masters/item-line-type', function () {
    return Inertia::render('ItemLineType/Index');
})->name('masters.item-line-type');

Route::get('/masters/currency', function () {
    return Inertia::render('Currency/Index');
})->name('masters.currency');

Route::get('/masters/term', function () {
    return Inertia::render('Term/Index');
})->name('masters.term');

Route::get('/masters/tax', function () {
    return Inertia::render('Tax/Index');
})->name('masters.tax');

Route::get('/masters/sales-channel', function () {
    return Inertia::render('SalesChannel/Index');
})->name('masters.sales-channel');

require __DIR__.'/auth.php';
