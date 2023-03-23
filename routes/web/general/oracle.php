<?php

use Illuminate\Support\Facades\Route;
use App\Repositories\Oracle;

$endpoint = basename(__FILE__, '.php');

Route::get('/'.$endpoint.'/{table}', function($table){
    return Oracle::fetchTable($table);
})->name($endpoint);
