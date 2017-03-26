@extends('frontend.layouts.app')
<?php
//dd($profile->toArray());
//dd($industry->toArray());
$identity_urls = json_decode($industry->identity_urls);
?>

@section('content')
@if ($industry->user_id == access()->user()->id) 
<div class="headTop">
    <div class="Release" style="float:right; right:0;">
        <a href="{{ route('frontend.industries.edit') }}">编辑</a>
    </div>
</div>
@endif
<div class="baner">
    <img src="{{ $industry->avatar}}" alt="">
    <div class="userCont">
        <p class="Villain"><img src="/image/ren.png" alt=""></p>
        <p class="userIntroduce">
            <span class="daiV">{{ $industry->display_name}}({{$user->name}})<img src="/image/V.png" alt=""></span>
            <span>{{$profile->recommand_count}}人推荐</span>
        </p>
    </div>
</div>
<div class="main">
    <div class="SeeMerchant">
        <a id="onzhao" href="#">证件照
                @if (isset($identity_urls[0]))
                    <img class="seeimg" src="{{ $identity_urls[0]}}" alt="">
                @else
                    <img class="seeimg" src="/image/zhaopian.png" alt="">
                @endif
        </a>
        <div id="onblock" class="zhezhao" style="display: none;">
            <p class="motai">
                @if (isset($identity_urls[0]))
                    <img src="{{ $identity_urls[0]}}" alt="">
                @else
                @endif
                <span id="removee" class="removee">
                    <img class="remoimg" src="/image/remo.png" alt="">
                </span>
            </p>
        </div>
    </div>
    <div class="SeeMerchant">
        <a id="onyier" href="#">商家二维码<img class="seeimg" src="/image/erweima.png" alt=""></a>
        <div id="onkuai" class="zhezhao" style="display: none;">
            <p class="motai" style="height:300px">
                {!! QrCode::size(300)->generate(Request::url()); !!}
                <span id="remove" class="removee">
                    <img class="remoimg" src="/image/remo.png" alt="">
                </span>
            </p>
        </div>
    </div>
    <div class="SeeMerchant">
        <span>地区位置 : </span><span>{{ $industry->province_city_name }}</span>
    </div>
    <div class="SeeMerchant">
        <span>详细地址 : </span><span>{{ $industry->address }}</span>
    </div>
    <div class="SeeMerchant">
        <span>主营业务 : </span><span>{{ $industry->service }}</span>
    </div>
    <div class="DetailsIntro">
        <p class="deinro">简介</p>
        <div class="DetailsCont">
        {{ $industry->description }}
        </div>
    </div>
    <div class="chakanbtn">
        <button type="button">查看联系方式</button>
    </div>
</div>
<div id="tankuang" class="yijizhe">
    <div class="tankuang">
        <ul>
            <li>
                <div class="tab1">
                    <span>电话 : </span>
                    <a href="tel:13621245784">{{ $industry->phone }}</a>
                </div>
                <div class="tab1">
                    <span>QQ : </span>
                    <a href="#">{{ $industry->qq }}</a>
                </div>
                <div class="tab1">
                    <span>Wechat: </span>
                    <a href="#">{{ $industry->wechat }}</a>
                </div>
                <button id="quxiao" type="button">取消</button>
            </li>
        </ul>
    </div>
</div>
@endsection

@section('script')

<script src="/js/public.js"></script>
@endsection
