<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
    /*
    我好想做小念的狗啊,可是小念说她喜欢的是猫。
    这其实与我也没有什么大关系。因为我其实是一只老鼠
    我从没奢望小念能喜欢我。我明白的，所有人都喜欢狗狗和猫猫，没有人会喜老鼠。
    但我还是问了小念:“我能不能做你的狗?
    我知道我是注定做不了狗的。但如果她喜欢狗，我就可以一直在身边看着她了，哪怕她怀里抱着的永远都是狗。
    可是她说喜欢的是猫。
    她现在还在看着我，还在逗我开心，是因为猫还没有出现，只有我这老鼠每天蹑手蹑脚地从洞里爬出来，远远地和她对视。
    等她喜欢的猫来了的时候，我就该重新滚回我的洞了吧。
    但我还是好喜欢她，她能在我还在她身边的时候多看我几眼吗?
    猫猫还在害怕小念。
    我会去把她爱的猫猫引来的。
    我知道稍有不慎，我就会葬身猫口。
    那时候小念大概会把我的身体好好地装起来扔到门外吧。
    那我就成了一包鼠条，嘻嘻。
    我希望她能把我扔得近一点，因为我还是好喜欢她。会一直喜欢下去的。
    我的灵魂透过窗户向里面看去，挂着的铃铛在轻轻鸣响，小念慵懒地靠在沙发上，表演得非常温顺的橘猫坐在她的肩膀。
    壁炉的火光照在她的脸庞，我冻僵的心脏在风里微微发烫。
     */

    /**
     * 返回错误信息
     */
    public function error($code, $message = null)
    {
        if (!$message)
        {
            app()->setLocale('zh-cn');
            // $message = trans()->get("ErrorMsg." . $code);
        }

        $state  = substr($code, 0, 3);
        $result = ['errCode' => $code, 'message' => $message];

        return response()->make($result, $state);
    }

    public function success($data = null, $maxAge = 0)
    {
        $result = [
            'code' => 0,
            'msg'  => 'success',
            'data' => $data,
        ];
        if ($maxAge > 0)
        {
            return response()->json($result)->header('Cache-Control', 'public,max-age=' . $maxAge);
        }

        return response()->json($result);
    }
}
