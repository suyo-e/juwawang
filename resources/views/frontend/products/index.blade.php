@extends('frontend.layouts.app')

@section('content')
    <div class="classContent">
      <ul>
        @foreach ($products as $product)
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
        @endforeach
      </ul>
   </div>
@endsection

@section('script')
<script>
</script>
@endsection
