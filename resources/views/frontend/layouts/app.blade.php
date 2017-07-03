<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>聚挖网</title>

        <!-- Meta -->
        <meta name="description" content="@yield('meta_description', 'Laravel 5 Boilerplate')">
        <meta name="author" content="@yield('meta_author', 'billqiang')">
        <meta content="yes" name="apple-mobile-web-app-capable">
        <meta content="black" name="apple-mobile-web-app-status-bar-style">
        <meta content="telephone=no" name="format-detection">
        <link rel="stylesheet" href="/css/swiper-3.4.1.min.css"/>
        <link href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css" rel="stylesheet">
        @yield('meta')

        @yield('css')
        <link rel="stylesheet" href="/css/index.css"/>
        <style>
        .hidden { display: none}
        .weui-toptips.weui-toptips_visible { top: 0; position: absolute; width: 100%; }
        </style>

        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body id="app-layout">
        @yield('header')
        @yield('content')
        @yield('footer')

        <script src="/js/jquery-1.9.1.min.js"></script>
        <script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
        @include('frontend.includes.messages')
        @yield('script')
        @include('includes.partials.ga')


		<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
		<script>
			$.get('/jsticket?url=' + location.href, function(data) {
				wx.config(JSON.parse(data.data.config));
				wx.onMenuShareAppMessage({
					title: '邀请您加入聚挖网', // 分享标题
					desc: '加入聚挖网让您的工作变得简单。通过好友邀请完成注册可以直接获得积分哦', // 分享描述
					link: data.data.redirect_url, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
					imgUrl: '', // 分享图标
					type: 'link', // 分享类型,music、video或link，不填默认为link
					dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
					success: function () { 
						// 用户确认分享后执行的回调函数
					},
					cancel: function () { 
						// 用户取消分享后执行的回调函数
					}
				});
				wx.onMenuShareTimeline({
					title: '邀请您加入聚挖网', // 分享标题
					link: data.data.redirect_url, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
					imgUrl: '', // 分享图标
					success: function () { 
						// 用户确认分享后执行的回调函数
					},
					cancel: function () { 
						// 用户取消分享后执行的回调函数
					}
				});
			});
		</script>

    </body>
</html>
