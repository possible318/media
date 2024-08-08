<html>
<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="{{URL::asset('js/layui/css/layui.css')}}" media="all">
    <style>
        #big-cube {
            width: 350px;
            height: 350px;
        }

        .prize {
            width: 100px;
            height: 100px;
            border: 1px solid #999;
            margin: 5px;
            text-align: center;
            line-height: 100px;
            float: left;
            border-radius: 8px;
        }

        .noting {
            border: 1px solid #bbb;
            color: red;
        }

        .prize-title {
            color: #666;
            font-weight: 500;
            font-size: 1.1rem;
            background: #fbd4aa;
            font-style: oblique;
            border: none;
        }

        #go-lottery:hover {
            color: #fff;
            background: #fbd4aa;
        }

        /*设置input num 宽度*/
        input[type="number"] {
            width: 50px;
        }
    </style>
</head>
<body>

<div class="layui-fluid">
    <div class="layui-tab" lay-filter="test-hash">
        <ul class="layui-tab-title">
            <li class="layui-this" lay-id="conf">配置</li>
            <li lay-id="run">抽奖</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <form class="layui-form layui-form-pane" action="/lottery/saveConfig" method="post">
                    @csrf
                    @foreach($conf as $item)
                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <label class="layui-form-label">奖项{{$item['id']}}</label>
                                <div class="layui-input-block">
                                    <input type="text" name="item_{{$item['id']}}" autocomplete="off" class="layui-input" value="{{$item['name']}}">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">数量</label>
                                <div class="layui-input-block">
                                    <input type="number" name="num_{{$item['id']}}" autocomplete="off" class="layui-input" value="{{$item['num']}}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="layui-form-item">
                        <input class="layui-btn layui-btn-sm" type="submit" value="确认">
                    </div>
                </form>
            </div>
            <div class="layui-tab-item">
                <div id="big-cube"></div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<script src="{{URL::asset('js/jquery-3.7.1.min.js')}}" charset="utf-8"></script>
<script src="{{URL::asset('js/layui/layui.js')}}" charset="utf-8"></script>
<script>
    var element = layui.element;

    // hash 地址定位
    var hashName = 'id'; // hash 名称
    var layid = location.hash.replace(new RegExp('^#' + hashName + '='), ''); // 获取 lay-id 值

    // 初始切换
    element.tabChange('test-hash', layid);
    // 切换事件
    element.on('tab(test-hash)', function (obj) {
        location.hash = hashName + '=' + this.getAttribute('lay-id');
    });


    //预设奖品
    let setTime;
    // 转盘跑马灯 顺时针 坐标
    let cycle = [0, 1, 2, 5, 8, 7, 6, 3];

    init();

    function init() {
        // 服务端获取奖品列表
        let prizeList = [];
        // 获取 奖品列表
        $.ajax({
            url: '/lottery/prizeList',
            type: 'get',
            async: false,
            success: function (res) {
                if (res.code === 0) {
                    prizeList = res.data.prizeList;
                }
            }
        });
        createPrizeItem(prizeList);
    }

    // 创建奖品节点
    function createPrizeItem(prizeList) {
        //删除所有奖品节点
        $('#big-cube').empty();
        //循环创建奖品节点
        for (let list of prizeList) {
            let html = '<div class="prize"">' + list.name + '</div>';
            if (list.click) {
                html = '<div class="prize prize-title noting " id="go-lottery">' + list.name + '</div>';
            }
            $('#big-cube').append(html);

        }
    }

    // 点击抽奖
    document.getElementById('go-lottery').addEventListener('click', function () {
        if (setTime) {
            return false;
        }
        // 去服务端获取中奖信息
        let award = getLotteryAward();
        // 转盘抽奖
        run(award);
    });


    function getLotteryAward() {
        // 模拟中奖信息ID
        let mod_lottery_id = 0;

        $.ajax({
            url: '/lottery/award?',
            type: 'get',
            async: false,
            success: function (res) {
                console.log(res.data.award)
                if (res.code === 0) {
                    mod_lottery_id = res.data.award;
                }
            }
        });

        // 获取ID在转盘上的位置
        for (let i = 0; i < cycle.length; i++) {
            if (cycle[i] === mod_lottery_id) {
                return i;
            }
        }
    }


    function run(award) {
        // 触发抽奖动画
        let index = 0;
        let count = 0;

        // 初始化样式
        let my_prize = $('.prize'); //获得抽奖按钮
        for (let i = 0; i < my_prize.length; i++) {
            my_prize[i].style.background = '';
            my_prize[i].style.color = '';
        }

        //定时器开始
        setTime = setInterval(function () {
            //从第二个跑马灯开始，每走一个跑马灯就把上一个跑马灯的颜色恢复白色
            if (index > 0) {
                my_prize[cycle[index - 1]].style.background = '';
                my_prize[cycle[index - 1]].style.color = '';
            }
            //跑完最后一个跑马灯又从第一个重新开始跑
            // if(index > (my_prize.length-1)){
            if (index > 7) {
                index = 0;
            }

            //跑到哪个跑马灯就把哪个变为红色背景
            my_prize[cycle[index]].style.background = '#e6722aab';
            my_prize[cycle[index]].style.color = 'white';

            //当前跑的跑马灯的下标+1
            index++;
            //总计数器+1
            count++;

            //至少跑35下，跑到预设的奖品就停下
            if (count > 12 && (index - 1) === award) {
                clearInterval(setTime); //清除定时器
                //弹出中奖提示
                if (my_prize[cycle[index - 1]].className === 'prize') {
                    setTimeout(() => {
                        alert('抽中了[' + my_prize[cycle[index - 1]].innerHTML + ']')
                    }, 100);
                }
                setTime = undefined;
            }
            //中断程序运行，防止走预设奖品后的代码
            return false;
        }, 90);
    }
</script>
