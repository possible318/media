<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/photos', [\App\Http\Controllers\MediaController::class, 'JxdMedia']);

Route::get('/media/jxd', [\App\Http\Controllers\MediaController::class, 'JxdMedia']);
Route::get('/media/xn', [\App\Http\Controllers\MediaController::class, 'XnMedia']);

Route::get('/wechat/code2session', [App\Http\Controllers\WechatController::class, 'code2session']);


// 使用中间件
Route::get('/lottery/index', [App\Http\Controllers\LotteryController::class, 'index']);
Route::get('/lottery/config', [App\Http\Controllers\LotteryController::class, 'config']);
Route::post('/lottery/saveCfg', [App\Http\Controllers\LotteryController::class, 'saveCfg']);
Route::get('/lottery/award', [App\Http\Controllers\LotteryController::class, 'award']);
