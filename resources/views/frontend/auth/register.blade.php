@extends('frontend.layouts.app')

@section('content')
<div class="container">
    {{ Form::open(['route' => 'frontend.auth.register', 'class' => '']) }}
    <div class="register" id="step_1">
        <input class="inputAll" type="tel" name="phone" value="{{ old('phone') }}" placeholder=" 请输入电话号码">
        <div class="code">
            <input class="num inpt" placeholder=" 请输入验证码" type="number" name="verify_code" value="{{ old('verify_code') }}" >
            <button class="onbtn" type="button">获取验证码</button>
        </div>
        <input class="inputAll" type="password" name="password" value="{{ old('password') }}" placeholder=" 请设置密码">
        <div class="Aradio">
            <label><input class="Fruit" type="radio" value="3" name="type" checked="" {{old('type')==2?'checked':''}}>用户</label>
            <label><input class="Fruit" type="radio" value="2" name="type" {{old('type')==2?'checked':''}}>厂家</label>
            <label><input class="Fruit" type="radio" value="1" name="type" {{old('type')==1?'checked':''}}>经销商</label>
        </div>
        <div class="NextStep">
            <button type="button" id="toStep2">下一步</button>
        </div>
        <label class="imy">
            <input type="checkbox" id="readProtocol" name="checked" {{old('checked')?'checked':''}}>我已阅读并同意
            <span>《服务协议》</span>
        </label>
    </div>
    <div id="step_2" class="register hidden">
        <input class="inputAll" type="text" name="name" value="{{ old('name') }}" placeholder="真实姓名">
        <select class="inputAll" name="manufa_1" id="manufa-1">
            <option value="0">请选择一级行业</option>
        </select>

        <select class="inputAll hidden" name="manufa_2" id="manufa-2">
            <option value="0">请选择二级行业</option>
        </select>
        <input class="inputAll" id="city-picker" name="province_city_name" value="{{ old('province_city_name') }}" placeholder="请选择省份城市" />
        <input type="hidden" name="province_city" id="province_city" value="{{ old('province_city') }}"/>
        <input class="inputAll" type="text" name="industry_name" value="{{ old('industry_name') }}" placeholder="经销商名称或者厂商名称" id="industry_name">
        <a href="#"><button id="submit" class="btnAll" type="submit">提交</button></a>
    </div>
    {{ Form::close() }}
</div>
@endsection

@section('script')
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/city-picker.min.js"></script>
<script>

$(function() { 
    $("#submit").click(function() {
        if($("#name").val() == ""){
            alert("请输入真实姓名");
            return false;
        }
        if($("#manufa-1").val() == "0") {
            alert("请选择行业")
            return false;
        }
        var type = $("input[name='type']:checked").val();
        if(type != 3 && $("#manufa-2").val() == "0") {
            alert("请选择二级行业");
            return false;
        }
        if($("#city-picker").val() == "") {
            alert("请选择城市");
            return false;
        }
        if($("#industry_name").val() == "") {
            alert("请输入厂商名称");
            return false;
        }
        $("#province_city").val( $("#city-picker").attr("data-codes") );

        $("form").submit();
    });

    $("#toStep2").click(function() {
        if($("#readProtocol:checked").val() != 'on') {
            alert("请先同意协议");
            return false;
        }
        if($("input[name='phone']").val() == "") {
            alert("手机号码不能为空");
            return false;
        }
        if($("input[name='password']").val() == "") {
            alert("密码不能为空");
            return false;
        }
        if($("input[name='password']").val().length < 6 ) {
            alert("密码长度不能小于6位");
            return false;
        }
        if($("input[name='verify_code']").val() == "") {
            alert("验证码不能为空");
            return false;
        }
    
        $("#step_1").hide();
        $("#step_2").show();
        
        $("#city-picker").cityPicker({
            title: "请选择省份城市",
            showDistrict: false,
        });

        var type = $("input[name='type']:checked").val();
        $.get('/categories?type=' + type, function(data) {
            var data = data.data;
            var options = '';
            for(var i in data) {
                options += '<option value="' + data[i].id +'">' + data[i].display_name + '</option>';
            }

            $("#manufa-1").append(options);
        });
    });
    
    $("#manufa-1").change(function() {
        var parent_id = $(this).val();
        $("#menufa-2").hide();
        $.get('/categories?parent_id=' + parent_id, function(data) {
            var data = data.data;
            $("#manufa-2").empty();

            if(data.length == 0) {
                $("#manufa-2").append('<option value="">暂无二级行业</option>');
            }
            else {
                var options = '<option value="">请选择二级行业</option>';
                for(var i in data) {
                    options += '<option value="' + data[i].id +'">' + data[i].display_name + '</option>';
                }

                $("#manufa-2").append(options);
                $("#manufa-2").show();
            }
            
        });
    });
});
</script>
@endsection
