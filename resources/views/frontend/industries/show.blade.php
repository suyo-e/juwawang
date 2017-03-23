@extends('frontend.layouts.app')
<?php
//dd($industry->toArray());
$identity_urls = json_decode($industry->identity_urls);
?>

@section('content')
@if ($industry->user_id == access()->user()->id) 
<div class="headTop">
    <div class="Release" style="float:right; right:0;">
        <a href="{{ route('frontend.industries.edit') }}">编辑</a>
    </div>
</div>
@endif
<div class="baner">
    <img src="{{ $industry->avatar}}" alt="">
    <div class="userCont">
        <p class="Villain"><img src="/image/ren.png" alt=""></p>
        <p class="userIntroduce">
            <span class="daiV">{{ $industry->industry_name}}({{$user->name}})<img src="/image/V.png" alt=""></span>
            <span>{{$industry->recommand_count}}人推荐</span>
        </p>
    </div>
</div>
<div class="main">
    <div class="SeeMerchant">
        <a id="onzhao" href="#">证件照
                @if (isset($identity_urls[0]))
                    <img class="seeimg" src="{{ $identity_urls[0]}}" alt="">
                @else
                    <img class="seeimg" src="/image/zhaopian.png" alt="">
                @endif
        </a>
        <div id="onblock" class="zhezhao" style="display: none;">
            <p class="motai">
                @if (isset($identity_urls[0]))
                    <img src="{{ $identity_urls[0]}}" alt="">
                @else
                @endif
                <span id="removee" class="removee">
                    <img class="remoimg" src="/image/remo.png" alt="">
                </span>
            </p>
        </div>
    </div>
    <div class="SeeMerchant">
        <a id="onyier" href="#">商家二维码<img class="seeimg" src="/image/erweima.png" alt=""></a>
        <div id="onkuai" class="zhezhao" style="display: none;">
            <p class="motai" style="height:300px">
                {!! QrCode::size(300)->generate(Request::url()); !!}
                <span id="remove" class="removee">
                    <img class="remoimg" src="/image/remo.png" alt="">
                </span>
            </p>
        </div>
    </div>
    <div class="SeeMerchant">
        <span>地区位置 : </span><span>{{ $industry->province_city_name }}</span>
    </div>
    <div class="SeeMerchant">
        <span>详细地址 : </span><span>{{ $industry->address }}</span>
    </div>
    <div class="SeeMerchant">
        <span>主营业务 : </span><span>{{ $industry->service }}</span>
    </div>
    <div class="DetailsIntro">
        <p class="deinro">简介</p>
        <div class="DetailsCont">
        {{ $industry->description }}
        </div>
    </div>
    <div class="chakanbtn">
        <button type="button">查看联系方式</button>
    </div>
</div>
<div id="tankuang" class="yijizhe">
    <div class="tankuang">
        <ul>
            <li>
                <div class="tab1">
                    <span>电话 : </span>
                    <a href="tel:13621245784">{{ $profile->phone }}</a>
                </div>
                <div class="tab1">
                    <span>QQ : </span>
                    <a href="#">{{ $profile->qq }}</a>
                </div>
                <div class="tab1">
                    <span>Wechat: </span>
                    <a href="#">{{ $profile->wechat }}</a>
                </div>
                <button id="quxiao" type="button">取消</button>
            </li>
        </ul>
    </div>
</div>
@endsection

@section('script')

<script>

