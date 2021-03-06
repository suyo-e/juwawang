@extends('frontend.layouts.app')

<link rel="stylesheet" href="/css/weui.css"/>
<?php 
$banner_urls = json_decode($product->banner_urls);
?>

@section('content')
{!! Form::open(['route' => 'frontend.products.update', 'files' => true]) !!}

<input type="hidden" name="product_id" value="{{ $product->id}}" />
<input type="hidden" name="category_id" value="{{ $category_id }}" />
<!--
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
-->

<div class="container">
    <div class="weui_cells_title">上传图片</div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <div class="weui_uploader">
                    <!--<div class="weui_uploader_hd weui_cell">-->
                    <!--<div class="weui_cell_bd weui_cell_primary">图片上传</div>-->
                    <!--<div class="weui_cell_ft js_counter">0/6</div>-->
                    <!--</div>-->
                    <div class="weui_uploader_bd">
                        <ul class="weui_uploader_files">
                            <!-- 预览图插入到这 --> 

                            @foreach ($banner_urls as $url) 
                            <li class="weui_uploader_file" style="background-image:url('{{ $url }}')">
                            <input type="hidden" value="{{ $url }}" name="banner_urls[]"/></li>
                            @endforeach
                        </ul>
                        <div class="weui_uploader_input_wrp">
                            <input id="upload-avatar" class="weui_uploader_input js_file" type="file" accept="image/jpg,image/jpeg,image/png,image/gif" name="file">
                            <input type="hidden" id="upload-avatar-input" name="pic_url" value="{{ $product->pic_url }}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="biaoti">
    <div class="title">
        <span>标题</span>
        <input type="text" name="title" value="{{ $product->title }}" placeholder="商品标题"/>
    </div>
    <div class="textq">
        <textarea name="description" id="description" cols="40" rows="5" placeholder="输入补充的信息....">{{ $product->description }}</textarea>
    </div>
</div>
<div class="inforlist">
    <div class="list1 borderAll">
        <span>类别</span>
        <input id="display_name" readonly type="text" name="type_name" value="{{ $category->display_name }}" placeholder="请输入您要发布的商品类型"/>
        <input id="category_id" name="category_id" type="hidden" value="{{ $category->id}}"/>
    </div>
    <div class="list1 borderAll">
        <span>品牌</span>
        <input type="text" name="brand_name" value="{{ $product->brand_name }}" placeholder="请输入品牌名称"/>
    </div>
    <div class="list1 borderAll">
        <span>价格</span>
        <input type="text" name="price" value="{{ $product->price }}" placeholder="请输入金额"/>
    </div>
    <div class="list1 borderAll">
        <span>手机号</span>
        <input type="text" name="phone" value="{{ $product->phone?$product->phone: $industry->phone }}" placeholder="请输入手机号码"/>
    </div>
    <div class="list1 borderAll">
        <span>QQ号码</span>
        <input type="text" name="qq" value="{{ $product->qq?$product->qq: $industry->qq }}" placeholder="请输入QQ号码"/>
    </div>
    <div class="list1 borderAll">
        <span>微信号</span>
        <input type="text" name="wechat" value="{{ $product->wechat?$product->wechat: $industry->wechat }}" placeholder="请输入微信号"/>
    </div>
    <div class="list1 borderAll">
        <span>地区</span>
        <input id="city-picker" type="text" name="province_city_name" value="" placeholder="{{ $product->province_city_name }}" data-code="{{ $product->area_id }}" data-codes="{{ $product->province_city }}"/>
        <input id="province_city" type="hidden" name="province_city" value="{{ $product->province_city }}"/>
    </div>
    <div class="list1 borderAll">
        <span>地址</span>
        <input type="text" name="address" value="{{ $product->address }}" placeholder="请输入详细地址"/>
    </div>
</div>
<footer>
    <button id="submit" class="fabu" type="submit">更新</button>
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
    /*
    $("#display_name").picker({
        title: "请选择类目",
        cols: [
            {  
                textAlign: 'center',
                values: [{!! implode(',', $category_values) !!}],
            }
        ],
        onChange: function(data) {
            debugger;
        },
        onClose: function() {
            debugger;
        }
    });
     */
    $('#upload-avatar').fileupload({
        url: '/upload',
        dataType: 'json',
        done: function (e, data) {
            var path = data.result.data.path;
            //$("#upload-avatar-input").val(path);
            //$("#upload-avatar-img").attr('src', path);

            if( $('.weui_uploader_files li').length == 1 )  
                $('#upload-avatar-input').val(path);
            var $preview = $('<li class="weui_uploader_file" style="background-image:url('+path+')"><input type="hidden" value="'+path+'" name="banner_urls[]"/></li>');
            $('.weui_uploader_files').append($preview);
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
        /*
        if($("input[name='brand_name']").val() == "") {
            alert("请填写品牌");
            return false;
        }
         */
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
        //showDistrict: false,
        onChange: function() {
            $("#province_city").val( $("#city-picker").attr("data-codes") );
        }
    });
});
</script>
@endsection
