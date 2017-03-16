@extends('frontend.layouts.app')

@section('content')

<div class="tips">
    <img src="../../image/fbok.png" alt=""/>
    <p>发布成功</p>
    <div class="jihui">
        <a href="{{ route('frontend.orders.create', ['product_id'=>$product_id]) }}">再发一条</a>
        <a href="{{ route('frontend.index') }}">返回首页</a>
    </div>
</div>
@endsection

@section('script')
@endsection
