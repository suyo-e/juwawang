@extends('frontend.layouts.app')

@section('content')
<div class="banner">
    <div class="swiper-container">
        <div class="swiper-wrapper">
        <?php 
            $banner_urls = json_decode($product->banner_urls);
            if(empty($banner_urls)) {
                $banner_urls = array($product->pic_url);
            }
        ?>
        @foreach ($banner_urls as $url) 
            <div class="swiper-slide"><img src="{{ $url }}" alt=""/></div>
        @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<section>
    <div class="Model">
            <p class="Modell">
                <span>{{ $product->title }}</span>
                <a href="{{ route('frontend.orders.create', ['product_id'=>$product->id]) }}">意向购买</a>
            </p>
            <div class="Model-cont">
                <span class="Price">价格 : {{ $product->price }}</span> 
                <div class="CollRead" id="lection">
                    <span id="collect" class="Collection"><img src="/image/{{ $collect?'lanshou':'Collection'}}.png" class="a" alt="">收藏</span>
                    <span class="Read"><img src="/image/Read.png" alt=""/>{{ $product->view_count }}</span>
                </div>
            </div>
    </div>
    <div class="DetailsIntro">
        <p class="deinro">详情介绍</p>
        <div class="DetailsCont">{{ $product->description }}</div>
    </div>
    <div class="SeeMerchant">
        <span class="see1">品牌 : </span>
        <span>{{ $product->brand_name }}</span>
    </div>
    <div class="SeeMerchant">
        <span class="see1">联系人 : </span>
        <span>{{ $product->contact_name }}</span>
    </div>
    <div class="SeeMerchant">
        <span class="see1">类别 : </span>
        <span>{{ $product->type_name }}</span>
    </div>
    <div class="SeeMerchant">
        <span class="see1">地区位置: </span>
        <span>广东-深圳-福田区</span>
    </div>
    <div class="SeeMerchant">
        <span class="see1">详细地址 :</span>
        <span>{{ $product->address }}</span>
    </div>
    @if ($profile->type != 3)
    <div class="SeeMerchant SeeMe">
        <a href="{{ route('frontend.profiles.show', ['user_id' => $product->user_id ]) }}">查看商家<img src="/image/on_right.png" alt=""/></a>
    </div>
    @endif
</section>
<footer>
    <ul class="foterNav">
        <li class="chakanbtn"><a><img src="/image/qq.png" alt=""/>QQ联系</a></li>
        <li class="code2"><a href="tel:{{$product->phone}}"><img src="/image/code.png" alt=""/>电话联系</a></li>
        <li><a href="sms:{{$product->phone}}"><img src="/image/Short%20.png" alt=""/>短息联系</a></li>
    </ul>
</footer>
<div id="tankuang" class="yijizhe">
    <div class="tankuang">
        <ul>
            <li>
<!--
                <div class="tab1">
                    <span>电话 : </span>
                    <a href="tel:{{$product->phone}}">{{$product->phone }}</a>
                </div>
-->
                <div class="tab1">
                    <span>QQ : </span>
                    <a>{{ $product->qq }}</a>
                </div>
<!--
                <div class="tab1">
                    <span>Wechat: </span>
                    <a>{{ $product->wechat }}</a>
                </div>
-->
                <button id="quxiao" type="button">取消</button>
            </li>
        </ul>
    </div>
</div>
{!! Form::open(['route' => 'frontend.collects.store', 'class'=>'hidden']) !!}
<input type="hidden" name="user_id" value="{{$user_id}}" />
<input type="hidden" name="product_id" value="{{$product->id}}" />
<button type="submit" class="hidden"/>
{!! Form::close() !!}
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
<script>
$(function() {
    $("#collect").click(function() {
        $("form").submit();
    });

    //点击查看联系方式弹框
    $('.chakanbtn').click(function(){
        $('#tankuang').show();
        $('#quxiao').click(function(){
            $('#tankuang').hide();
        })

    });

});

</script>
@endsection
