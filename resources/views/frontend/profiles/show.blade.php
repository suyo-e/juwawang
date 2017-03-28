@extends('frontend.layouts.app')

@section('content')
<div class="headTop">
    <form method="GET" accept-charset="UTF-8">
    <div class="search">
        <p><img src="/image/search.png" alt=""></p>
        <input name="user_id" type="hidden" value="{{$user_id}}">
        <input name="product_name" type="text" placeholder="输入关键字" value="{{$product_name}}">
        <input type="submit" style="display:none">
    </div>
    </form>
    <div class="Release">
        <a href="{{ route('frontend.industries.show', ['user_id' => $user->id ]) }}">
        详细信息
        </a>
    </div>
</div>
<div class="baner">
    <img src="{{ $industry->avatar}}" alt="">
    <div class="userCont">
        <a href="{{ route('frontend.industries.show', ['user_id' => $user->id ]) }}">
        <p class="Villain">
            <img src="{{ $profile->avatar?$profile->avatar:'/image/ren.png' }}" alt="">
        </p>
        </a>
        <p class="userIntroduce">
            <span class="daiV">
                {{ $industry->display_name}}({{$user->name}})
                @if ($profile->is_identity == 1)
                <img src="/image/V.png" alt="">
                @endif
            </span>
            <span>{{ $profile->recommand_count }}人推荐</span>
        </p>
        <!-- 点赞 // 送心-->
        <p class="dainzan" style="display:block">
            <span><a href="{{ route('frontend.collects.like', ['seller_id'=>$user_id]) }}"><img class="zan a" src="/image/{{ $like?'hding':'zhan' }}.png" alt=""></a></span>
            <span><a href="{{ route('frontend.collects.collect', ['seller_id'=>$user_id]) }}"><img class="xin a" src="/image/{{ $collect?'hxin': 'shouchang'}}.png" alt=""></a></span>
        </p>
    </div>
</div>
<div class="xiala">
    <div class="scring">
        <ul>
            <li class="clasStion">
                分类
                <img src="/image/on_bottom.png" alt="">
            </li>
            <li class="ReleaseTime">
                时间
                <img src="/image/on_bottom.png" alt="">
            </li>
        </ul>
    </div>
    <div class="grade">
        @if (!empty($categories))
        <ul class="grade-w ejectAll" style="display: none;">
        @foreach ($categories as $category) 
        <a href="{{route('frontend.profiles.show', ['user_id'=>$user_id, 'category_id'=>$category->id, 'time'=>$time])}}">
            <li data="{{ $category->id }}">{{ $category->display_name }}</li>
        </a>
        @endforeach
        </ul>
        @endif
        <ul class="grade-s ejectAll" style="">
        <a href="{{route('frontend.profiles.show', ['user_id'=>$user_id, 'category_id'=>$category_id, 'time'=>''])}}">
            <li data="">全部</li>
        </a>
        <a href="{{route('frontend.profiles.show', ['user_id'=>$user_id, 'category_id'=>$category_id, 'time'=>'week'])}}">
            <li data="week">一个星期内</li>
        </a>
        <a href="{{route('frontend.profiles.show', ['user_id'=>$user_id, 'category_id'=>$category_id, 'time'=>'month'])}}">
            <li data="month">一个月内</li>
        </a>
        </ul>
    </div>
</div>
<div class="classContent">
    <ul>
        @foreach ($products as $product)
        <a href="{{ route('frontend.products.show', ['product_id' => $product->id]) }}">
        <li>
            <div class="classImg clasHeight">
                <img src="{{ $product->pic_url }}" alt="">
            </div>
            <div class="classcont">
                <p><b>{{ $product->title }}</b></p>
                <p>品牌 : {{ $product->brand_name }}</p>
                <p>价格 : <span class="price">{{ $product->price }}</span></p>
                <p>发布时间: <span>{{ $product->created_at }}</span></p>
                <p>地址 : <span>{{ $product->province_city_name }}</span></p>
            </div>
        </li>
        </a>
        @endforeach
    </ul>
</div>

@endsection


@section('script')
<script src="/js/public.js"></script>
@endsection
