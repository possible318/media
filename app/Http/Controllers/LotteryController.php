<?php

namespace App\Http\Controllers;


use App\Http\Logic\LotteryLogic;
use Illuminate\Http\Request;

class LotteryController extends Controller
{

    public function index(Request $request)
    {
        return view('lottery');
    }


    public function config(Request $request)
    {
        $token = $request->session()->token();
        $cfg   = LotteryLogic::getLotteryConf($token);

        return response()->json(['token' => $token, 'cfg' => $cfg]);

    }


    public function saveCfg(Request $request)
    {
        $itemList = $request->get('item');
        $numList  = $request->get('num');

        // 构建奖品列表
        $itemMap = [];
        foreach ($itemList as $k => $item)
        {
            if (empty($item) || empty($numList[$k]))
            {
                continue;
            }
            $num = $numList[$k];

            $itemMap[$item] = $num;
        }
        // 获取csrf token
        $token = $request->session()->token();
        // 保存到缓存
        LotteryLogic::saveLotteryConf($token, $itemMap);

        return response()->json(['token' => $token]);
    }


    public function award(Request $request): \Illuminate\Http\JsonResponse
    {
        $token = $request->session()->token();

        $res = LotteryLogic::getAward($token);

        return response()->json($res);
    }

}
