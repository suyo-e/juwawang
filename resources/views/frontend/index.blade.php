@extends('frontend.layouts.app')

@section('header')
@include('frontend.layouts.header')
@endsection

@section('content')
    <div class="banner">
        <div class="swiper-container">
            <div class="swiper-wrapper">
            @foreach ($banners as $banner) 
                <div class="swiper-slide" ><img src="{{ $banner->pic_url }}" alt=""/></div>
            @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="nav">
        <ul>
            <li>
                <a href="#">
                    <img class="iocn-1" src="image/nav-w.png" alt=""/>
                    <p>挖掘机</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="image/nav-c.png" alt=""/>
                    <p>破碎锤</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="image/nav-p.png" alt=""/>
                    <p>破碎锤配件</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="image/nav-f.png" alt=""/>
                    <p>挖掘机配件</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="image/nav-s.png" alt=""/>
                    <p>挖掘属具</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="image/nav-y.png" alt=""/>
                    <p>油封系列</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="image/nav-g.png" alt=""/>
                    <p>液压管路</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="image/nav-q.png" alt=""/>
                    <p>其他设备</p>
                </a>
            </li>
        </ul>
    </div>
    <div class="content">
        <p class="hot">热门商家推荐</p>
        <ul>
            <li>
                <a href="#">
                    <div class="listCont">
                        <div class="iconbox">
                            <img src="image/touxiang.png" alt=""/>
                        </div>
                        <div class="companyName">
                            <p><b>深圳润田经销商</b> （张总）</p>
                            <p>深圳市宝安区</p>
                        </div>
                        <div class="Authentication">
                            <span>已认证</span>
                        </div>
                    </div>
                    <p>
                        <span class="TheMain">主营业务 : </span>
                        <span class="span1"> 二手挖掘机，破碎锤，大型翻斗车</span>
                    </p>
                </a>
            </li>
        </ul>
    </div>
@endsection

@section('footer')
@include('frontend.layouts.footer')
@endsection

@section('script')
    <script src="/js/swiper.min.js"></script>
    <script>
        var mySwiper = new Swiper('.swiper-container',{
            autoplay: 4000,
            pagination : '.swiper-pagination',
            paginationElement : 'li',
        });
    </script>
@endsection
