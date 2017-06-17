@extends('frontend.layouts.app')

@section('content')
<div class="myBox">
    <div class="personalData borderBottom">
        <div class="Head">
            <p><img src="{{ $profile->avatar }}" alt=""/></p>
        </div>
        <div class="nameEnterprise">
            <p class="name">
                {{ $user->name }}  
            </p>
            <p class="Enterprise">
                {{ $profile->industry_name }}
                (<?php
                    switch($profile->type) {
                        case 1:
                            echo '厂商';
                            break;
                        case 2:
                            echo '经销商';
                            break;
                        case 3:
                            echo '用户';
                            break;
                    } 
                ?>)
        </p>
        </div>
        <a href="{{ route('frontend.users.show') }}" class="editData">
            <img src="/image/bianji.png" alt=""/>
            <span>编辑资料</span>
        </a>
    </div>
    <div class="Authentication borderAll">
        @if ($profile->is_identity == 0)
        <span> 认证以后有更多的机会</span>
        <a href="{{ route('frontend.profiles.create') }}">开始认证</a>
        @elseif ($profile->is_identity == 1)
        <span> 认证以后有更多的机会</span>
        <a href="{{ route('frontend.profiles.create') }}">审核中</a>
        @elseif ($profile->is_identity == 2) 
        <span style="color:black"> &nbsp;&nbsp;已认证</span>
        <a style="color: black" href="{{ route('frontend.profiles.show') }}">查看认证</a>
        @elseif ($profile->is_identity == 3) 
        <span> 认证以后有更多的机会</span>
        <a href="{{ route('frontend.profiles.create') }}" style="color:red">审核未通过</a>
        @endif
    </div>
    <div class="addressAll">
        <div class="address">
<!--
            <a href="#">
                </a><p class="namePhone"><a href="#">
                    <span class="name">邀请码 : </span>
                    <span class="name">{{ $profile->invite_code }}</span>
                    </a><a style="float: right;color: #00a3cc;margin-right: 12px;" href="#">邀请好友</a>
                </p>
            
            <a href="#">
                </a><p class="namePhone"><a href="#">
                    <span class="name">我的积分 : </span>
                    <span class="name">23143212</span>
                    </a><a style="float: right;color: #00a3cc;margin-right: 12px;" href="#">更多</a>
                </p>
-->
            <a href="#">
                    <p class="namePhone">
                        <img src="/image/jifen1.png" alt="">
                        <span class="name">我的积分: 222</span>
                        <span style="float: right;padding-right: 12px;color: #00a3cc">更多</span>
                    </p>

                </a>
            <a href="#">
                    <p class="namePhone">
                        <img src="/image/yapqingma.png" alt="">
                        <span class="name">邀请码:</span>
                        <span class="name">{{ $profile->invite_code }}</span>
                        <a style="float: right;color: #00a3cc;margin-right: 12px;" href="/share">邀请好友</a>
                    </p>

                </a>
        </div>
        <div class="address">
            <a href="{{ route('frontend.products.index') }}">
            <p class="namePhone">
                <img src="/image/my-f.png" alt=""/>
                <span class="name">我的发布</span>
            </p>
            </a>
            <a href="{{ route('frontend.collects.index') }}">
            <p class="namePhone">
                <img src="/image/my-s.png" alt=""/>
                <span>我的收藏</span>
            </p>
            </a>
        </div>
        <div class="address">
            @if ($profile->type != 3)
            <a href="{{ route('frontend.profiles.show') }}">
            <p class="namePhone">
                <img src="/image/my-sp.png" alt=""/>
                <span class="name">我的商铺</span>
            </p>
            </a>
            @endif
            <a href="{{ route('frontend.orders.index') }}">
            <p class="namePhone">
                <img src="/image/my-x.png" alt=""/>
                <span class="name">我的意向订单</span>
            </p>
            </a>
<!--
            <p id="shang" class="DetailedAdds">
                <img src="/image/my-d.png" alt=""/>
                <span>去打赏平台</span>
            </p>
-->
        </div>
        <div class="address">
            <p class="namePhone">
            <a href="{{ route('frontend.setting') }}" class="DetailedAdds">
                <img src="/image/my-sz.png" alt=""/>
                <span>设置</span>
            </a>
            </p>
        </div>
    </div>
</div>
@endsection

@section('footer')
@include('frontend.layouts.footer')
@endsection

@section('script')
@endsection
