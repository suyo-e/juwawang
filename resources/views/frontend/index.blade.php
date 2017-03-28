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
                <a href="{{route('frontend.industries.index', ['category_ids'=>$icon->category_ids, 'from'=>''])}}">
                    <img class="iocn-1" src="{{ $icon->pic_url }}" alt=""/>
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
