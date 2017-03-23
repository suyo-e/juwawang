
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

});

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

    $('.clasStion').click(function(){
        $('.grade-w').slideToggle(300).siblings('ul').attr("style","");
        $('.weui-picker-container').hide();
    });
    $('.clasRegion').click(function(){
        $('.ejectAll').hide();
        $("#city-picker").cityPicker({
            title: "选择省市区/县",
            onChange: function (picker, values, displayValues) {
                console.log(values, displayValues);
            }
        });
    });
    $('.ReleaseTime').click(function(){
        $('.grade-s').slideToggle(300).siblings('ul').attr("style","");
        $('.weui-picker-container').hide();
    });
    $('.source').click(function(){
        $('.grade-y').slideToggle(300).siblings('ul').attr("style","");
        $('.weui-picker-container').hide();
    });
})


