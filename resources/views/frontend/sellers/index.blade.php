@extends('frontend.layouts.app')

@section('content')
<div class="headTop shousuo">
    <div class="search">
        <p><img src="../../image/search.png" alt=""></p>
        <input type="text" placeholder="搜索您想找的商家">
    </div>
</div>
<div class="content">
    <ul>
        @foreach ($profiles as $profile) 
        <li>
            <a href="{{ route('frontend.sellers.show', ['user_id'=>$profile->user_id]) }}">
                <div class="listCont">
                    <div class="iconbox">
                        <img src="{{$profile->avatar}}" alt="">
                    </div>
                    <div class="companyName">
                        <p><b>{{ $profile->industry_name }}</b> （{{$profile->realname}}）</p>
                        <p>{{ $profile->province_city_name }}</p>
                    </div>
                    <div class="Authentication">
                        <span>{{$profile->is_identity==1?'已认证':'未认证'}}</span>
                    </div>
                </div>
                <p>
                    <span class="TheMain">主营业务 : </span>
                    <span class="span1">{{ $profile->service }}</span>
                </p>
            </a>
        </li>
        @endforeach
    </ul>
</div>
@endsection

@section('script')

@endsection
