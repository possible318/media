<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/photos', [\App\Http\Controllers\MediaController::class, 'JxdMedia']);

Route::get('/media/jxd', [\App\Http\Controllers\MediaController::class, 'JxdMedia']);
Route::get('/media/xn', [\App\Http\Controllers\MediaController::class, 'XnMedia']);

Route::get('/wechat/code2session', [App\Http\Controllers\WechatController::class, 'code2session']);
