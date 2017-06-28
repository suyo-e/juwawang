@extends('frontend.layouts.app')

@section('header')
@include('frontend.layouts.header')
@endsection

@section('content')
    <div class="banner">
        <div class="swiper-container">
            <div class="swiper-wrapper">
            @foreach ($banners as $banner) 
                <div class="swiper-slide" ><a href="{{ $banner->url }}"><img src="{{ $banner->pic_url }}" alt=""/></a></div>
            @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="nav">
        <ul>
            @foreach ($icons as $icon)
            <li>
		@if ($icon->category_ids != '')
                <a href="{{route('frontend.industries.index', ['category_ids'=>$icon->category_ids, 'from'=>''])}}">
		@else
		<?php
		switch($icon->type) {
		case 1:
			$from = 'user';
		case 2:
			$from = 'agent';
		case 3:
			$from = 'manufacturer';
		}
		?>
                <a href="{{route('frontend.class', ['category_ids'=>$icon->product_ids, 'from'=>$from])}}">
		@endif
                    <img class="iocn-1" src="{{ $icon->pic_url }}" alt="" height="18px"/>
                    <p>{{ $icon->title}}</p>
                </a>
            </li>
            @endforeach
            <li>
                <a href="{{route('frontend.industries.index')}}">
                    <img src="image/nav-q.png" alt=""/>
                    <p>其他设备</p>
                </a>
            </li>
        </ul>
    </div>
    <div style="margin-bottom: 4.2rem">
        <div class="swiper-container">
            <div class="swiper-wrapper">
            <?php $counter = 0; ?>
            @foreach ($products as $arr)   
                <div class="swiper-slide" >
                    <div class="content content1">
                        <p class="hot">推荐商品</p>
                        <ul>
                        @foreach ($arr as $product)
                        @if (!$product) continue;
                        @endif
                            <li>
                                <a href="{{route('frontend.products.show', ['product_id'=>$product->id])}}">
                                <div class="weui-cell">
                                    <div class="weui-cell__bd lt">
                                        <img src="image/touxiang.png" alt=""/>
                                    </div>
                                    <div class="weui-cell__ft lt">
                                        <p><b>{{ $product->title }}</b></p>
                                        <p>价格 : <span style="color: red">{{ $product->price }}</span></p>
                                        <p>类别 : {{ $product->type_name }}</p>
                                        <p>地址 : {{ $product->address }}</p>
                                    </div>
                                </div>
                                </a>
                            </li>
                @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
            </div>
            <div class="swiper-pagination"></div>
    </div>
    <div class="content">
        <p class="hot">热门商家推荐</p>
        <ul>
        @foreach ($profiles as $profile)   
            @if (!$profile) continue;
            @endif
            <li>
            <a href="{{ route('frontend.profiles.show', ['user_id'=>$profile->user_id]) }}">
                    <div class="listCont">
                        <div class="iconbox">
                            <img src="{{ $profile->avatar }}" alt=""/>
                        </div>
                        <div class="companyName">
                        <p><b>{{ $profile->industry_name}}</b> （{{$profile->user->name}} - {{ get_profile_type_name($profile->type) }}）</p>
                            <p>{{ $profile->province_city_name.' '.$profile->address }}</p>
                        </div>
                        <div class="Authentication">
                            {!! is_profile_identity($profile->is_identity) !!}
                        </div>
                    </div>
                    <p>
                        <span class="TheMain">主营业务 : </span>
                        <span class="span1">{{ $profile->industry_service }}</span>
                    </p>
                </a>
            </li>
        @endforeach
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
