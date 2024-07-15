<?php

namespace App\Http\Controllers;

use App\Http\Logic\WechatLogic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WechatController extends Controller
{
    public function code2session(Request $request): JsonResponse
    {
        $appId = $request->get('appId', 10001);
        $code  = $request->get('code');

        $data = WechatLogic::getOpenIdByWx($code, $appId);

        return $this->success($data);
    }
}
