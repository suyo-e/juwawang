@extends('frontend.layouts.app')

@section('content')
    <div class="screening">
        <ul>
            <li class="clasStion">
                分类
            </li>
            <li id="city-picker" class="clasRegion" data-code="110101" data-codes="110000,110000,110101" value="0">
                地区
            </li>
            <li class="ReleaseTime">
                时间
            </li>
            <li class="source">
                来源
            </li>
        </ul>
    </div>

    <div class="grade-eject">
        <ul class="grade-w ejectAll">
        @foreach ($categories as $category) 
            <li class="category_id" data="{{$category->id}}">{{ $category->display_name }}</li>
        @endforeach
        </ul>
        <ul class="grade-s ejectAll">
            <li class="time" data="0">全部</li>
            <li class="time" data="week">一个星期内</li>
            <li class="time" data="month">一个月内</li>
        </ul>
        <ul class="grade-y ejectAll">
            <li class="from" data="user">来源 : 用户</li>
            <li class="from" data="agent">来源 : 经销商</li>
            <li class="from" data="manufacturer">来源 : 厂商</li>
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
                  <p><b>{{ $product->title }}</b></p>
                  <p>价格: <span class="price">{{ $product->price }} </span>&nbsp;&nbsp;</p>
                    <!--<p>品牌:<span>{{ $product->brand_name }}</span></p> -->
                  <p>经销商 : <span>{{ substr($product->created_at, 0, 10) }}</span></p>
                  <p>地址 : <span>{{ $product->address }}</span></p>
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

    $('.grade-eject li.category_id').click(function() {
        location.href = url + '&category_id=' + $(this).attr('data');
    });

    $('.grade-eject li.time').click(function() {
        location.href = url + '&time=' + $(this).attr('data');
    });

    $('.grade-eject li.from').click(function() {
        location.href = url + '&from=' + $(this).attr('data');
    });
    
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

    //点击出现弹框 查看图片
    $('#onzhao').on('click',function(){
        $("#onblock").show();
        $('#removee').on('click','img',function(){
            $("#onblock").hide();
        })
    });
    $('#onyier').on('click',function(){
        $("#onkuai").show();
        $('#remove').on('click','img',function(){
            $("#onkuai").hide();
        })
    });
    $('.onbutton').on('click',function(){
        $(".motai").show();
        $('.removee').on('click','img',function(){
            $(".motai").hide();
        })
    });

    //点击查看联系方式弹框
    $('.chakanbtn').on('click','button',function(){
        $('#tankuang').show();
        $('#quxiao').click(function(){
            $('#tankuang').hide();
        })

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
