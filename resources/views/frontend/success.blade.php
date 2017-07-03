<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>发布提示</title>
    <meta name="format-detection" content="telephone=yes">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <link rel="stylesheet" href="/css/index.css"/>
</head>
<body>
    <div class="tips">
        <img src="/image/fbok.png" alt=""/>
        <p style="font-size:1.5rem">注册成功</p>
        <div class="jihui">
            <p style="color:black">扫描下方二维码关注聚挖网</p>
            <p style="color:black">即可马上获取最新资料噢</p>
            <img src="/image/erweima.jpg" alt="" style="margin-top:2rem; width:10rem" >
        @if($profile->type == 3)
			<a href="/" >
		@else
			<a href="{{ route('frontend.industries.edit') }}" >
		@endif
            <input class="btnAll" type="submit" value="确认" style="width:80%;margin-top:2rem;" >
			</a>
        </div>  
    </div>
</body>
</html>
