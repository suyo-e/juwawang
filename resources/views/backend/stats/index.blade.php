@extends('backend.layouts.app')

@section('scripts')
<script>
$(function() {
    $(".btn-primary").click(function() {
        $(this).parent().find("input[type='hidden']").val($(this).find('input').attr('data'));
        location.href="/admin/stats/users?type="+$("#type").val()+"&period="+$("#period").val();
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
            用户类型: 
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

