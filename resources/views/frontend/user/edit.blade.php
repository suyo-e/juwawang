@extends('frontend.layouts.app')

@section('content')
<div class="edit">
{!! Form::open(['route' => 'frontend.users.update']) !!}
    <div class="SetAvatar borderBottom">
        <a href="#">
            <span>设置头像</span>
            <input id="upload-file" type="file" name="avatar_file" class="upload-file" style="position: absolute; top: 0;right: 0; width: 100%; height:4rem; font-size: 100%; opacity: 0;" />
            <input id="avatar_input" type="hidden" name="avatar" value="{{ $profile->avatar }}"/>
            <span class="setImg"><img id="avatar_img" src="{{ $profile->avatar }}" alt=""/></span>
        </a>
    </div>
    <p class="title">个人信息</p>
    <div class="PersonalInf borderAll">
            <div class="name">
                <span>姓名 : </span>
                <input  type="text" name="name" value="{{ $user->name }}"/>
            </div>
            <div class="name name2">
                <span>手机 : </span>
                <input readonly type="number" name="phone" value="{{ $user->phone }}"/>
            </div>
            <div class="name">
                <span>性别 : </span>
                <select>
                    <option value="0" {{$profile->sex==0?'selected':''}}>女</option>
                    <option value="1" {{$profile->sex==1?'selected':''}}>男</option>
                </select>
            </div>
    @if ($profile->type != 3)
    </div>
    <p class="title">商家信息</p>
    <div class="PersonalInf borderAll">
            <div class="name name4">
                <span>商家: </span>
                <input type="text" name="industry_name" value="{{ $profile->industry_name }}" />
            </div>
    @endif
            <div class="name name4">
                <span>职业: </span>
                <input readonly type="text" name="category_name" value="{{ $profile->category_name}}"/>
            </div>
    
    
            <div class="name name4">
                <span>地区 : </span>
                <input id="city-picker" type="text" name="province_city_name" placeHolder="{{ $profile->province_city_name }}"/>
                <input id="province_city" type="hidden" name="province_city" value="{{ $user->province_city }}"/>
            </div>
    </div>
    <p class="title">主营业务</p>
    <div class="PersonalInfo">
        <div class="texta">
            <textarea name="service" cols="40" rows="8" placeholder="简单描述商家主营业务....">{{ $profile->service }}</textarea>
        </div>
        <div class="btn">
            <button type="submit" class="btnAll">保存</button>
        </div>
    </div>
{!! Form::close() !!}
</div>

@endsection

@section('footer')
@include('frontend.layouts.footer')
@endsection

@section('script')
<script src="/js/jquery.ui.widget.js"></script>
<script src="/js/jquery.iframe-transport.js"></script>
<script src="/js/jquery.fileupload.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/city-picker.min.js"></script>
<script>
$(function () {

    $("#city-picker").cityPicker({
        title: "请选择省份城市",
        showDistrict: false,
        onChange: function() {
            $("#province_city").val( $("#city-picker").attr("data-codes") );
        }
    });

    $('#upload-file').fileupload({
        url: '/upload',
        dataType: 'json',
        done: function (e, data) {
            var path = data.result.data.path;
            $("#avatar_input").val(path);
            $("#avatar_img").attr('src', path);
        }
    });
});
</script>
@endsection
