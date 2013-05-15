<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>Story - 校园相册</title>
    <link rel="stylesheet" href="./extra/index/style.css"/>
</head>
<body onload="PageLoaded();">
<div id="loader">
    <p>页面正在加载中 ...</p>

    <div id="progress">
        <div class="warp">
            <div id="finish"></div>
        </div>
    </div>
</div>

<div class="media-box">
    <object id="movie" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
            codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,24" width="780"
            height="381">
        <param name="movie" value="extra/index/flash.swf"/>
        <param name="quality" value="high"/>
        <param name="menu" value="false"/>
        <param name="wmode" value="transparent"/>
        <object data="extra/index/flash.swf" width="780" height="381" type="application/x-shockwave-flash">
            <param name="quality" value="high"/>
            <param name="menu" value="false"/>
            <param name="wmode" value="transparent"/>
            <param name="pluginurl" value="http://www.macromedia.com/go/getflashplayer"/>
            MAYBE YOU SHOULD MAIL ME,SOULTEARY@QQ.COM.
        </object>
    </object>
</div>

<div class="content-box">
    <ul class="poet">
        <li class="blue"><span class="front">青</span>春的花开花谢让我疲惫却不后悔，</li>
        <li class="light">四季的雨飞雪飞让我心醉却不堪憔悴。</li>
        <li class="blue">轻轻的风青青的梦，轻轻的晨晨昏昏，</li>
        <li class="light">淡淡的云淡淡的泪，淡淡的年年岁岁。</li>
        <li class="blue">带着点流浪的喜悦我就这样一去不回，</li>
        <li class="light">没有谁暗示年少的我那想家的枯涩滋味。</li>
    </ul>
    <a href="./main.php" class="enter">点击浏览网站内容!</a>

    <div class="footer">
        <p>&copy;2011 - 2013 Soulteary. All rights reserved.</p>
        <p><a href="http://soulteary.com">soulteary.com</a></p>
    </div>
</div>
<script type="text/javascript">
    (function () {
        var titleScroll = function () {
            var index = 0;
            var text = "欢迎光临Story校园相册！";
            var len = text.length;
            var init = function () {
                document.title = text.substring(0, index + 1);
                index++;
                if (index >= len) {
                    index = 0;
                    document.title = text;
                }
                setTimeout(arguments.callee, 150);
            }
            init();
        }
        titleScroll();

        var timer;
        var hasLoaded = false;

        var PageLoading = function () {
            var index = 0;
            var scroll = document.getElementById('finish');
            var init = function () {
                if (index > 95) {
                    index = 0;
                }
                index++;
                scroll.style.left = index + 'px';
                if (!hasLoaded) {
                    timer = setTimeout(arguments.callee, 10);
                }
            }
            init();
        }
        PageLoading();

        window.PageLoaded = function () {
            clearInterval(timer);
            var loader = document.getElementById('loader');
            loader.parentNode.removeChild(loader);
        }
    })("http://soulteary.com")
</script>
</body>
</html>