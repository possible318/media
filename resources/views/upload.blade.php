<html>
<head>
    <title>上传</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- 请勿在项目正式环境中引用该 layui.css 地址 -->
    <link rel="stylesheet" href="{{URL::asset('js/layui/css/layui.css')}}" media="all">

    <style>
        /*a  upload */
        .a-upload {
            /* 扩展成方框 */
            display: inline-block;
            width: 120px;
            height: 80px;
            line-height: 80px;
            position: relative;
            cursor: pointer;
            border-radius: 4px;
            overflow: hidden;
            *display: inline;
            *zoom: 1
            background-color: #f5f5f5;
            color: #666;
            border: 1px dashed #ccc;
            margin-right: 10px;
        }

        .a-upload span {
            display: inline-block;
            width: 120px;
            height: 80px;
            line-height: 80px;
            text-align: center;
        }

        .a-upload input {
            position: absolute;
            font-size: 100px;
            right: 0;
            top: 0;
            opacity: 0;
            filter: alpha(opacity=0);
            cursor: pointer
        }

        .a-upload:hover {
            color: #444;
            background: #eee;
            border-color: #ccc;
            text-decoration: none
        }

        .a-upload img {
            width: 120px;
            height: 80px;
            /*  img 在 a 层级下面   */
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
        }
    </style>
</head>

<body>
<div class="layui-input-block">
    <div class="layui-input-inline">
        <a href="javascript:;" class="a-upload">
            <input type="hidden" name="manage_id_front">
            <span>上传</span>
            <input type="file">
            <img alt="">
        </a>
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

        $('.a-upload input').on('change', function () {
            let pp = $(this);
            let file = this.files[0];
            let formData = new FormData();
            let reader = new FileReader();

            // 显示图片
            let img = pp.siblings('img');
            reader.onload = function (e) {
                img.attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
            img.show();

            formData.append('_csrf_token', '{{csrf_token()}}');
            formData.append('file', file);
            $.ajax({
                url: '/media/upload',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    // 上传成功
                    if (res.code === 0) {
                        pp.parent().find('input').val(res.data.key);
                    } else {
                        layer.msg(res.msg);
                    }
                }
            });
        });
    });

</script>
