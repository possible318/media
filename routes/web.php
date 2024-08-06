<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome'); });

// 接口
Route::get('/photos', [\App\Http\Controllers\MediaController::class, 'JxdMedia']);

// 上传
Route::get('/media/up_page', function () { return view('upload'); }); // 上传页面
Route::post('/media/upload', [\App\Http\Controllers\MediaController::class, 'Upload']); // 上传

// 尖尖xx
Route::get('/media/jxd', [\App\Http\Controllers\MediaController::class, 'JxdMedia']);

// 念念
Route::get('/media/xn', [\App\Http\Controllers\MediaController::class, 'XnMedia']);

// 微信
Route::get('/wechat/code2session', [App\Http\Controllers\WechatController::class, 'code2session']);

// 颜色
Route::get('/color', function () { return view('color'); });

// 抽奖
Route::get('/lottery', function () { return view('lottery'); });
Route::get('/lottery/config', [App\Http\Controllers\LotteryController::class, 'config']);
Route::post('/lottery/saveCfg', [App\Http\Controllers\LotteryController::class, 'saveCfg']);
Route::get('/lottery/award', [App\Http\Controllers\LotteryController::class, 'award']);
