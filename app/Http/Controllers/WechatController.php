<?php

namespace App\Http\Controllers;

use App\Http\Servers\WechatServer;
use Illuminate\Http\Request;

class WechatController extends Controller
{
    public function code2session(Request $request): \Illuminate\Http\JsonResponse
    {
        $appId = $request->get('appId', 10001);
        $code = $request->get('code');

        $data = WechatServer::getOpenIdByWx($code, $appId);

        return $this->success($data);
    }
}
