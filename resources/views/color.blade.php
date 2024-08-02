<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>颜色</title>

    <link href="/css/color.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrapper"></div>

<div id="container">
    <nav>
        <ul id="colors"></ul>
    </nav>
    <article id="data">
        <div id="color-value">
            <dl id="CMYKcolor">
                <dt class="c">C</dt>
                <dd class="c">
                    <span class="cont">0</span>
                    <span class="circle"></span>
                    <span class="r" style="mask: url(#maskingr)">
                        <span class="line"></span>
                    </span>
                    <span class="l" style="mask: url(#maskingl)">
                        <span class="line"> </span>
                    </span>
                </dd>
                <dt class="m">M</dt>
                <dd class="m">
                    <span class="cont">0</span>
                    <span class="circle"></span>
                    <span class="r" style="mask: url(#maskingr)">
                        <span class="line"></span>
                    </span>
                    <span class="l" style="mask: url(#maskingl)">
                        <span class="line"></span>
                    </span>
                </dd>
                <dt class="y">Y</dt>
                <dd class="y">
                    <span class="cont">0</span>
                    <span class="circle"></span>
                    <span class="r" style="mask: url(#maskingr)">
                        <span class="line"></span>
                    </span>
                    <span class="l" style="mask: url(#maskingl)">
                        <span class="line"></span>
                    </span>
                </dd>
                <dt class="k">K</dt>
                <dd class="k">
                    <span class="cont">0</span>
                    <span class="circle"></span>
                    <span class="r" style="mask: url(#maskingr)">
                        <span class="line" style="transform: rotate(0deg);"></span>
                    </span>
                    <span class="l" style="mask: url(#maskingl)">
                        <span class="line" style="transform: rotate(180deg);"></span>
                    </span>
                </dd>
            </dl>
            <div id="RGBcolor">
                <dl>
                    <dt class="r altText">R</dt>
                    <dd class="r"><span class="odometer">255</span></dd>
                    <dt class="g altText">G</dt>
                    <dd class="g"><span class="odometer">255</span></dd>
                    <dt class="b altText">B</dt>
                    <dd class="b"><span class="odometer">255</span></dd>
                </dl>
                <div id="RGBvalue"><input type="text" value="" readonly="readonly"></div>
            </div>
        </div>
    </article>
</div>

