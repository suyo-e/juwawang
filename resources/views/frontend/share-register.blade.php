<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>分享注册</title>
    <meta name="format-detection" content="telephone=yes">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <link rel="stylesheet" href="css/public.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/jquery-weui.min.css"/>
    <link rel="stylesheet" href="css/weui.css"/>
    <style>
        .swiper-wrapper img{
            width: 100%;
            height: 100%;
        }
        .yaoqing{
            text-align: center;
        }
        .yaoqing h3{
            font-size: 18px;
            font-weight: bold;
            padding: 20px 0 15px;
        }
        .yaoqing p{
            font-size: 14px;
        }
        .fanxiang .fxdao img{
            width: 100%;
        }
        .fanxiang ul{
            padding-bottom: 14px;
            overflow: hidden;
        }
        .fanxiang ul li{
            float:left;
            width: 50%;
            text-align: center;
        }
        .fanxiang ul li img{
            width: 45px;
            height: 45px;
        }
        .jianjie{
            width: 90%;
            margin: 80px auto 0;
            font-size: 13px;
            overflow: hidden;
        }
        .jianjie .cont{
            width: 100%;
            padding: 12px 0;
            overflow: hidden;
        }
        .jianjie .cont .left{
            width: 14%;
        }
        .jianjie .cont .right{
            width: 86%;
        }
        .xuanz{
            position: absolute;
            left:0;
            bottom:0;
            width: 100%;
        }
        .xuanz .danxuan{
            text-align: center;
        }
        .xuanz .danxuan p{
            display: inline-block;
            margin: 0 10px;
        }
        .xuanz .btn{
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="share">
    <div class="swiper-container" data-space-between='10' data-pagination='.swiper-pagination' data-autoplay="1000">
        <div class="swiper-wrapper">
            @foreach ($banners as $banner) 
                <div class="swiper-slide" style="max-height:200px"><img src="{{ $banner->pic_url }}" alt=""></div>
            @endforeach
        </div>
    </div>
    <div class="yaoqing">
        <p>您正在使用*******的邀请码</p>
        <p><b>邀请码 : 5d45d23132d</b></p>
    </div>
    <div class="jianjie">
        <div class="cont">
            <p class="lt left">方便 : </p>
            <div class="lt right">
                <p>随时随地打开聚挖网，查看最新商品线上联络商家，甩开繁琐流程。</p>
            </div>
        </div>
        <div class="cont">
            <p class="lt left">实惠 : </p>
            <div class="lt right">
                <p>提供多个商家对比价，总会有一个商家符合您的心意</p>
            </div>
        </div>
    </div>
    <div class="xuanz">
        <div class="danxuan">
            <p>
                <input id="name1" name="0" type="radio" checked/>
                <label for="name1">用户</label>
            </p>
            <p>
                <input id="name2" name="0" type="radio"/>
                <label for="name2">经销商</label>
            </p>
            <p>
                <input id="name3" name="0" type="radio"/>
                <label for="name3">生产商</label>
            </p>
        </div>
        <button class="btn" type="button">下一步</button>
    </div>
<script src="/js/jquery-1.9.1.min.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
<script src="/js/swiper.min.js"></script>

<script>
    $(".swiper-container").swiper({
        loop: true,
        autoplay: 3000
    });

</script>
</body>
</html>
