@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            商户资料编辑
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($industry, ['route' => ['admin.industries.update', $industry->id], 'method' => 'patch']) !!}

                        @include('backend.industries.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection

@section('scripts')
<script src="/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/js/city-selector.js" charset="utf-8"></script>
<script src="/js/jquery.ui.widget.js"></script>
<script src="/js/jquery.iframe-transport.js"></script>
<script src="/js/jquery.fileupload.js"></script>
<script>
$(function() {
    
    $('#upload-file').fileupload({
        url: '/upload',
        dataType: 'json',
        done: function (e, data) {
            var path = data.result.data.path;
            $("#avatar_input").val(path);
            $("#avatar_img").attr('src', path);
        }
    });
    jQuery("province_city_name").citySelector({
	prov_id: $("#prov_id").val(),
	city_id: $("#city_id").val(),
	area_id: $("#area_id").val(),
	onChange: function(province_code, city_code, area_code) {
                $("#prov_id").val(province_code);
                $("#city_id").val(city_code);
                $("#area_id").val(area_code);
	}
    });
});

</script>
@endsection
