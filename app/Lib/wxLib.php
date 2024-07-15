<?php

namespace App\Lib;

use Illuminate\Support\Facades\Http;

class wxLib
{
    const APP_ID_1 = '10001';

    public static array $config = [
        self::APP_ID_1 => 'WX_TTNNN',
    ];

    public static string $appid = '';

    public static string $secret = '';

    /**
     * 获取配置
     */
    private static function getConfig($app): array
    {
        // 获取前缀
        $prefix = self::$config[$app];

        return [
            'app_id' => env($prefix.'_APP_ID'),
            'app_secret' => env($prefix.'_APP_SECRET'),
        ];
    }

    /**
     * 设置app
     */
    public static function setApp($app): void
    {
        $conf = self::getConfig($app);
        self::$appid = $conf['app_id'];
        self::$secret = $conf['app_secret'];
    }

    public static function code2session($code)
    {
        $url = 'https://api.weixin.qq.com/sns/jscode2session';
        $param = [
            'appid' => self::$appid,
            'secret' => self::$secret,
            'js_code' => $code,
            'grant_type' => 'authorization_code',
        ];

        // 构建请求
        $data = Http::get($url, $param);

        return $data->json();
    }

    // AccessToken 稳定版本 每次请求不会刷新 微信会在失效前5分钟更换新token 旧token 还维持5分钟
    public static function getStableToken($force = false)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/stable_token';

        $body = [
            'appid' => self::$appid,
            'secret' => self::$secret,
            'grant_type' => 'client_credential',
            'force_refresh' => $force,
        ];
        $data = Http::post($url, $body);

        return $data->json();
    }
}
