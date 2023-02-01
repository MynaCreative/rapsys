<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

$endpoint = basename(__FILE__, '.php');

Route::get('/'.$endpoint.'/{command}', function($command){
    $exitCode = Artisan::call($command);
    return "<u>{$command}</u> has been executed";
})->name($endpoint);
