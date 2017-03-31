@extends('frontend.layouts.app')

@section('content')
    <div class="headTop">
        <form method="GET" accept-charset="UTF-8">
        <div class="search">
            <p><img src="image/search.png" alt=""></p>
            <input name="product_name" type="text" placeholder="搜索商品" value="{{$product_name}}">
            <input type="submit" style="display:none">
        </div>
        </form>
    </div>
    <div class="screening">
        <ul>
            <li class="source">
                来源
            </li>
            <li class="clasStion">
                分类
            </li>
            <li id="city-picker" class="clasRegion" data-code="110101" data-codes="110000,110000,110101" value="0">
                地区
            </li>
            <li class="ReleaseTime">
                时间
            </li>
        </ul>
    </div>

    <div class="grade-eject">
        <ul class="grade-y ejectAll">
            {!! li_filter_render('from', '', '全部') !!}
            @if ($profile->type != 1)
            {!! li_filter_render('from', 'user', '用户') !!}
            {!! li_filter_render('from', 'agent', '经销商') !!}
            @endif
            @if ($profile->type != 3)
            {!! li_filter_render('from', 'manufacturer', '厂商') !!}
            @endif
        </ul>
        <ul class="grade-w ejectAll">
            {!! li_filter_render('category_id', '', '全部') !!}
            @if ($from != '')
                @foreach ($categories as $category) 
                {!! li_filter_render('category_id', $category->id, $category->display_name) !!}
                @endforeach
            @endif
        </ul>
        <ul class="grade-s ejectAll">
            {!! li_filter_render('time', '', '全部') !!}
            {!! li_filter_render('time', 'week', '一星期内') !!}
            {!! li_filter_render('time', 'month', '一个月内') !!}
        </ul>
    </div>

    <div class="classContent">
      <ul>
        @foreach ($products as $product)
          <a href="{{route('frontend.products.show', ['product_id'=>$product->id])}}">
          <li>
              <div class="classImg">
                  <img src="{{ $product->pic_url }}" alt="">
              </div>
              <div class="classcont">
                  <p><b>{{ $product->title }} - {{ get_profile_type_name($product->profile->type) }}</b></p>
                  <p>价格: <span class="price">{{ $product->price }} </span>&nbsp;&nbsp;</p>
                    <!--<p>品牌:<span>{{ $product->brand_name }}</span></p> -->
                  <p>发布时间: <span>{{ substr($product->created_at, 0, 10) }}</span></p>
                  <p>地址 : <span>{{ $product->province_city_name.' '.$product->address }}</span></p>
              </div>
          </li>
          </a>
        @endforeach
      </ul>
   </div>
@endsection

@section('footer')
@include('frontend.layouts.footer')
@endsection

@section('script')
<script src="/js/city-picker.min.js"></script>
<script>
$(function(){
    var url = '{!!route("frontend.class", ["category_id"=>$category_id, "time"=>$time, "from"=>$from, "province_city_code"=>$province_city_code])!!}';

    $('.clasRegion').click(function(){
        $('.ejectAll').hide();
        $("#city-picker").cityPicker({
            title: "选择省市区/县",
            onClose: function(data) {
                location.href = url + '&province_city_code=' + $("#city-picker").attr('data-codes');
            },
            onChange: function (picker, values, displayValues) {
                console.log(values, displayValues);
            },
        });
    });

    $('.clasStion').click(function(){
        $('.grade-w').slideToggle(300).siblings('ul').attr("style","");
        $('.weui-picker-container').hide();
    });
    
    $('.ReleaseTime').click(function(){
        $('.grade-s').slideToggle(300).siblings('ul').attr("style","");
        $('.weui-picker-container').hide();
    });
    $('.source').click(function(){
        $('.grade-y').slideToggle(300).siblings('ul').attr("style","");
        $('.weui-picker-container').hide();
    });
});
</script>
@endsection
