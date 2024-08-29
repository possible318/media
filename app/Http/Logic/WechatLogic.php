<?php

namespace App\Http\Logic;

use App\Lib\wxLib;
use Illuminate\Support\Facades\Cache;

class WechatLogic
{
    public static function getAccessToken($wxApp)
    {
        $key      = 'wx_acc_token:' . $wxApp;
        $tokenStr = Cache::get($key);
        if ($tokenStr)
        {
            return json_decode($tokenStr, true);
        }

        return false;
    }

    public static function setAccessToken($wxApp, $tokenAry): bool
    {
        $key = 'wx_acc_token:' . $wxApp;
        // $expire   = $tokenAry['expires_in'];
        $tokenStr = json_encode($tokenAry);

        return Cache::set($key, $tokenStr, 123);
    }

    /**
     * 微信openId
     */
    public static function getOpenIdByWx($code, $app = 10001): array
    {
        wxLib::setApp($app);
        $res = wxLib::code2session($code);

        return [
            'openid'      => $res['openid'] ?? '',
            // 'unionid'     => $res['unionid'] ?? '',
            'session_key' => $res['session_key'] ?? '',
        ];
    }
}
