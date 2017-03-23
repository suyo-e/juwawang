@extends('frontend.layouts.app')

@section('content')
    <div class="purchase">
        <ul>
            <li data-id="product" class="active BrandNew"><a>商品 / 信息</a></li>
            <li data-id="seller" class="BrandNew"><a>商家</a></li>
        </ul>
    </div>
    <div class="classContent" id="product">
      <ul>
      @foreach ($products as $product)    
          <a href="{{route('frontend.products.show', ['product_id'=>$product->id])}}">
          <li>
              <div class="classImg">
                  <img src="{{ $product->pic_url }}" alt="">
              </div>
              <div class="classcont">
                  <p><b>{{ $product->title }}</b></p>
                  <p>价格 : <span class="price">{{ $product->price }} </span></p>
                  <p>经销商 : <span>{{ substr($product->created_at, 0, 10) }}</span></p>
                  <p>地址 : <span>{{ $product->address }}</span></p>
              </div>
          </li>
          </a>
        @endforeach
      </ul>
    </div>
    <div class="classContent hidden" id="seller">
      <ul>
        @foreach ($users as $user)
          <a href="{{route('frontend.profiles.show', ['user_id'=>$user->id])}}">
          <li>
              <div class="classImg">
                  <img src="{{ $user->avatar }}" alt="">
              </div>
              <div class="classcont">
                  <p><b>{{ $user->name }}</b></p>
                  <p>地址 : <span>{{ $user->address }}</span></p>
              </div>
          </li>
          </a>
        @endforeach
      </ul>
   </div>
@endsection

@section('script')
<script>
$(".BrandNew").click(function() {
    $(".BrandNew").removeClass('active')
        
    $(this).addClass('active');

    var dataId = $(this).attr('data-id');
    $(".classContent").hide();
    $("#" + dataId).show();
});
</script>
@endsection
