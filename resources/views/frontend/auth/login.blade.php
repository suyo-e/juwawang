@extends('frontend.layouts.app')

@section('content')
<div class="login">
    <p class="logo">
        <img src="/image/logo.jpg" alt="">
    </p>
    {{ Form::open(['route' => 'frontend.auth.login', 'class' => 'form']) }}
        <input class="inputAll" type="text" name="phone" value="{{ old('phone') }}" placeholder=" 请输入电话号码">
        <input class="inputAll" type="password" name="password" value="{{ old('password') }}" placeholder=" 请输入密码"><br>
        <input class="btnAll" type="submit" style="width:80%" value="立即登录">
    {{ Form::close() }}
    <p class="Other">
        <span>你还没有账户？</span>
        <a class="register" href="{{ url('/register') }}">立即注册</a>
        <a class="forgetPwd" href="{{ url('/forget') }}">忘记密码</a>
    </p>
</div>
@endsection
