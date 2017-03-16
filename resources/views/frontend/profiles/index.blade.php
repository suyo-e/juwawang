@extends('frontend.layouts.app')

@section('content')
<div class="purchase">
    <ul>
        <li data-id="buy" class="switchBar BrandNew active"><a>发出的意向单</a></li>
        <li data-id="sell" class="switchBar"><a>收到的意向单</a></li>
    </ul>
</div>

<div id="buy" class="purchaseCont ">
    <div class="listClas show">
        <ul class="IntentList">
            @foreach ($purchase_orders as $order) 
            <li>
                <div class="classImg">
                    <img src="{{ $order->product->pic_url }}" alt="">
                </div>
                <div class="classcont">
                    <p><b>{{ $order->product->title }}</b></p>
                    <p class="txt">价格 : <span class="price">{{ $order->price }} </span></p>
                    <p class="txt">预购数量 : <span>{{ $order->quantity }}</span></p>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>

<div id="sell" class="purchaseCont hidden">
    <div class="listClas show" id="tab1">
        
        <ul class="IntentList">
            @foreach ($sell_orders as $order) 
            <li style="width:100%">
                <div class="name" style="width:95%">
                    <span><img src="{{ $order->profile->avatar }}" alt=""></span>
                    <span>{{ $order->user->name }}</span>
                    <span class="time">{{ $order->created_at }}</span>
                </div>
                <div style="width:90%">
                <div class="classImg">
                    <img src="{{ $order->product->pic_url }}" alt="">
                </div>
                <div class="classcont">
                    <p><b>{{ $order->product->title }}</b></p>
                    <p class="txt">价格 : <span class="price">{{ $order->price }}</span></p>
                    <p class="txt">预购数量 : <span>{{ $order->quantity }}</span></p>
                </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>

@endsection

@section('script')

<script>
$(function() {
    $(".switchBar").click(function() {
        $(".switchBar").removeClass('active');
        $(this).addClass('active');

        $(".purchaseCont").hide();
        $('#' + $(this).attr('data-id')).show();
    });
});
</script>
@endsection