<script type="text/javascript">
    let colorsArray;
    const renderColor = function (color) {
        let i;
        const colorHex = color.hex,
            rgb = color.RGB,
            cmyk = color.CMYK,
            name = color.name,
            pinyin = color.pinyin.toUpperCase();


        document.getElementById('wrapper').style.backgroundColor = colorHex;
        document.getElementById('pinyin').innerHTML = pinyin;
        document.querySelector('#RGBvalue input').value = colorHex;

        document.getElementById('name').innerHTML = name;


        if (history && history.pushState) {
            const state = {
                title: name,
                url: '#' + pinyin.toLowerCase()
            };
            document.title = name + ' - 颜色';
            history.pushState(state, "颜色 - " + name, "#" + pinyin.toLowerCase());
        }

        for (i in rgb) {
            const el = document.querySelector('#RGBcolor dd.' + 'rgb'[i] + ' span');
            el.innerHTML = rgb[i];
        }

        for (i in cmyk) {
            const n = 'cmyk'[i],
                v = cmyk[i];
            document.querySelector('#CMYKcolor dd.' + n + ' .cont').innerHTML = v;
            if (v < 50) {
                document.querySelector('#CMYKcolor dd.' + n + ' .l .line').style.transform = 'rotate(180deg)';
                document.querySelector('#CMYKcolor dd.' + n + ' .r .line').style.transform = 'rotate(' + (v * 360 / 100).toString() + 'deg)';
            } else {
                document.querySelector('#CMYKcolor dd.' + n + ' .l .line').style.transform = 'rotate(' + (v * 360 / 100).toString() + 'deg)';
                document.querySelector('#CMYKcolor dd.' + n + ' .r .line').style.transform = 'rotate(180deg)';
            }
        }
    };

    const hashRenderColor = function () {
        if (location.hash != '' && location.hash.indexof('google') === -1) {
            const colorPinyin = location.hash.substring(1),
                hashColor = colorsArray.filter(function (color) {
                    return color.pinyin === colorPinyin;
                })[0];
            renderColor(hashColor);
        }
    };

    const drawArcAndLine = function (cmyk, rgb) {
        const canvas = document.createElement('canvas'),
            context = canvas.getContext('2d'),
            lineHeight = 278 - 150;

        canvas.width = 50;
        canvas.height = 278;
        cmyk.forEach(function (v, i) {
            let ctx = canvas.getContext('2d'),
                endAngle = (-90 + (360 * v / 100)) * (Math.PI / 180);

            if (v == 0) endAngle = 1.5 * Math.PI;
            ctx.beginPath();
            ctx.arc(14, 31.3 * (i + 1), 9, 1.5 * Math.PI, endAngle);
            ctx.lineWidth = 6;
            context.strokeStyle = 'white';
            ctx.stroke();
        });
        context.lineWidth = 1;
        context.moveTo(18, 150);
        context.lineTo(18, 150 + lineHeight * (rgb[0] / 255))
        context.moveTo(21, 150);
        context.lineTo(21, 150 + lineHeight * (rgb[1] / 255))
        context.moveTo(24, 150);
        context.lineTo(24, 150 + lineHeight * (rgb[2] / 255))
        context.stroke();
        return canvas;
    };

    const rgb2hsv = function (rgb) {
        const r = rgb[0] / 255, g = rgb[1] / 255, b = rgb[2] / 255;
        const max = Math.max(r, g, b), min = Math.min(r, g, b);
        let h, s, v = max;

        const d = max - min;
        s = max == 0 ? 0 : d / max;

        if (max == min) {
            h = 0;
        } else {
            switch (max) {
                case r:
                    h = (g - b) / d + (g < b ? 6 : 0);
                    break;
                case g:
                    h = (b - r) / d + 2;
                    break;
                case b:
                    h = (r - g) / d + 4;
                    break;
            }
            h /= 6;
        }

        return [h, s, v];
    };

    let activeElement = null;
    const handleColors = function (data) {
        colorsArray = JSON.parse(data);

        colorsArray.sort(function (a, b) {
            if (rgb2hsv(a.RGB)[0] === rgb2hsv(b.RGB)[0])
                return rgb2hsv(b.RGB)[1] - rgb2hsv(a.RGB)[1];
            else
                return rgb2hsv(b.RGB)[0] - rgb2hsv(a.RGB)[0];
        });

        colorsArray.forEach(function (color, i) {
            const colorLI = document.createElement('li'),
                colorDIV = document.createElement('div'),
                colorA = document.createElement('a');

            // Style
            colorLI.style.top = Math.floor(i / 7) * 300 + 'px';
            colorLI.style.left = (i - (Math.floor(i / 7) * 7)) * 65 + 'px';
            colorLI.style.borderTop = '6px solid ' + color.hex;

            colorA.innerHTML = '<span class="name" style="color: ' + color.hex + '">' + color.name + '</span>' +
                '<span class="pinyin">' + color.pinyin + '</span>' +
                '<span class="rgb">' + color.hex.replace('#', '') + '</span>';
            colorA.appendChild(drawArcAndLine(color.CMYK, color.RGB));
            colorDIV.appendChild(colorA);
            colorLI.appendChild(colorDIV);

            colorLI.addEventListener('click', function (e) {
                if (activeElement) {
                    activeElement.classList.remove('activeLi'); //by perchouli 2024.07.24
                }
                colorLI.classList.add('activeLi');
                activeElement = colorLI;
                renderColor(color);
            });
            document.getElementById('colors').appendChild(colorLI);
        });
        hashRenderColor();
    };

    const r = new XMLHttpRequest();
    r.open('GET', '/js/colors.json', true);
    r.onreadystatechange = function () {
        if (r.readyState != 4 || r.status != 200)
            return;
        handleColors(r.responseText);
    };
    r.send();

    document.getElementById('RGBcolor').addEventListener('mouseenter', function () {
        document.getElementById('RGBvalue').style.opacity = 1;
    });
    document.getElementById('RGBcolor').addEventListener('mouseleave', function () {
        document.getElementById('RGBvalue').style.opacity = 0;
    });


    window.onpopstate = function () {
        hashRenderColor();
    };

    function updateTextAlign() {
        var adArchor = document.querySelector('.ad-archor');
        if (window.innerHeight < 1000) {
            adArchor.style.textAlign = 'left';
        } else {
            adArchor.style.textAlign = 'center';
        }
    }

    window.onload = updateTextAlign;
    window.onresize = updateTextAlign;
</script>
</body>
</html>