$(function(){
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

    //首页商家 分类
    $('.clastion').click(function(){
        $('.grade-A').slideToggle().siblings('ul').attr("style","");
    });
    $('.ReseTime').click(function(){
        $('.grade-B').slideToggle().siblings('ul').attr("style","");
    });


    $('#grade-w').on('click','li',function(){
        grade1(this);
    });
    $('#Categorytw').on('click','li',function(){
        Categorytw(this);
    });
    $('#Sort-Sort').on('click','li',function(){
        Sorts(this);
    });
    //Regional开始
    $(document).ready(function(){
        $(".Regional").click(function(){
            if ($('.grade-eject').hasClass('grade-w-roll')) {
                $('.grade-eject').removeClass('grade-w-roll');
            } else {
                $('.grade-eject').addClass('grade-w-roll');
            }
        });
    });

    $(document).ready(function(){
        $(".grade-w>li").click(function(){
            $(".grade-t")
                .css("left","33.48%")
        });
    });

    $(document).ready(function(){
        $(".grade-t>li").click(function(){
            $(".grade-s")
                .css("left","66.96%")
        });
    });
    $(document).ready(function(){
        $(".Brand").click(function(){
            if ($('.Category-eject').hasClass('grade-w-roll')) {
                $('.Category-eject').removeClass('grade-w-roll');
            } else {
                $('.Category-eject').addClass('grade-w-roll');
            }
        });
    });

    $(document).ready(function(){
        $(".Category-w>li").click(function(){
            $(".Category-t")
                .css("left","33.48%")
        });
    });

    $(document).ready(function(){
        $(".Category-t>li").click(function(){
            $(".Category-s")
                .css("left","66.96%")
        });
    });

    //Sort开始

    $(document).ready(function(){
        $(".Sort").click(function(){
            if ($('.Sort-eject').hasClass('grade-w-roll')) {
                $('.Sort-eject').removeClass('grade-w-roll');
            } else {
                $('.Sort-eject').addClass('grade-w-roll');
            }
        });
    });

    $(document).ready(function(){
        $(".Regional").click(function(){
            if ($('.Category-eject').hasClass('grade-w-roll')){
                $('.Category-eject').removeClass('grade-w-roll');
            };
        });
    });
    $(document).ready(function(){
        $(".Regional").click(function(){
            if ($('.Sort-eject').hasClass('grade-w-roll')){
                $('.Sort-eject').removeClass('grade-w-roll');
            };
        });
    });
    $(document).ready(function(){
        $(".Brand").click(function(){
            if ($('.Sort-eject').hasClass('grade-w-roll')){
                $('.Sort-eject').removeClass('grade-w-roll');
            };
        });
    });
    $(document).ready(function(){
        $(".Brand").click(function(){
            if ($('.grade-eject').hasClass('grade-w-roll')){
                $('.grade-eject').removeClass('grade-w-roll');
            };
        });
    });
    $(document).ready(function(){
        $(".Sort").click(function(){
            if ($('.Category-eject').hasClass('grade-w-roll')){
                $('.Category-eject').removeClass('grade-w-roll');
            };
        });
    });
    $(document).ready(function(){
        $(".Sort").click(function(){
            if ($('.grade-eject').hasClass('grade-w-roll')){
                $('.grade-eject').removeClass('grade-w-roll');
            };

        });
    });


    //js点击事件监听开始
    function grade1(wbj){
        var arr = document.getElementById("gradew").getElementsByTagName("li");
        for (var i = 0; i < arr.length; i++){
            var a = arr[i];
            a.style.background = "";
        };
    }

    function gradet(tbj){
        var arr = document.getElementById("gradet").getElementsByTagName("li");
        for (var i = 0; i < arr.length; i++){
            var a = arr[i];
            a.style.background = "";
        };
        tbj.style.background = "#fff"
    }

    function grades(sbj){
        var arr = document.getElementById("grades").getElementsByTagName("li");
        for (var i = 0; i < arr.length; i++){
            var a = arr[i];
            a.style.borderBottom = "";
        };
        sbj.style.borderBottom = "solid 1px #ff7c08"
    }

    function Categorytw(wbj){
        var arr = document.getElementById("Categorytw").getElementsByTagName("li");
        for (var i = 0; i < arr.length; i++){
            var a = arr[i];
            a.style.background = "";
        };
        wbj.style.background = "#eee"
    }

    function Categoryt(tbj){
        var arr = document.getElementById("Categoryt").getElementsByTagName("li");
        for (var i = 0; i < arr.length; i++){
            var a = arr[i];
            a.style.background = "";
        };
        tbj.style.background = "#fff"
    }

    function Categorys(sbj){
        var arr = document.getElementById("Categorys").getElementsByTagName("li");
        for (var i = 0; i < arr.length; i++){
            var a = arr[i];
            a.style.borderBottom = "";
        };
        sbj.style.borderBottom = "solid 1px #ff7c08"
    }

    function Sorts(sbj){
        var arr = document.getElementById("Sort-Sort").getElementsByTagName("li");
        for (var i = 0; i < arr.length; i++){
            var a = arr[i];
            a.style.borderBottom = "";
        };
        sbj.style.borderBottom = "solid 1px #ff7c08"
    }
})

</script>
@endsection
