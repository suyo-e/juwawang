@extends('frontend.layouts.app')

@section('content')
<div class="headTop shousuo">
    {!! Form::open(['route' => 'frontend.industries.index', 'method' => 'get']) !!}
    <div class="search">
        <p><img src="../../image/search.png" alt=""></p>
        <input name="display_name" type="text" placeholder="搜索您想找的商家" value="{{$display_name}}">
        <input type="submit" style="display:none" />
    </div>
    {!! Form::close() !!}
</div>
<div class="content">
    <ul>
        @foreach ($industries as $industry) 
        <li>
            <a href="{{ route('frontend.industries.show', ['user_id'=>$industry->user_id]) }}">
                <div class="listCont">
                    <div class="iconbox">
                        <img src="{{$industry->avatar}}" alt="">
                    </div>
                    <div class="companyName">
                        <p><b>{{ $industry->display_name}}</b> （{{$industry->profile->realname==''?$industry->user->name:$industry->profile->realname}}）</p>
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
@endsection
