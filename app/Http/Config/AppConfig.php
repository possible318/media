<?php

namespace App\Http\Config;

class AppConfig
{
    const APP_ID_1 = '10001';

    public static array $config = [
        self::APP_ID_1 => 'WX_TTNNN',
    ];

    public static function getConfig($app): array
    {
        // 获取前缀
        $prefix = self::$config[$app];

        return [
            'app_id' => env($prefix.'_APP_ID'),
            'app_secret' => env($prefix.'_APP_SECRET'),
        ];
    }
}
