<?php

namespace App\Http\Controllers;

use App\Http\Logic\MediaLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function JxdMedia(Request $request): JsonResponse
    {
        $page  = $request->get('page', 1);
        $limit = $request->get('limit', 5);
        $force = $request->get('force', 0);

        $list = MediaLogic::GetJxdMedia($page, $limit, $force);

        return $this->success($list, 60);
    }

    public function XnMedia(Request $request): JsonResponse
    {
        $page  = $request->get('page', 1);
        $limit = $request->get('limit', 5);

        $list = MediaLogic::GetXnMedia($page, $limit);

        return $this->success($list, 60);
    }

    /**
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function Upload(Request $request): JsonResponse
    {
        $file = $request->file('file');
        if (!$file->isValid())
        {
            return $this->error('上传失败');
        }

        $path = $request->get('path', 'xn');
        $path = in_array($path, ['jxd', 'xn']) ? $path : 'xn';

        $data = $file->getContent();
        $key  = MediaLogic::UploadMedia($path, $data);

        $url = env('OSS_URL') . '/' . $key;
        return $this->success([
            'file' => $url,
        ]);
    }
}
