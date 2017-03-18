@extends('frontend.layouts.app')

@section('content')
<div class="Cmain">
    <ul>
    @foreach ($informations as $inf) 
        <a href="{{route('frontend.information.show', ['information_id'=>$inf->id])}}">
        <li class="borderAll">
            <p class="zxImg"><img src="{{ $inf->pic_url }}" alt=""></p>
            <p class="title1">{{ $inf->title }}</p>
            <p class="liulan">
                <span class="time">时间 : {{ $inf->created_at }}</span>
                <span class="renshu">
                    <img src="/image/Read.png" alt="">
                    {{ $inf->view_count }}
                </span>
            </p>
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
@endsection
