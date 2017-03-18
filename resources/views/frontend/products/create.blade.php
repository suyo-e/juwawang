@extends('frontend.layouts.app')

@section('content')
{!! Form::open(['route' => 'frontend.products.store', 'files' => true]) !!}

<input type="hidden" name="category_id" value="{{ $category_id }}" />
<div class="bjMap">
    <img id="upload-avatar-img" src="/image/Sbj.png" alt=""/>
    <p class="bjBtn">
        <img src="/image/camera.png" alt=""/><br/>
        <span class="file">
            <input id="upload-avatar-input" type="hidden" name="pic_url" value="{{ old('pic_url') }}" />
            <input id="upload-avatar" type="file" name="pic_url_file" value="{{ old('pic_url_file') }}" />
        </span>
    </p>
    <span class="Prompt">上传商品图片</span>
</div>
<div class="biaoti">
    <div class="title">
        <span>标题</span>
        <input type="text" name="title" value="{{ old('title') }}" placeholder="商品标题"/>
    </div>
    <div class="textq">
        <textarea name="description" id="description" cols="40" rows="5" placeholder="输入补充的信息....">{{ old('description') }}</textarea>
    </div>
</div>
<div class="inforlist">
    <div class="list1 borderAll">
        <span>类别</span>
        <input type="text" name="type_name" value="{{ old('type_name') }}" placeholder="请输入您要发布的商品类型"/>
    </div>
    <div class="list1 borderAll">
        <span>品牌</span>
        <input type="text" name="brand_name" value="{{ old('brand_name') }}" placeholder="请输入品牌名称"/>
    </div>
    <div class="list1 borderAll">
        <span>价格</span>
        <input type="text" name="price" value="{{ old('price') }}" placeholder="请输入金额"/>
    </div>
    <div class="list1 borderAll">
        <span>手机号码</span>
        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="请输入手机号码"/>
    </div>
    <div class="list1 borderAll">
        <span>QQ号码</span>
        <input type="text" name="qq" value="{{ old('qq') }}" placeholder="请输入QQ号码"/>
    </div>
    <div class="list1 borderAll">
        <span>微信号</span>
        <input type="text" name="wechat" value="{{ old('wechat') }}" placeholder="请输入微信号"/>
    </div>
    <div class="list1 borderAll">
        <span>地区</span>
        <input id="city-picker" type="text" name="province_city_name" value="{{ old('province_city_name') }}" placeholder="请输入省市区地址"/>
        <input id="province_city" type="hidden" name="province_city" value="{{ old('province_city') }}"/>
    </div>
    <div class="list1 borderAll">
        <span>详细地址</span>
        <input type="text" name="address" value="{{ old('address') }}" placeholder="请输入详细地址"/>
    </div>
</div>
<footer>
    <button id="submit" class="fabu" type="submit">发布</button>
</footer>
{!! Form::close() !!}
@endsection

@section('script')
<script src="/js/jquery.ui.widget.js"></script>
<script src="/js/jquery.iframe-transport.js"></script>
<script src="/js/jquery.fileupload.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/city-picker.min.js"></script>
<script> 
$(function() {
    $('#upload-avatar').fileupload({
        url: '/upload',
        dataType: 'json',
        done: function (e, data) {
            var path = data.result.data.path;
            $("#upload-avatar-input").val(path);
            $("#upload-avatar-img").attr('src', path);
        }
    });
    $("#submit").click(function() {
        if($("input[name='pic_url']").val() == "") {
            alert("请上传图片");
            return false;
        }
        if($("input[name='title']").val() == "") {
            alert("请填写标题");
            return false;
        }
        if($("input[name='description']").val() == "") {
            alert("请填写描述");
            return false;
        }
        if($("input[name='type_name']").val() == "") {
            alert("请填写类别");
            return false;
        }
        if($("input[name='brand_name']").val() == "") {
            alert("请填写品牌");
            return false;
        }
        if($("input[name='price']").val() == "") {
            alert("请填写价格");
            return false;
        }
        if($("input[name='phone']").val() == "") {
            alert("请填写手机号码");
            return false;
        }
        if($("input[name='qq']").val() == "") {
            alert("请填写qq号码");
            return false;
        }
        if($("input[name='province_city']").val() == "") {
            alert("请选择城市");
            return false;
        }
        if($("input[name='address']").val() == "") {
            alert("请填写地址");
            return false;
        }
    });

    $("#city-picker").cityPicker({
        title: "请选择省份城市",
        showDistrict: false,
        onChange: function() {
            $("#province_city").val( $("#city-picker").attr("data-codes") );
        }
    });
});
</script>
@endsection
