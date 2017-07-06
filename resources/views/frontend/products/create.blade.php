@extends('frontend.layouts.app')

<link rel="stylesheet" href="/css/weui.css"/>
<!--
<div class="weui-uploader__bd"> 
	<ul class="weui-uploader__files" id="upload-avatar-list">
	</ul> 
	<div class="weui-uploader__input-box"> 
		<input id="upload-avatar" class="weui-uploader__input" type="file" accept="image/*" name="pic_url_file" value="{{ old('pic_url_file') }}"> 
	</div> 
</div>
-->
@section('content')
{!! Form::open(['route' => 'frontend.products.store', 'files' => true]) !!}
<!--
<input id="upload-picurl-input" type="hidden" name="pic_url" value="{{ old('pic_url') }}" />
<input id="upload-bannerurl-input" type="hidden" name="banner_url" value="{{ old('banner_url') }}" />
-->
<!--
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
-->

<!--
<div class="container">
<div class="bjMap">
	<img id="bjMap" src="/image/Sbj.png" width="100%" height="100%"/>
</div>
    <div class="weui_cells_title">上传图片</div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <div class="weui_uploader">
                    <div class="weui_uploader_bd">
                        <ul class="weui_uploader_files">
                        </ul>
                        <div class="weui_uploader_input_wrp">
                            <input id="upload-avatar" class="weui_uploader_input js_file" type="file" accept="image/jpg,image/jpeg,image/png,image/gif" name="file">
                            <input type="hidden" id="upload-avatar-input" name="pic_url" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
-->
<div class="weui-cells " style="margin-top: 0.3em">
  <div class="weui-cell">
    <div class="weui-cell__bd">
      <div class="weui-uploader">
        <div class="weui-uploader__hd">
          <p class="weui-uploader__title">图片上传</p>
          <div class="weui-uploader__info">0/2</div>
        </div>
        <div class="weui-uploader__bd">
          <ul class="weui-uploader__files" id="uploaderFiles">
<!--
            <li class="weui-uploader__file" style="background-image:url(./images/pic_160.png)"></li>
-->
          </ul>
          <div class="weui-uploader__input-box">
            <input class="uploaderInput weui-uploader__input" type="file" accept="image/*" name="pic_urls[]" />
          </div>
        </div>
      </div>
    </div>
  </div>
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
        <input id="display_name" readonly type="text" name="type_name" value="{{ $category->display_name }}" placeholder="请输入您要发布的商品类型"/>
        <input id="category_id" name="category_id" type="hidden" value="{{ $category->id}}"/>
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
        <span>手机号</span>
        <input type="text" name="phone" value="{{ old('phone')?old('phone'): $industry->phone }}" placeholder="请输入手机号码"/>
    </div>
    <div class="list1 borderAll">
        <span>QQ号码</span>
        <input type="text" name="qq" value="{{ old('qq')?old('qq'): $industry->qq }}" placeholder="请输入QQ号码"/>
    </div>
    <div class="list1 borderAll">
        <span>微信号</span>
        <input type="text" name="wechat" value="{{ old('wechat')?old('wechat'): $industry->wechat }}" placeholder="请输入微信号"/>
    </div>
    <div class="list1 borderAll">
        <span>地区</span>
        <input id="city-picker" type="text" name="province_city_name" value="{{ old('province_city_name') }}" placeholder="请输入省市区地址"/>
        <input id="province_city" type="hidden" name="province_city" value="{{ old('province_city') }}"/>
    </div>
    <div class="list1 borderAll">
        <span>地址</span>
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
    $('#upload-avatar').fileupload({
        url: '/upload',
        dataType: 'json',
        add: function(e, data) {
            $("body").append('<div class="flashMessage chenggong ok" style="display: none;"><br><br><br><span>上传中...</span></div>');
            $(".flashmessage").show();
            data.submit();
        },
        done: function (e, data) {
            var path = data.result.data.path;
			var pic_url = $("#upload-picurl-input").val();
			if(!pic_url) {
				$("#upload-picurl-input").val(path);
			}
			var banner_url = $("#upload-bannerurl-input").val();
			if(!banner_url) {
				banner_url = [];
			}
			else {
				banner_url = JSON.parse(banner_url);
			}
			banner_url.push(path)
			$("#upload-bannerurl-input").val(JSON.stringify(banner_url));
			
			$("#upload-avatar-list").append('<li class="weui-uploader__file" style="background-image: url('+path+');"></li>');

            $(".flashmessage").fadeOut();
            //var $preview = $('<li class="weui_uploader_file" style="background-image:url('+path+')"><input type="hidden" value="'+path+'" name="banner_urls[]"/></li>');
            //$('.weui_uploader_files').append($preview);
	    //$("#bjMap").attr('src', path);
        }
    });
     */

    $("#submit").click(function() {
        if($("inputi.uploaderInput").length() > 0) {
            alert("至少上传一张图片");
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


    $(function(){
        var tmpl = '<li class="weui-uploader__file" style="background-image:url(#url#)"></li>',
            $gallery = $("#gallery"), $galleryImg = $("#galleryImg"),
            $uploaderInput = $(".uploaderInput");
            $uploaderFiles = $("#uploaderFiles");
            

        $uploaderInput.on("change", uploadClick);
        function uploadClick(e){
            var src, url = window.URL || window.webkitURL || window.mozURL, files = e.target.files;
            for (var i = 0, len = files.length; i < len; ++i) {
                var file = files[i];

                if (url) {
                    src = url.createObjectURL(file);
                } else {
                    src = e.target.result;
                }

                $uploaderFiles.append($(tmpl.replace('#url#', src)));
            }
            
            $(this).hide();
            $uploaderTemplate = $('<input class="uploaderInput weui-uploader__input" type="file" accept="image/*" name="pic_urls[]" />');
            $(this).parent().append($uploaderTemplate);
            $uploaderInput = $(".uploaderInput");
            $uploaderInput.on("change", uploadClick);
        }
    });
});
</script>
@endsection
