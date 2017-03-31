@extends('frontend.layouts.app')

@section('content')
<div class="cont">
    <div class="Cmain">
        <ul>
            <li class="borderAll">
                <p class="title2">{{ $information->title }}</p>
                <p class="zxImg"><img src="{{ $information->pic_url }}" alt=""></p>
                <p class="liulan">
                    <span class="time">{{ $information->subtitle }}</span>
                </p>
            </li>
            <li>{!! $information->content !!}</li>
        </ul>
    </div>
</div>
@endsection
