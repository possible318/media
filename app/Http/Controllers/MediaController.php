<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function JxdMedia(Request $request): \Illuminate\Http\JsonResponse
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $force = $request->get('force', 0);

        $list = MediaServer::GetJxdMedia($page, $limit, $force);

        return $this->success($list, 60);
    }

    public function XnMedia(Request $request): \Illuminate\Http\JsonResponse
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);

        $list = MediaServer::GetXnMedia($page, $limit);

        return $this->success($list, 60);
    }
}
