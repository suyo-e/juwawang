<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户分享</title>
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
        .yqma{
            text-align: center;
            margin-top: 80px;
        }
        .fanxiang{
            position: absolute;
            left:0;
            bottom:0;
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

    </style>
</head>
<body>
<div class="share">
    <div class="swiper-container" data-space-between='10' data-pagination='.swiper-pagination' data-autoplay="1000">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="img/banner1.jpg" alt=""></div>
            <div class="swiper-slide"><img src="img/banner2.png" alt=""></div>
            <div class="swiper-slide"><img src="img/banner3.png" alt=""></div>
        </div>
    </div>
    <div class="yaoqing">
        <h3>邀请朋友加入聚挖网</h3>
        <p>好友使用您的邀请码成功注册</p>
        <p>成功注册后会增加您的积分</p>
    </div>
    <div class="yqma">
        <p>您的邀请码为:</p>
        <p><b>{{ $invite_code }}</b></p>
    </div>
    <div class="fanxiang">
        <p class="fxdao"><img src="img/fxdao.png" alt=""/></p>
        <ul>
            <li>
                <p><img src="img/weixin.png" alt=""/></p>
                <p>微信好友</p>
            </li>
            <li>
                <p><img src="img/pyquan.png" alt=""/></p>
                <p>朋友圈</p>
            </li>
        </ul>
    </div>
</div>
<!--弹出框-->
<div class="confirm">
    <div class="center">
        <p>点击右上角</p>
        <p>发送给朋友或者朋友圈</p>
        <p>即可邀请好友加入聚挖网</p>
        <a class="queding" href="javascript:;">确定</a>
    </div>
</div>
<script src="/js/jquery-1.9.1.min.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
<script src="/js/swiper.min.js"></script>

<script>
    $(".swiper-container").swiper({
        loop: true,
        autoplay: 3000
    });
    $('.fanxiang ul').on('click','li',function(){
        $('.confirm').show();
        $('.queding').on('click',function(){
            $('.confirm').hide();
        })
    })
</script>
</body>
</html>
