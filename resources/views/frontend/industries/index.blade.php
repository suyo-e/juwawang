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
        <ul class="grade-w ejectAll" style="display: none;">
        @foreach ($categories as $category) 
            <a href="{{route('frontend.industries.index', ['category_id'=>$category->id, 'display_name'=>$display_name, 'time'=>$time])}}">
            <li data="{{ $category->id }}">{{ $category->display_name }}</li>
            </a>
        @endforeach
        </ul>
        <ul class="grade-s ejectAll" style="">
            <a href="{{route('frontend.industries.index', ['category_id'=>$category_id, 'display_name'=>$display_name])}}">
            <li data="">全部</li>
            </a>
            <a href="{{route('frontend.industries.index', ['category_id'=>$category_id, 'display_name'=>$display_name, 'time'=>'week'])}}">
            <li data="week">一个星期内</li>
            </a>
            <a href="{{route('frontend.industries.index', ['category_id'=>$category_id, 'display_name'=>$display_name, 'time'=>'month'])}}">
            <li data="month">一个月内</li>
            </a>
        </ul>
    </div>
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
@endsection
