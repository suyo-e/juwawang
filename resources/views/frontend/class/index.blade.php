@extends('frontend.layouts.app')

@section('content')
    <div class="screening">
        <ul>
            <li class="Regional">
                分类
                <img src="../../image/on_bottom.png" alt="">
            </li>
            <li class="Brand" id="city-picker-li">
                <input type="hidden" id="city-picker" />
                地区
                <img src="../../image/on_bottom.png" alt="">
            </li>
            <li class="Sort">
                发布时间
                <img src="../../image/on_bottom.png" alt="">
            </li>
            <li class="Sort">
                来源
                <img src="../../image/on_bottom.png" alt="">
            </li>
        </ul>
    </div>
@endsection

@section('footer')
@include('frontend.layouts.footer')
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-weui/1.0.1/js/city-picker.min.js"></script>
<script>
$(function() {
    $("#city-picker-li").click(function() {
        $("#city-picker").cityPicker({
            title: "请选择省份城市",
            showDistrict: false,
        });
        $("#city-picker").picker("open");
        $("#city-picker").focus();
    });
});
</script>
@endsection
