@extends('backend.layouts.app')

@section('scripts')
<script src="/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/js/city-selector.js" charset="utf-8"></script>
<script>
$(function() {
    $(".btn-primary").click(function() {
        $(this).parent().find("input[type='hidden']").val($(this).find('input').attr('data'));
        location.href="/admin/stats/orders?type="+$("#type").val()+"&period="+$("#period").val()+"&province_city="+$("#province_city_name").attr("data");
    });

    $(".btn-error").click(function() {
        location.href="/admin/stats/orders?type="+$("#type").val()+"&period="+$("#period").val();
    });

    jQuery("province_city_name").citySelector({
	prov_id: '{{ $prov_id }}',
	city_id: '{{ $city_id }}',
	area_id: '{{ $area_id }}',
	onChange: function(province_code, city_code, area_code) {
		$("#province_city_name").attr('data', province_code+'|'+city_code+'|'+area_code);
	}
    });
});
</script>
@endsection

@section('content')
    <section class="content-header">
        <h5> 
            周期: 
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary {{$period=='day'?'active':''}}">
                    <input type="radio" name="options" data="day"> 日
                </label>
                <label class="btn btn-primary {{$period=='week'?'active':''}}">
                    <input type="radio" name="options" data="week"> 周
                </label>
                <label class="btn btn-primary {{$period=='month'?'active':''}}">
                    <input type="radio" name="options" data="month"> 月
                </label>
                <input type="hidden" id="period" value="{{$period}}" />
            </div>
            商品类型: 
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary {{$type=='3'?'active':''}}">
                    <input type="radio" name="options" data="3"> 普通用户
                </label>
                <label class="btn btn-primary {{$type=='2'?'active':''}}">
                    <input type="radio" name="options" data="2"> 经销商
                </label>
                <label class="btn btn-primary {{$type=='1'?'active':''}}">
                    <input type="radio" name="options" data="1"> 厂商
                </label>
                <input type="hidden" id="type" value="{{$type}}" />
            </div>
            <div class="btn-group" data-toggle="buttons">
	    	<span id="province_city_name"></span>
	    </div>
            <div class="btn-group" data-toggle="buttons">
	        <button class="btn btn-primary">查询</button>
	        <button class="btn btn-error">清空地址</button>
	    </div>
        </h5>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('backend.stats.table')
            </div>
        </div>
    </div>
@endsection


