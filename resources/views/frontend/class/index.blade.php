@extends('frontend.layouts.app')

@section('content')
    <div class="screening">
        <ul>
            <li class="Regional" id="class-picker-li" >
                分类
                <img src="/image/on_bottom.png" alt="">
                <input type="hidden" id="class-picker" name="class" />
            </li>
            <li class="Brand" id="city-picker-li">
                地区
                <img src="/image/on_bottom.png" alt="">
                <input type="hidden" id="city-picker" name="city" />
            </li>
            <li class="Sort" id="time-picker-li">
                发布时间
                <img src="/image/on_bottom.png" alt="">
                <input type="hidden" id="time-picker" name="time" />
            </li>
            <li class="Sort" id="from-picker-li">
                来源
                <img src="/image/on_bottom.png" alt="">
                <input type="hidden" id="from-picker" name="from" />
            </li>
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
                  <p>价格: <span class="price">{{ $product->price }} </span>&nbsp;&nbsp;品牌:<span>{{ $product->brand_name }}</span></p>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-weui/1.0.1/js/city-picker.min.js"></script>
<script>
$(function() {
    $("#city-picker-li").click(function() {
        setTimeout(function() {
            $("#city-picker").picker("open");
            $("#city-picker").focus();
        }, 500);
    });
    
    $("#city-picker").cityPicker({
        title: "请选择省份城市",
        showDistrict: false,
    });

    $("#class-picker-li").click(function() {
        setTimeout(function() {
            $("#class-picker").picker("open");
            $("#class-picker").focus();
        }, 500);
    });

    $("#class-picker").picker({
        title: "请选择分类",
        cols: [
            {
                textAlign: 'center',
                values: [{{ $class_value }}],
                displayValues: [{!! $class_display_value !!}]
            }
        ]
    });

    $("#from-picker-li").click(function() {
        setTimeout(function() {
            $("#from-picker").picker("open");
            $("#from-picker").focus();
        }, 500);
    });

    $("#from-picker").picker({
        title: "请选择来源",
        cols: [
            {
                textAlign: 'center',
                values: ['用户', '代理商', '厂商']
            }
        ]
    });
});
</script>
@endsection
