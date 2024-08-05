<html>
<head>
    <title></title>


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

    </style>
</head>
<body>
<div id="big-cube"></div>
</body>
</html>

<script src="{{URL::asset('js/jquery-3.7.1.min.js')}}" charset="utf-8"></script>
<script>
    //预设奖品
    let setTime;
    // 转盘跑马灯 顺时针 坐标
    let cycle = [0, 1, 2, 5, 8, 7, 6, 3];

    init();

    function init() {
        // 服务端获取奖品列表
        let prizeList = [
            {id: 0, name: "0",},
            {id: 1, name: "1",},
            {id: 2, name: "2",},
            {id: 3, name: "3",},
            {id: 4, name: "抽奖", click: 1},
            {id: 5, name: "5",},
            {id: 6, name: "6",},
            {id: 7, name: "7",},
            {id: 8, name: "8",},
        ];

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
        let mod_lottery_id = 7;
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
