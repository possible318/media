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
        $limit = $request->get('limit', 10);
        $force = $request->get('force', 0);

        $list = MediaLogic::GetJxdMedia($page, $limit, $force);

        return $this->success($list, 60);
    }

    public function XnMedia(Request $request): JsonResponse
    {
        $page  = $request->get('page', 1);
        $limit = $request->get('limit', 10);

        $list = MediaLogic::GetXnMedia($page, $limit);

        return $this->success($list, 60);
    }

    /**
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function Upload(Request $request)
    {

        $file = $request->file('file');

        $name      = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        // MediaLogic::UploadXnMedia($data);

        return $this->success($file);

    }
}
