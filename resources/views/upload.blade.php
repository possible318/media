<html>
<head>
    <title>上传</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- 请勿在项目正式环境中引用该 layui.css 地址 -->
    <link rel="stylesheet" href="{{URL::asset('js/layui/css/layui.css')}}" media="all">

</head>

<body>

<div class="layui-input-block">
    <div class="layui-input-inline">
        <!-- 上传文件  -->
        <form method="post" action="/media/upload" enctype="multipart/form-data">
            @csrf
            <input type="file" name="photo">
            <input type="submit" value="提交">
        </form>
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


    });

</script>
