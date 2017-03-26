@extends('frontend.layouts.app')

@section('content')
    <div class="classContent">
      <ul>
        @foreach ($products as $product)
        <a href="{{ route('frontend.products.show', ['product_id'=>$product->id])}}">
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
               <a data-id="{{ $product->id }}" class="shanchu"><img src="/image/gengduo.png" alt=""></a>
          </li>
        </a>
        @endforeach
      </ul>
   </div>

    <div id="bianji" class="yijizhe" style="display: none;">
        <div class="tankuang">
            <ul>
                <li>
                    <div class="tab1">
                        <a id="delete">删除信息</a>
                    </div>
                    <div class="tab1">
                        <a id="edit">编辑信息</a>
                    </div>
                    <button id="xol" type="submit">取消</button>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('script')
<script>

    $('.shanchu').on('click',function(){
        $("#bianji").attr('data-id', $(this).attr('data-id'));
        $('#bianji').show();
        $('#xol').on('click',function(){
            $('#bianji').hide();
        });

    });

    $("#delete").click(function() {
        location.href = "/products/delete?product_id=" + $("#bianji").attr('data-id');
    });

    $("#edit").click(function() {
        location.href = "/products/edit?product_id=" + $("#bianji").attr('data-id');
    });

</script>
@endsection
