@extends('frontend.layouts.app')

@section('content')
<?php 
$identity_urls = json_decode($profile->identity_urls);
?>
{!! Form::open(['route' => 'frontend.sellers.update', 'files' => true]) !!}
    <div class="bjMap">
        <img src="../../image/Sbj.png" alt="">
        <p class="bjBtn">
            <img src="../../image/camera.png" alt=""><br>
            <span class="file"><input type="file"></span>
        </p>
        <span class="Prompt">上传店铺背景图</span>
    </div>
    <div class="main">
        <div class="SeeMerchant">
            <a id="onzhao" class="onbutton" href="#">证件照<img class="seeimg" src="../../image/zhaopian.png" alt=""></a>
            <div id="onblock" class="zhezhao">
                <p class="motai">
                    <img src="../../image/listimg.jpg" alt="">
                    <span id="removee" class="removee">
                        <img class="remoimg" src="../../image/remo.png" alt="">
                    </span>
                </p>
            </div>
        </div>
        <div class="SeeMerchant">
            <span>地区位置 : </span><span><input class="inputa" type="text" placeholder="请输入地理位置"></span>
        </div>
        <div class="SeeMerchant">
            <span>详细地址 : </span><span><input class="inputa" type="text" placeholder="请输入详细地址"></span>
        </div>
        <div class="SeeMerchant">
            <span>QQ号码 : </span><span><input class="inputa" type="number" placeholder="请输入地理位置"></span>
        </div>
        <div class="SeeMerchant">
            <span>微信号 : </span><span><input class="inputa" type="text" placeholder="请输入详细地址"></span>
        </div>
        <div class="SeeMerchant">
            <span>主营业务 : </span><span><input class="inputa" type="text" placeholder="请输入您的商品"></span>
        </div>
        <div class="DetailsIntro">
            <p class="deinro">简介</p>
            <div class="DetailsCont">
                <textarea name="" id="" cols="40" rows="8" placeholder="输入补充的信息...."></textarea>
            </div>
        </div>
    </div>
    <footer>
        <button type="submit" class="Isubmit">保存</button>
    </footer>
{!! Form::close() !!}
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
