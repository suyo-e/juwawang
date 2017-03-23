@extends('frontend.layouts.app')

@section('content')
<div class="addressAll">
    <div class="address">
        <a href="{{ route('frontend.users.password') }}" class="DetailedAdds">修改密码</a>
    </div>
    <div class="address">
        <a href="{{ route('frontend.about') }}" class="DetailedAdds">关于版本（1.0）</a>
    </div>
    <div class="address">
        <a href="{{ route('frontend.feedback') }}" class="DetailedAdds">意见反馈</a>
    </div>
</div>
<div class="SignOut pbcCenter">
<a href="/logout">
    <button class="btnAll" type="button">退出登录</button>
</a>
</div>
@endsection

@section('script')
@endsection
