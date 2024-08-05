<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome'); });

// 接口
Route::get('/photos', [\App\Http\Controllers\MediaController::class, 'JxdMedia']);

// 尖尖
Route::get('/media/jxd', [\App\Http\Controllers\MediaController::class, 'JxdMedia']);

// 念
Route::get('/media/xn', [\App\Http\Controllers\MediaController::class, 'XnMedia']);
Route::get('/media/xn/update', [\App\Http\Controllers\MediaController::class, 'XnUpload']);

// 微信
Route::get('/wechat/code2session', [App\Http\Controllers\WechatController::class, 'code2session']);

// 颜色
Route::get('/color', function () { return view('color'); });

// 使用中间件
Route::get('/lottery', function () { return view('lottery'); });
Route::get('/lottery/config', [App\Http\Controllers\LotteryController::class, 'config']);
Route::post('/lottery/saveCfg', [App\Http\Controllers\LotteryController::class, 'saveCfg']);
Route::get('/lottery/award', [App\Http\Controllers\LotteryController::class, 'award']);
