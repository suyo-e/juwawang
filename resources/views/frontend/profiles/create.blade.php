@extends('frontend.layouts.app')

@section('content')

<?php 
$identity_urls = json_decode($profile->identity_urls);
?>

@if ($profile->type == 3) 
{!! Form::open(['route' => 'frontend.profiles.store', 'files' => true]) !!}
<div class="upload">
    <div class="Sname">
        <lebel>真实姓名 : </lebel>
        <input type="text" name="realname" placeholder="填写姓名" value="{{$profile->realname}}">
    </div>
    <div class="store">
        <lebel>身份证号 : </lebel>
        <input type="text" name="identity_str" placeholder="填写身份证号" value="{{$profile->identity_str}}">
    </div>
    <div class="Photograph">
        <p class="Cross">
            @if (isset($identity_urls[0]))
                <img id="identity-1-img" src="{{ $identity_urls[0] }}" alt="">
            @else
                <img id="identity-1-img" src="/image/Cross.png" alt="">
            @endif
            <input id="upload-file-1" type="file" name="identity_urls" value="{{ $identity_urls[0] }}">
            <input id="identity-1" type="hidden" name="identity_urls[]" value="{{ $identity_urls[0] }}" />
        </p>
        <p class="Prompt">身份证</p>
    </div>
</div>
<div class="btn">
    <input type="submit" class="btnAll" value="提交认证申请" />
</div>
</div>
{!! Form::close() !!}
@endif

@if ($profile->type != 3) 
{!! Form::open(['route' => 'frontend.profiles.store', 'files' => true]) !!}
<section>
    <div class="upload">
            <div class="Sname">
                <lebel>商家名称 : </lebel>
                <input name="realname" type="text" placeholder="填写商家名称" value="{{$profile->industry_name}}">
            </div>
            <div class="store">
                <lebel>营业执照/门店号 : </lebel>
                <input name="identity_str" type="text" placeholder="填写营业执照号" value="{{$profile->identity_str}}">
            </div>

        <div class="Photograph">
            <p class="Cross">
                @if (isset($identity_urls[0]))
                    <img id="identity-img" src="{{ $identity_urls[0] }}" alt="">
                    <input id="upload-file" type="file" name="identity_urls" value="{{ $identity_urls[0] }}">
                    <input id="identity" type="hidden" name="identity_urls[]"/ value="{{ $identity_urls[0] }}">
                @else
                    <img id="identity-img" src="/image/Cross.png" alt="">
                    <input id="upload-file" type="file" name="identity_urls">
                    <input id="identity" type="hidden" name="identity_urls[]"/>
                @endif
            </p>
            <p class="Prompt">营业执照/门店拍照</p>
        </div>
        <div class="Photograph">
            
        </div>
    </div>
    <p class="TheMain">主营商品照片</p>
    <div class="PhotoWall">
            @for ($i = 1; $i < 5; $i ++) 
            <div class="sc1">
                @if (isset($identity_urls[$i]))
                    <img id="identity-{{$i}}-img" src="{{ $identity_urls[$i] }}" alt="">
                    <input id="upload-file-{{$i}}" type="file" name="identity_urls" value="{{ $identity_urls[$i] }}">
                    <input id="identity-{{$i}}" type="hidden" name="identity_urls[]" value="{{ $identity_urls[$i] }}" />
                @else
                    <img id="identity-{{$i}}-img" src="/image/Cross.png" alt="">
                    <input id="upload-file-{{$i}}" type="file" name="identity_urls">
                    <input id="identity-{{$i}}" type="hidden" name="identity_urls[]"/>
                @endif
            </div>
            @endfor
    </div>

    <div class="btn">
        <button type="submit" class="btnAll">提交认证申请</button>
    </div>
</section>
{!! Form::close() !!}
@endif

@endsection

@section('script')
<script src="/js/jquery.ui.widget.js"></script>
<script src="/js/jquery.iframe-transport.js"></script>
<script src="/js/jquery.fileupload.js"></script>
<script>
$(function () {
    
    $('#upload-file').fileupload({
        url: '/upload',
        dataType: 'json',
        done: function (e, data) {
            var path = data.result.data.path;
            $("#identity").val(path);
            $("#identity-img").attr('src', path);
        }
    });

    @for ($i = 1; $i < 5; $i++)
        $('#upload-file-{{$i}}').fileupload({
            url: '/upload',
            dataType: 'json',
            done: function (e, data) {
                var path = data.result.data.path;
                $("#identity-{{$i}}").val(path);
                $("#identity-{{$i}}-img").attr('src', path);
            }
        });
    @endfor
});
</script>
@endsection
