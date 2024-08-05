<html>
<head>
    <title>上传</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- 请勿在项目正式环境中引用该 layui.css 地址 -->
    <link rel="stylesheet" href="{{URL::asset('js/layui/css/layui.css')}}" media="all">
</head>

<body>
<button type="button" class="layui-btn" id="ID-upload-demo-btn">
    <i class="layui-icon layui-icon-upload"></i> 图片上传
</button>

<div style="width: 132px;">
    <div class="layui-upload-list">
        <img class="layui-upload-img" id="ID-upload-demo-img" style="width: 100%; height: 92px;">
        <div id="ID-upload-demo-text"></div>
    </div>
    <div class="layui-progress layui-progress-big" lay-showPercent="yes" lay-filter="filter-demo">
        <div class="layui-progress-bar" lay-percent=""></div>
    </div>
</div>

</body>
</html>

<!-- 请勿在项目正式环境中引用该 layui.js 地址 -->
<script src="{{URL::asset('js/layui/layui.js')}}" charset="utf-8"></script>

<script>

    layui.use(function () {
        var upload = layui.upload;
        var layer = layui.layer;
        var element = layui.element;
        var $ = layui.$;
        // 单图片上传
        var uploadInst = upload.render({
            elem: '#ID-upload-demo-btn',
            url: '/media/xn/upload', // 实际使用时改成您自己的上传接口即可。
            before: function (obj) {
                // 预读本地文件示例，不支持ie8
                obj.preview(function (index, file, result) {
                    $('#ID-upload-demo-img').attr('src', result); // 图片链接（base64）
                });

                element.progress('filter-demo', '0%'); // 进度条复位
                layer.msg('上传中', {icon: 16, time: 0});
            },
            done: function (res) {
                // 若上传失败
                if (res.code > 0) {
                    return layer.msg('上传失败');
                }
                // 上传成功的一些操作
                // …
                $('#ID-upload-demo-text').html(''); // 置空上传失败的状态
            },
            error: function () {
                // 演示失败状态，并实现重传
                var demoText = $('#ID-upload-demo-text');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function () {
                    uploadInst.upload();
                });
            },
            // 进度条
            progress: function (n, elem, e) {
                element.progress('filter-demo', n + '%'); // 可配合 layui 进度条元素使用
                if (n == 100) {
                    layer.msg('上传完毕', {icon: 1});
                }
            }
        });
    });

</script>
