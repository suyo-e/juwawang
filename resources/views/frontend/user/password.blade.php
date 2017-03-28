@extends('frontend.layouts.app')

@section('content')
{!! Form::open(['route' => 'frontend.users.update']) !!}
<div class="modify" style="text-align:center">
    <label><input class="inputAll" type="number" placeholder=" 原始密码" value="{{old('old_password')}}" name="old_password"></label>
    <label><input class="inputAll" type="password" placeholder=" 请输入新密码" value="{{old('new_password')}}" name="new_password"></label>
    <label><input class="inputAll" type="password" placeholder=" 请再次输入新密码" value="{{old('rep_password')}}" name="rep_password"></label>
    <label><input class="btnAll" type="submit" value="确认修改"></label>
</div>
{!! Form::close() !!}

@endsection

@section('script')
@endsection
