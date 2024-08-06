<html>
<head>
    <title>上传</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- 请勿在项目正式环境中引用该 layui.css 地址 -->
    <link rel="stylesheet" href="{{URL::asset('js/layui/css/layui.css')}}" media="all">

</head>

<body>

<div class="layui-upload-drag" style="display: block;" id="ID-upload-demo-drag">
    <i class="layui-icon layui-icon-upload"></i>
    <div>点击上传，或将文件拖拽到此处</div>
    <div class="layui-hide" id="ID-upload-demo-preview">
        <hr>
        <img src="" alt="上传成功后渲染" style="max-width: 100%">
    </div>
</div>

</body>
</html>

<!-- 请勿在项目正式环境中引用该 layui.js 地址 -->
<script src="{{URL::asset('js/layui/layui.js')}}" charset="utf-8"></script>

<script>
    layui.use(function () {
        var upload = layui.upload;
        var $ = layui.$;
        // 渲染
        upload.render({
            elem: '#ID-upload-demo-drag',
            url: '/media/upload', // 实际使用时改成您自己的上传接口即可。
            accept: 'file',
            data: {
                _token: '{{ csrf_token() }}'
            },
            done: function (res) {
                layer.msg('上传成功');
                $('#ID-upload-demo-preview').removeClass('layui-hide')
                    .find('img').attr('src', res.data.file);
                console.log(res)
            }
        });
    });
</script>
