@extends('frontend.layouts.app')

@section('content')
<!--
<div class="headTop shousuo">
    {!! Form::open(['route' => 'frontend.industries.index', 'method' => 'get']) !!}
    <div class="search">
        <p><img src="../../image/search.png" alt=""></p>
        <input name="display_name" type="text" placeholder="搜索您想找的商家" value="{{$display_name}}">
        <input type="submit" style="display:none" />
    </div>
    {!! Form::close() !!}
</div>
-->
    <div class="screening">
        <ul>
            <li class="source">
                来源
            </li>
            <li class="clasStion">
                分类
            </li>
            <li class="ReleaseTime">
                时间
            </li>
        </ul>
    </div>
    <div class="grade-eject">
        <ul class="grade-y ejectAll">
            <li class="from" data="user"> 
                用户 
                {!! $profile_type==3?'<img src="/image/right.pic" style="width:1.5rem">':'' !!}
            </li>
            <li class="from" data="agent"> 
                经销商
                {!! $profile_type==2?'<img src="/image/right.pic" style="width:1.5rem">':'' !!}
            </li>
            <li class="from" data="manufacturer"> 
                厂商
                {!! $profile_type==1?'<img src="/image/right.pic" style="width:1.5rem">':'' !!}
            </li>
        </ul>
        <ul class="grade-w ejectAll">
        @foreach ($categories as $category) 
            <li class="category_id" data="{{ $category->id }}">{{ $category->display_name }}</li>
        @endforeach
        </ul>
        <ul class="grade-s ejectAll">
            <li data="">全部</li>
            <li data="week">一个星期内</li>
            <li data="month">一个月内</li>
        </ul>
    </div>
<br>
<div class="content">
    <ul>
        @foreach ($industries as $industry) 
        <li>
            <a href="{{ route('frontend.profiles.show', ['user_id'=>$industry->user_id]) }}">
                <div class="listCont">
                    <div class="iconbox">
                        <img src="{{$industry->avatar}}" alt="">
                    </div>
                    <div class="companyName">
                        <p><b>{{ $industry->display_name}}</b> （{{$industry->user->name}}）</p>
                        <p>{{ $industry->province_city_name }}</p>
                    </div>
                    <div class="Authentication">
                        <span>{{$industry->profile->is_identity==1?'已认证':'未认证'}}</span>
                    </div>
                </div>
                <p>
                    <span class="TheMain">主营业务 : </span>
                    <span class="span1">{{ $industry->service }}</span>
                </p>
            </a>
        </li>
        @endforeach
    </ul>
</div>
@endsection

@section('script')
<script src="/js/public.js"></script>
<script>
    var url = '{!!route("frontend.industries.index", ["category_id"=>$category_id, "time"=>$time, "from"=>$from])!!}';

    $('.grade-eject li.category_id').click(function() {
        location.href = url + '&category_id=' + $(this).attr('data');
    });

    $('.grade-eject li.time').click(function() {
        location.href = url + '&time=' + $(this).attr('data');
    });

    $('.grade-eject li.from').click(function() {
        location.href = url + '&from=' + $(this).attr('data');
    });
</script>
@endsection
