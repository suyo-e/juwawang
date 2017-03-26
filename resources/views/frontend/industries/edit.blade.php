@extends('frontend.layouts.app')

@section('content')

{!! Form::open(['route' => 'frontend.industries.update']) !!}
<div class="bjMap">
    <img id="upload-avatar-img" src="{{ $industry->avatar }}" alt="">
    <p class="bjBtn">
        <img src="/image/camera.png" alt=""><br>
        <span class="file">
            <input id="upload-avatar" type="file" name="avatar_file" value="{{ $industry->avatar }}" />
            <input id="upload-avatar-input" type="hidden" name="avatar" value="{{ $industry->avatar }}" />
        </span>
    </p>
    <span class="Prompt">上传店铺背景图</span>
</div>
<div class="main">
    <div class="SeeMerchant">
        <a id="onzhao" class="onbutton" href=" ">
            证件照
            <label for="seeimg_file" class="seeimg_file"></label>
            <input type="file" id="seeimg_file">
        </a >
<!--
        <a id="onzhao" class="onbutton" >证件照
            <img id="upload-identity-img" class="seeimg" src="{{ $identity_urls[0] }}" alt="">
            <input id="upload-identity" type="file" class="file" name="identity_url_file" value="{{ $identity_urls[0] }}"/>
            <input type="hidden" id="upload-identity-input" name="identity_url" value="{{ $identity_urls[0] }}"/>
        </a>
-->
        <div id="onblock" class="zhezhao" style="display: none;">
            <p class="motai" style="display: none;">
                <img src="/image/listimg.jpg" alt="">
                <span id="removee" class="removee">
                    <img class="remoimg" src="../../image/remo.png" alt="">
                </span>
            </p>
        </div>
    </div>
    <div class="SeeMerchant">
        <span>地区位置 : </span>
        <span>
            <input id="city-picker" type="text" name="province_city_name" placeHolder="{{ $industry->province_city_name }}" />
            <input id="province_city" type="hidden" name="province_city" value="{{ $industry->province_city }}"/>
        </span>
    </div>
    <div class="SeeMerchant">
        <span>详细地址 : </span>
        <span>
            <input class="inputa" type="text" name="address" placeholder="请输入详细地址" value="{{$industry->address}}">
        </span>
    </div>
    <div class="SeeMerchant">
        <span>主营业务 : </span><span><input class="inputa" type="text" name="service" placeholder="请输入您的主营业务" value="{{ $industry->service }}"></span>
    </div>
    <div class="SeeMerchant">
        <span>QQ : </span>
        <span>
            <input class="inputa" type="text" name="qq" placeholder="请输入QQ" value="{{$industry->qq}}">
        </span>
    </div>
    <div class="SeeMerchant">
        <span>Wechat: </span>
        <span>
            <input class="inputa" type="text" name="wechat" placeholder="请输入微信账号" value="{{$industry->wechat}}">
        </span>
    </div>
    <div class="SeeMerchant">
        <span>详细联系电话 : </span>
        <span>
            <input class="inputa" type="text" name="phone" placeholder="请输入联系电话" value="{{$industry->phone}}">
        </span>
    </div>
    <div class="DetailsIntro">
        <p class="deinro">简介</p>
        <div class="DetailsCont">
            <textarea id="" cols="40" rows="8" name="description" placeholder="输入补充的信息....">{{ $industry->description }}</textarea>
        </div>
    </div>
</div>
<footer>
    <button id="submit" type="submit" class="Isubmit">保存</button>
</footer>
{!! Form::close() !!}

@endsection

@section('script')
<script src="/js/jquery.ui.widget.js"></script>
<script src="/js/jquery.iframe-transport.js"></script>
<script src="/js/jquery.fileupload.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/city-picker.min.js"></script>
<script>
$("#city-picker").cityPicker({
    title: "请选择省份城市",
    //showDistrict: false,
    onChange: function() {
        $("#province_city").val( $("#city-picker").attr("data-codes") );
    }
});
$('#upload-avatar').fileupload({
    url: '/upload',
    dataType: 'json',
    done: function (e, data) {
        var path = data.result.data.path;
        $("#upload-avatar-input").val(path);
        $("#upload-avatar-img").attr('src', path);
    }
});
$('#upload-identity').fileupload({
    url: '/upload',
    dataType: 'json',
    done: function (e, data) {
        var path = data.result.data.path;
        $("#upload-identity-input").val(path);
        $("#upload-identity-img").attr('src', path);
    }
});

$("#submit").click(function() {
    
});

</script>
@endsection
