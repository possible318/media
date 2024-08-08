<?php

namespace App\Http\Logic;


use RedisException;

class LotteryLogic
{
    const LOTTERY_CONF_KEY = 'lottery_prize_list_';
    const LOTTERY_POOL_KEY = 'lottery_pool_';

    /**
     * 获取奖池配置
     * @throws RedisException
     */
    public static function getLotteryConf($id)
    {
        $mcKey = self::LOTTERY_CONF_KEY . ':' . $id;
        $conf  = redis()->get($mcKey);
        if (empty($conf))
        {
            return [];
        }
        return json_decode($conf, true);
    }

    /**
     * 保存奖池配置
     * @throws RedisException
     */
    public static function saveLotteryConf($id, $conf): void
    {
        $mcKey = self::LOTTERY_CONF_KEY . ':' . $id;
        // 先删除缓存
        redis()->del($mcKey);
        // 保存到缓存
        redis()->set($mcKey, json_encode($conf));
        // 构建奖池
        self::makeLotteryPool($id, $conf);
    }

    /**
     * 构建奖池
     * @throws RedisException
     */
    public static function makeLotteryPool($id, $conf): void
    {
        $poolKey = self::LOTTERY_POOL_KEY . $id;
        // 先删除奖池
        redis()->del($poolKey);
        // 构建奖池
        $poolList = [];
        foreach ($conf as $k => $item)
        {
            $num = $item['num'];
            for ($m = 0; $m < $num; $m++)
            {
                $poolList[] = 'item_' . $k;
            }
        }
        // 打乱顺序
        shuffle($poolList);
        foreach ($poolList as $value)
        {
            redis()->lPush($poolKey, $value);
        }
    }

    /**
     * 抽奖
     * @throws RedisException
     */
    public static function getAward($id)
    {
        $poolKey = self::LOTTERY_POOL_KEY . $id;
        $award   = redis()->lPop($poolKey);
        if (empty($award))
        {
            return '';
        }
        return $award;
    }
}
