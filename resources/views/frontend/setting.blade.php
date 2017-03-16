@extends('frontend.layouts.app')

@section('content')
<div class="addressAll">
    <div class="address">
        <a href="{{ route('frontend.users.password') }}" class="DetailedAdds">修改密码</a>
    </div>
    <div class="address">
        <p class="DetailedAdds">关于版本（1.0）</p>
    </div>
    <div class="address">
        <p class="DetailedAdds">意见反馈</p>
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
