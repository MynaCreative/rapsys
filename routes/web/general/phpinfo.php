<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

$endpoint = basename(__FILE__, '.php');

Route::get('/'.$endpoint, function(){
    phpinfo();
})->name($endpoint);
