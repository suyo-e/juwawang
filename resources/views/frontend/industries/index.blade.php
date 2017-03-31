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
            <li class="source" style="width: 33.3%">
                来源
            </li>
            <li class="clasStion" style="width: 33.3%">
                分类
            </li>
            <li class="ReleaseTime" style="width: 33.3%">
                时间
            </li>
        </ul>
    </div>
    <div class="grade-eject">
        <ul class="grade-y ejectAll">
<!--
            <li class="from" data="user"> 
                用户 
                {!! $profile_type==3?'<img src="/image/right.pic" style="width:1.5rem">':'' !!}
            </li>
-->
            @if ($profile->type != 3 || $profile->type == 1)
            {!! li_filter_render('from', '', '全部') !!}
            @endif
            @if ($profile->type != 1)
            {!! li_filter_render('from', 'agent', '经销商') !!}
            @endif
            @if ($profile->type != 3)
            {!! li_filter_render('from', 'manufacturer', '厂商') !!}
            @endif
        </ul>
        <ul class="grade-w ejectAll">
            {!! li_filter_render('category_id', '', '全部') !!}
        @if ($from != '')
            @foreach ($categories as $category) 
            {!! li_filter_render('category_id', $category->id, $category->display_name) !!}
            @endforeach
        @endif
        </ul>
        <ul class="grade-s ejectAll">
            {!! li_filter_render('time', '', '全部') !!}
            {!! li_filter_render('time', 'week', '一星期内') !!}
            {!! li_filter_render('time', 'month', '一个月内') !!}
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
                        <img src="{{$industry->profile->avatar}}" alt="">
                    </div>
                    <div class="companyName">
                        <p><b>{{ $industry->display_name}}</b> （{{$industry->user->name}} - {{ get_profile_type_name($industry->profile->type)}}）</p>
                            <p>{{ $industry->profile->province_city_name.' '.$industry->profile->address }}</p>
                    </div>
                    <div class="Authentication">
                    {!! is_profile_identity($industry->profile->is_identity) !!}
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
    var url = '{!!route("frontend.industries.index", ["category_id"=>$category_id, "time"=>$time, "from"=>$from, "category_ids"=>$category_ids])!!}';

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
