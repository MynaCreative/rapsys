<?php
use Illuminate\Support\Facades\Route;
use App\Repositories\Delta;

Route::get('/awb/{code}', function ($code) {
    return Delta::awbDetail($code);
});

Route::get('/smu/{code}', function ($code) {
    return Delta::awb($code);
});
