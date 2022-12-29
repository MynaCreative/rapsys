<?php
use Illuminate\Support\Facades\Route;
use App\Repositories\Delta;

Route::get('/awb/', function () {
    $code = ["717661005051","700001770020"];
    return Delta::awbDetail($code);
});

Route::get('/smu/{code}', function ($code) {
    return Delta::awb($code);
});
