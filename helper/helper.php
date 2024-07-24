<?php


use Illuminate\Support\Facades\Redis;

if (!function_exists('redis'))
{

    /**
     * 获取redis实例
     * @return mixed|\Redis
     */
    function redis(): mixed
    {
        return Redis::connection()->client();
    }
}
