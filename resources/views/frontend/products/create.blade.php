@extends('frontend.layouts.app')

<link rel="stylesheet" href="/css/weui.css"/>
@section('content')
{!! Form::open(['route' => 'frontend.products.store', 'files' => true]) !!}

<div class="weui-cells " style="margin-top: 0.3em">
  <div class="weui-cell">
    <div class="weui-cell__bd">
      <div class="weui-uploader">
        <div class="weui-uploader__hd">
          <p class="weui-uploader__title">图片上传</p>
          <div class="weui-uploader__info" id="counter">0/3</div>
        </div>
        <div class="weui-uploader__bd">
          <div  id="container" >
              <div class="weui-uploader__input-box" id="pickfiles">
              </div>
          </div>
          <ul class="weui-uploader__files" id="uploaderFiles">
          </ul>
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
        <input type="hidden" id="banner_urls" name="banner_urls" value="{{ $category->banner_urls }}"/>
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
<script src="/js/qiniu/moxie.js"></script>
<script src="/js/qiniu/plupload.min.js"></script>
<script src="/js/qiniu/qiniu.min.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/city-picker.min.js"></script>
<script> 
$(function() {

    $("#submit").click(function() {
        if($("input.uploaderInput").length() > 0) {
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

    //引入Plupload 、qiniu.js后
    var uploader = Qiniu.uploader({
        runtimes: 'html5,flash,html4',    //上传模式,依次退化
        browse_button: 'pickfiles',       //上传选择的点选按钮，**必需**
        uptoken_url: '/token',            //Ajax请求upToken的Url，**强烈建议设置**（服务端提供）
        // uptoken : '', //若未指定uptoken_url,则必须指定 uptoken ,uptoken由其他程序生成
        unique_names: true, // 默认 false，key为文件名。若开启该选项，SDK为自动生成上传成功后的key（文件名）。
        // save_key: true,   // 默认 false。若在服务端生成uptoken的上传策略中指定了 `sava_key`，则开启，SDK会忽略对key的处理
        domain: 'http://ot7spee77.bkt.clouddn.com/',   //bucket 域名，下载资源时用到，**必需**
        get_new_uptoken: false,  //设置上传文件的时候是否每次都重新获取新的token
        container: 'container',           //上传区域DOM ID，默认是browser_button的父元素，
        max_file_size: '100mb',           //最大文件体积限制
        flash_swf_url: 'js/plupload/Moxie.swf',  //引入flash,相对路径
        max_retries: 3,                   //上传失败最大重试次数
        dragdrop: true,                   //开启可拖曳上传
        drop_element: 'container',        //拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
        chunk_size: '4mb',                //分块上传时，每片的体积
        auto_start: true,                 //选择文件后自动上传，若关闭需要自己绑定事件触发上传
        init: {
            'FilesAdded': function(up, files) {
                plupload.each(files, function(file) {
                    // 文件添加进队列后,处理相关的事情
                });
            },
            'BeforeUpload': function(up, file) {
                $("#uploaderFiles").append('<li id="'+file.id+'" class="weui-uploader__file weui-uploader__file_status"><div class="weui-uploader__file-content">...</div></li>');
                   // 每个文件上传前,处理相关的事情
            },
            'UploadProgress': function(up, file) {
                   // 每个文件上传时,处理相关的事情
            },
            'FileUploaded': function(up, file, info) {
                   // 每个文件上传成功后,处理相关的事情
                   // 其中 info 是文件上传成功后，服务端返回的json，形式如
                   // {
                   //    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
                   //    "key": "gogopher.jpg"
                   //  }
                   // 参考http://developer.qiniu.com/docs/v6/api/overview/up/response/simple-response.html

                $("#counter").text($("#uploaderFiles li").length + "/3");
                var domain = up.getOption('domain');
                $("#"+file.id).css('background-image', 'url('+domain+file.name+')');
                $("#"+file.id).removeClass('weui-uploader__file_status');
                $("#"+file.id + ' .weui-uploader__file-content').remove();


                if($("#banner_urls").val() == "") {
                    var banner_urls = [];
                }
                else {
                    var banner_urls = JSON.parse($("#banner_urls").val());
                }
                banner_urls.push(domain+file.name);
                $("#banner_urls").val(JSON.stringify(banner_urls));
            },
            'Error': function(up, err, errTip) {
                   //上传出错时,处理相关的事情
            },
            'UploadComplete': function() {
                   //队列文件处理完毕后,处理相关的事情
            },
            'Key': function(up, file) {
                // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
                // 该配置必须要在 unique_names: false , save_key: false 时才生效

                var key = "";
                // do something with key here
                return key
            }
        }
    });
});
</script>
@endsection
