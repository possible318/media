<?php

namespace App\Http\Logic;

use App\Models\MediaJxd;
use App\Models\MediaXn;
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;

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
     * 上传
     */
    public static function UploadMedia($path, $data)
    {
        $accessKey = env("QINIU_ACCESS_KEY");
        $secretKey = env("QINIU_SECRET_KEY");

        $bucket = 'low-dog';
        // 构建鉴权对象
        $auth          = new Auth($accessKey, $secretKey);
        $bucketManager = new BucketManager($auth);

        // $url = 'https://img.0x318.com/jxd/wb/0041jQI9gy1grw9wpqgbhj61o0280hdt02.jpg';

        // 上传到七牛后保存的文件名
        $fileName = md5($data);

        // 空间路径
        $key = $path . '/' . $fileName . '.jpg';

        $token     = $auth->uploadToken($bucket);
        $uploadMgr = new UploadManager();
        // 上传字符串到存储
        [$ret, $err] = $uploadMgr->put($token, $key, $data);
        // 指定抓取的文件保存名称
        // [$ret, $err] = $bucketManager->fetch($url, $bucket, $key);
        if ($err !== null)
        {
            return false;
        }
        return $key;
    }


}
