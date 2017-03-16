@extends('frontend.layouts.app')

@section('content')
<div class="listManufa">
    <ul>
        @foreach ($categories as $category) 
        <a href="{{ route('frontend.products.create', ['category_id' => $category->id]) }}"><li>{{$category->display_name}}<img src="../../image/on_right.png" alt=""></li></a>
        @endforeach
    </ul>
</div>
@endsection

@section('script')
@endsection
