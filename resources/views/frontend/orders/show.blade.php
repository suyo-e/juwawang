@extends('frontend.layouts.app')

@section('content')
<section>
    <div class="intention">
<!--
        <p class="fillln1">填写您的个人信息，商家会及时回复...</p>
-->
        <div class="Product">
            <p class="title">润田经销商</p>
            <a href="{{ route('frontend.products.show', ['product_id'=>$product->id])}}">
                <div class="ProductCont">
                    <img src="/image/waji.png" alt="">
                    <p class="info">
                        <span>{{ $product->title }}</span>
                        <span>联系人 : {{ $product->contact_name }}</span>
                        <span class="Price">价格 : {{ $order->price }}</span>
                    </p>
                    <span class="on-right"><img src="/image/on_right.png" alt=""></span>
                </div>
            </a>
        </div>
    </div>
    <div class="PersonalInfo">
        <form action="">
            <div class="name">
                <span>姓名 : </span>
                <span class="conts">{{ $order->contact_name }}</span>
            </div>
            <div class="name">
                <span>电话 : </span>
                <span class="conts">{{ $order->phone }}</span>
            </div>
            <div class="name">
                <span>城市 : </span>
                <span class="conts">{{ $order->address }}</span>
            </div>
            <div class="name">
                <span>数量 : </span>
                <span class="conts">{{ $order->quantity }}</span>
            </div>
            <p class="title">留言</p>
            <div class="texta">
               <p>{{ $order->remark }}</p>
            </div>
        </form>
    </div>
</section>
@endsection

@section('script')
@endsection
