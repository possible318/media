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
Route::get('/lottery', [App\Http\Controllers\LotteryController::class, 'lotteryPage']); // 抽奖页面
Route::get('/lottery/prizeList', [App\Http\Controllers\LotteryController::class, 'prizeList']); // 奖品列表
Route::get('/lottery/award', [App\Http\Controllers\LotteryController::class, 'award']); // 抽奖

Route::post('/lottery/saveConfig', [App\Http\Controllers\LotteryController::class, 'saveConfig']); // 保存配置
