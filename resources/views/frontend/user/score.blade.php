<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>积分</title>
    <meta name="format-detection" content="telephone=yes">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <link rel="stylesheet" href="/css/public.css"/>
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="stylesheet" href="/css/jquery-weui.min.css"/>
    <link rel="stylesheet" href="/css/weui.css"/>
    <style>
        .integral p{
            text-align: center;
        }
        .integral p img{
            width: 100px;
            height: 85px;
            margin-top: 60px;
        }
        .integral div{
            margin-top: 60px;
        }
        .integral .my-jifen{
            margin: 2px 0;
        }
        .integral .mingxi{
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="integral">
        <p><img src="/img/jifen.png" alt=""/></p>
        <p class="my-jifen">我的积分</p>
        <p class="color1 font20">{{ $profile->current_amount }}</p>
        <div><button class="btn" type="button">充值</button></div>
        <p class="mingxi"><a class="color1" href="/user/scoreList">积分明细</a></p>
    </div>
</body>
</html>
