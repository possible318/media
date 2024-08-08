<?php

namespace App\Http\Controllers;


use App\Http\Logic\LotteryLogic;
use Illuminate\Http\Request;

class LotteryController extends Controller
{
    public function lotteryPage(Request $request)
    {
        $token = $request->session()->token();
        $cfg   = LotteryLogic::getLotteryConf($token);

        $default = [
            ['id' => 0, 'name' => '奖励-0', 'num' => 1],
            ['id' => 1, 'name' => '奖励-1', 'num' => 1],
            ['id' => 2, 'name' => '奖励-2', 'num' => 1],
            ['id' => 3, 'name' => '奖励-3', 'num' => 1],
            ['id' => 5, 'name' => '奖励-5', 'num' => 1],
            ['id' => 6, 'name' => '奖励-6', 'num' => 1],
            ['id' => 7, 'name' => '奖励-7', 'num' => 1],
            ['id' => 8, 'name' => '谢谢参与', 'num' => 1],
        ];
        if ($cfg)
        {
            $default = [];
            foreach ($cfg as $id => $item)
            {
                $name = $item['item'] ?? '';
                $num  = $item['num'] ?? 0;

                $default[$id] = [
                    'id'   => $id,
                    'name' => $name,
                    'num'  => $num,
                ];
            }
        }
        return view('lottery', ['conf' => $default]);
    }

    public function prizeList(Request $request)
    {
        $token = $request->session()->token();
        $cfg   = LotteryLogic::getLotteryConf($token);

        $arr = [];
        foreach ($cfg as $id => $item)
        {
            $name = $item['item'] ?? '';
            $num  = $item['num'] ?? 0;

            $arr[] = [
                'id'   => $id,
                'name' => $name,
                'num'  => $num,
            ];
        }
        $arr[] = ['id' => 4, 'name' => '抽奖', 'click' => 1, 'num' => 1];
        usort($arr, function ($a, $b) {
            return $a['id'] > $b['id'];
        });

        return $this->success(['token' => $token, 'prizeList' => $arr]);
    }

    public function award(Request $request)
    {
        $token = $request->session()->token();

        $res = LotteryLogic::getAward($token);
        // split _
        $arr = explode('_', $res);
        // 解析奖励
        $id = $arr[1] ?? '-1';
        return $this->success(['token' => $token, 'award' => $id]);
    }

    public function saveCfg(Request $request)
    {
        // 获取csrf token
        $token = $request->session()->token();

        // 获取 item_0 -> item_8 的值
        $itemMap = [];
        foreach ([0, 1, 2, 3, 5, 6, 7, 8] as $i)
        {
            $item = $request->get('item_' . $i, '');

            $num = $request->get('num_' . $i, 0);

            $itemMap[$i] = [
                'item' => $item,
                'num'  => $num,
            ];
        }
        // 保存到缓存
        LotteryLogic::saveLotteryConf($token, $itemMap);

        return redirect('/lottery#id=run');
    }


}
