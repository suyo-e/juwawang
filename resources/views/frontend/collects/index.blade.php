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
    <div class="content hidden" id="seller">
      <ul>
            @foreach ($profiles as $profile)   
            @if (!$profile) continue;
            @endif
            <li>
            <a href="{{ route('frontend.profiles.show', ['user_id'=>$profile->user_id]) }}">
                    <div class="listCont">
                        <div class="iconbox">
                            <img src="{{ $profile->avatar }}" alt=""/>
                        </div>
                        <div class="companyName">
                        <p><b>{{ $profile->industry_name}}</b> （{{$profile->user->name}} - {{($profile->type == 1?'厂商':'经销商') }}）</p>
                            <p>{{ $profile->province_city_name.' '.$profile->address }}</p>
                        </div>
                        <div class="Authentication">
                            <?php
                            switch($profile->is_identity) {
                            case 0:
                                echo '<span>未认证</span>';
                                break;
                            case 1:
                                echo '<span>认证中</span>';
                                break;
                            case 2:
                                echo '<span style="background-color:#F4BE46">已认证</span>';
                                break;
                            case 3:
                            case 4:
                                break;
                            }
                            ?>
                        </div>
                    </div>
                    <p>
                        <span class="TheMain">主营业务 : </span>
                        <span class="span1">{{ $profile->service }}</span>
                    </p>
                </a>
            </li>
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
