@extends('frontend.layouts.app')
<?php
$identity_urls = json_decode($profile->identity_urls);
?>

@section('content')
<div class="headTop">
    <div class="search">
<!--
        <p>
            <img src="/image/search.png" alt="">
        </p>
        <input type="text" placeholder="搜索商家" value="{{ $industry_name }}">
-->
        <a href="#">编辑</a>
    </div>
</div>
<div class="baner">
    @if (isset($identity_urls[0]))
        <img src="{{ $identity_urls[0]}}" alt="">
    @else
        <img src="/image/title.png" alt="">
    @endif
    <div class="userCont">
        <p class="Villain"><img src="/image/ren.png" alt=""></p>
        <p class="userIntroduce">
            <span class="daiV">{{ $profile->industry_name }}({{$profile->realname}})<!--<img src="../../image/V.png" alt="">--></span>
            <span>{{$profile->recommand_count}}人推荐</span>
        </p>
    </div>
</div>
<div class="main">
    <div class="SeeMerchant">
        <a id="onzhao" href="#">证件照
            <img class="seeimg" src="/image/zhaopian.png" alt="">
        </a>
        <div id="onblock" class="zhezhao" style="display: none;">
            <p class="motai">
                @if (isset($identity_urls[1]))
                    <img src="{{ $identity_urls[1]}}" alt="">
                @else
                @endif
                <span id="removee" class="removee">
                    <img class="remoimg" src="/image/remo.png" alt="">
                </span>
            </p>
        </div>
    </div>
<!--
    <div class="SeeMerchant">
        <a id="onyier" href="#">商家二维码<img class="seeimg" src="../../image/erweima.png" alt=""></a>
        <div id="onkuai" class="zhezhao" style="display: none;">
            <p class="motai">
                <img src="../../image/listimg.jpg" alt="">
                <span id="remove" class="removee">
                    <img class="remoimg" src="../../image/remo.png" alt="">
                </span>
            </p>
        </div>
    </div>
-->
    <div class="SeeMerchant">
        <span>地区位置 : </span><span>{{ $profile->province_city_name }}</span>
    </div>
    <div class="SeeMerchant">
        <span>详细地址 : </span><span>{{ $profile->address }}</span>
    </div>
    <div class="SeeMerchant">
        <span>主营业务 : </span><span>{{ $profile->service }}</span>
    </div>
<!--
    <div class="DetailsIntro">
        <p class="deinro">简介</p>
        <div class="DetailsCont">
            住友建机以高效焊接机械手、大型智能机械加工中心、多品种混合生产组装流水线等先进设备进行生产制造，
            并通过对焊接部分进行超声波检查、
            严格确认下线后的机械性能等一丝不苟的质量管理，向世界各地的用户提供安心满意的产品。
            试验工厂是住友建机的分析开展研究工作。
            <a href="#">查看更多</a>
        </div>
    </div>
-->
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
