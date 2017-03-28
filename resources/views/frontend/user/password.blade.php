@extends('frontend.layouts.app')

@section('content')
<div class="modify" style="text-align:center">
{!! Form::open(['route' => 'frontend.users.update']) !!}
    <input class="inputAll" type="number" placeholder=" 原始密码" value="{{old('old_password')}}" name="old_password">
    <input class="inputAll" type="password" placeholder=" 请输入新密码" value="{{old('new_password')}}" name="new_password">
    <input class="inputAll" type="password" placeholder=" 请再次输入新密码" value="{{old('rep_password')}}" name="rep_password">
    <input class="btnAll" type="submit" value="确认修改">
{!! Form::close() !!}
</div>

@endsection

@section('script')
@endsection
