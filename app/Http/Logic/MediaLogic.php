<?php

namespace App\Http\Logic;

use App\Models\MediaJxd;
use App\Models\MediaXn;

class MediaLogic
{
    const MC_KEY = 'media_list';

    public static function GetJxdMedia($page, $limit = 10, $force = 0)
    {
        // 从缓存中读取
        $key = self::MC_KEY . ':' . __FUNCTION__ . ':' . $page;
        if (!$force)
        {
            $data = cache()->get($key);
            if ($data)
            {
                return $data;
            }
        }

        [$count, $res] = MediaJxd::getMediaList($page, $limit);

        $list = [];
        foreach ($res as $item)
        {
            $url    = env('OSS_URL') . '/jxd/' . $item->platform . '/' . $item->pid . '.jpg';
            $list[] = [
                'id'      => $item->id,
                'source'  => $url,
                'thumb'   => $url . '?imageView2/2/w/200',
                'like'    => $item->like,
                'dislike' => $item->dislike,
            ];
        }

        $data = [
            'page'  => $page,
            'total' => (int) ceil($count / $limit),
            'list'  => $list,
        ];
        // 写入缓存
        cache()->put($key, $data, 60);

        return $data;
    }

    public static function GetXnMedia($page, $limit = 10)
    {
        // 从缓存中读取
        $key  = self::MC_KEY . ':' . __FUNCTION__ . ':' . $page;
        $list = cache()->get($key);
        if ($list)
        {
            return $list;
        }

        [$count, $res] = MediaXn::getMediaList($page, $limit);
        $list = [];
        foreach ($res as $item)
        {
            $url    = env('OSS_URL') . '/xn/' . $item->pid . '.jpg';
            $list[] = [
                'id'     => $item->id,
                'source' => $url,
                'thumb'  => $url . '?imageView2/2/w/200',
            ];
        }

        $data = [
            'list'  => $list,
            'page'  => $page,
            'total' => $count,
        ];
        // 写入缓存
        cache()->put($key, $data, 60);

        return $data;
    }

    /**
     * 保存媒体数据
     *
     * @return void
     */
    public static function saveXnMedia($id)
    {
        // pass
    }
}
