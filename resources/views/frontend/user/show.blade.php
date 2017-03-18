@extends('frontend.layouts.app')

@section('content')
<div class="myBox">
    <div class="personalData borderBottom">
        <div class="Head">
            <p><img src="{{ $profile->avatar }}" alt=""/></p>
        </div>
        <div class="nameEnterprise">
            <p class="name">{{ $user->name }}</p>
            <p class="Enterprise">{{ $user->industry_name }}</p>
        </div>
        <a href="{{ route('frontend.users.show') }}" class="editData">
            <img src="/image/bianji.png" alt=""/>
            <span>编辑资料</span>
        </a>
    </div>
    <div class="Authentication borderAll">
        <span>认证以后有更多的机会</span>
        @if ($profile->is_identity == 0)
        <a href="{{ route('frontend.profiles.create') }}">开始认证</a>
        @else
        <a href="{{ route('frontend.profiles.show') }}">查看认证</a>
        @endif
    </div>
    <div class="addressAll">
        <div class="address">
            <a href="{{ route('frontend.products.index') }}">
            <p class="namePhone">
                <img src="/image/my-f.png" alt=""/>
                <span class="name">我的发布</span>
            </p>
            </a>
            <a href="{{ route('frontend.collects.index') }}">
            <p class="DetailedAdds">
                <img src="/image/my-s.png" alt=""/>
                <span>我的收藏</span>
            </p>
            </a>
        </div>
        <div class="address">
            @if ($user->type != 3)
            <a href="{{ route('frontend.industries.edit') }}">
            <p class="namePhone">
                <img src="/image/my-sp.png" alt=""/>
                <span class="name">我的商铺</span>
            </p>
            </a>
            @endif
            <a href="{{ route('frontend.orders.index') }}">
            <p class="DetailedAdds">
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
            <a href="{{ route('frontend.setting') }}" class="DetailedAdds">
                <img src="/image/my-sz.png" alt=""/>
                <span>设置</span>
            </a>
        </div>
    </div>
</div>
@endsection

@section('footer')
@include('frontend.layouts.footer')
@endsection

@section('script')
@endsection
