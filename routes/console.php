<?php

use Illuminate\Support\Facades\Schedule;

// 每秒执行一次
Schedule::command('command:demo')->everySecond();

// 每5秒执行一次
Schedule::command('command:inspire')->everyFiveSeconds();;
