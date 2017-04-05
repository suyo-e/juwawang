@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            商品编辑
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($product, ['route' => ['admin.products.update', $product->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('backend.products.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection

@section('scripts')
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
<script type="text/javascript" src="/js/city-picker.min.js" charset="utf-8"></script>
<script src="/js/jquery.ui.widget.js"></script>
<script src="/js/jquery.iframe-transport.js"></script>
<script src="/js/jquery.fileupload.js"></script>
<script>
$(function() {
    jQuery("#province_city_name").cityPicker({
        title: "请选择收货地址",
        onClose: function(data) {
            if($("#province_city_name").attr('data-codes')) {
                var arr = $("#province_city_name").attr('data-codes').split(',');
                $("#prov_id").val(arr[0]);
                $("#city_id").val(arr[1]);
                $("#area_id").val(arr[2]);
            }
        }
    });

    $('#upload-file').fileupload({
        url: '/upload',
        dataType: 'json',
        done: function (e, data) {
            var path = data.result.data.path;
            $("#banner-container").append('<img class="banner-image" src="'+path+'" height="100" /><input name="banner_urls[]" value="'+path+'" type="hidden"/>');
        }
    });
});

</script>
@endsection

@section('before-styles')
<link href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css" rel="stylesheet">
@endsection
