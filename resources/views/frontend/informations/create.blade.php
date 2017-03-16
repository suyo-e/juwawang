@extends('frontend.layouts.app')

@section('content')
<div class="intention">
    <p class="fillln1">填写您的个人信息，商家会及时回复...</p>
    <div class="Product">
        <p class="title">{{ $user->name }}</p>
        <div class="ProductCont">
            <img src="{{ $product->pic_url }}" alt=""/>
            <p class="info">
                <span>{{ $product->title }}</span>
                <span class="Price">价格 : {{ $product->price }}</span>
            </p>
        </div>
    </div>
</div>
<div class="PersonalInfo">
{!! Form::open(['route' => 'frontend.orders.store', 'files' => true]) !!}
        <input type="hidden" name="product_id" value="{{$product->id}}" />
        <div class="name">  
            <span>姓名 : </span>
            <input name="contact_name" value="{{ old('contact_name') }}" type="text" placeholder="请输入姓名"/>
        </div>
        <div class="name">
            <span>电话 : </span>
            <input name="phone" value="{{ old('phone') }}" type="tel" placeholder="请输入电话号码"/>
        </div>
        <div class="name">
            <span>城市 : </span>
            <input name="province_city_name" value="{{ old('province_city_name') }}" id="city-picker" type="text" placeholder="请输入详细地址"/>
            <input id="province_city" name="province_city" value="{{ old('province_city') }}" type="hidden"/>
        </div>
        <div class="name">
            <span>数量 : </span>
            <input name="quantity" value="{{ old('quantity') }}" type="text" placeholder="请输入购买数量"/>
        </div>
        <p class="title">留言</p>
        <div class="texta">
            <textarea name="remark" cols="40" rows="8" placeholder="输入补充的信息....">{{ old('remark') }}</textarea>
        </div>
    <button type="submit" class="Isubmit">提交</button>
    {!! Form::close() !!}
</div>

@endsection

@section('script')
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/city-picker.min.js"></script>
<script>
$(function() {
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
