<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>积分明细</title>
    <meta name="format-detection" content="telephone=yes">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <link rel="stylesheet" href="/css/public.css"/>
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="stylesheet" href="/css/jquery-weui.min.css"/>
    <link rel="stylesheet" href="/css/weui.css"/>
</head>
<body>
    <div>
        <ul>
        @foreach ($scores as $score) 
            <li>
                <div class="weui-cell" style="border-bottom: 1px solid #e6e6e6;font-size: 14px;">
                    <div class="weui-cell__bd">
                        <p>{{ $score->typename }} </p>
                        <p>
                            <span>{{ $score->created_at }}</span>
                        </p>
                    </div>
                    <div class="weui-cell__ft" style="color:#00a3cc">{{ $score->amount }}</div>
                </div>
            </li>
        @endforeach
        </ul>
    </div>
</body>
</html>
