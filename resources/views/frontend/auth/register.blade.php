@extends('frontend.layouts.app')
<?php
//dd($category_ids_array);
?>

@section('content')
<div class="container">
    {{ Form::open(['route' => 'frontend.auth.register', 'class' => '']) }}
    <div class="register {{ $step == 1?'': 'hidden' }}" id="step_1">
        <input id="phoneNum" class="inputAll" type="tel" name="phone" value="{{ $phone?$phone:old('phone') }}" placeholder=" 请输入电话号码">
        <div class="code">
            <input class="num inpt" placeholder=" 请输入验证码" type="number" name="verify_code" value="{{ $verify_code?$verify_code:old('verify_code') }}" >
            <button id="verifyCode" class="onbtn" type="button">获取验证码</button>
        </div>
        <input class="inputAll" type="password" name="password" value="{{ $password?$password:old('password') }}" placeholder=" 请设置密码">
        <div class="Aradio">
            <label><input class="Fruit" type="radio" value="3" name="type" checked="" {{ $type==3?'checked':''}}>用户</label>
            <label><input class="Fruit" type="radio" value="2" name="type" {{ $type==2?'checked':''}}>经销商</label>
            <label><input class="Fruit" type="radio" value="1" name="type" {{ $type==1?'checked':''}}>厂家</label>
        </div>
        <div class="NextStep">
            <button type="button" id="toStep2">下一步</button>
        </div>
        <label class="imy">
            <input type="checkbox" id="readProtocol" name="checked" {{ $checked?'':'checked'}}>我已阅读并同意
            <span>《服务协议》</span>
        </label>
    </div>
    <div id="listManufaLevel1" class="listManufa {{ $step == 2?'': 'hidden' }}">
        <ul>
        @foreach($categories as $category) 
            <li data-id="{{ $category->id }}" class="select {!! in_array($category->id, $category_ids_array)? 'selected': '' !!}">
                {{ $category->display_name }} 
                {!! $type != 3 ? '<img src="/image/on_right.png" alt="">': '' !!} 
                {!! in_array($category->id, $category_ids_array)? '<img src="/image/right.pic" alt="">': '' !!}
            </li>
        @endforeach
        </ul>
        <footer>
            <button type="button" class="nextStep fabu" >下一步</button>
        </footer>
    </div>
    <div id="listManufaLevel2" class="listManufa {{ $step == 3?'': 'hidden' }}">
        <ul>
        @foreach($categories as $category) 
            <li data-id="{{ $category->id }}" class="select">{{ $category->display_name }} </li>
        @endforeach
        </ul>
        <footer>
            <button type="button" class="nextStep fabu">确定</button>
        </footer>
    </div>
    <div class="register {{ $step == 4?'': 'hidden' }}">
        <input class="inputAll" type="text" name="name" value="{{ $name }}" placeholder="真实姓名">
        <input type="hidden" name="category_ids" value="{{ $category_ids }}">
        <input type="hidden" name="manufa_1" value="{{ $manufa_1 }}">
        <input type="hidden" name="manufa_2" value="{{ $manufa_2 }}">
<!--
        <select class="inputAll" name="manufa_1" id="manufa-1">
            <option value="0">请选择一级行业</option>
        </select>

        <select class="inputAll hidden" name="manufa_2" id="manufa-2">
            <option value="0">请选择二级行业</option>
        </select>
-->
        <input class="inputAll" id="city-picker" name="province_city_name" value="{{ $province_city_name }}" placeholder="请选择省份城市" />
        <input type="hidden" name="province_city" id="province_city" value="{{ $province_city }}"/>
        
        <input class="inputAll" type="text" name="invite_code" value="{{ $invite_code }}" placeholder="如果有邀请码，请填写" id="invite_code">

        <input class="inputAll {{ $type == 3?'hidden': '' }}" type="text" name="industry_name" value="{{ $industry_name }}" placeholder="经销商名称或者厂商名称" id="industry_name">
        <a href="#"><button id="submit" class="btnAll" type="submit">提交</button></a>
    </div>
    {{ Form::close() }}
</div>
@endsection

@section('script')
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/city-picker.min.js"></script>
<script>
    var wait=60;  
    function time(o) {  
        if (wait == 0) {  
            o.removeAttribute("disabled");            
            o.innerText="获取验证码";  
            wait = 60;  
        } else {  
            o.setAttribute("disabled", true);  
            o.innerText="重新发送(" + wait + ")";  
            wait--;  
            setTimeout(function() {  
                time(o)  
            },  
            1000)  
        }  
    }

    var selectClick = function(self, type) {
        if($(self).parent().parent().attr('id') == 'listManufaLevel1' && $(self).parent().find(".selected").length >= 5) {
            alert('最多勾选5个一级行业');
            return false;
        }
        if($(self).parent().parent().attr('id') == 'listManufaLevel2' && $(self).parent().find(".selected").length >= 15) {
            alert('最多勾选15个一级行业');
            return false;
        }
        var category_ids = $("input[name='category_ids']").val();
        if(category_ids == '') {
            category_ids = [];
        }
        else {
            category_ids = category_ids.split('|');
        }
        var ids = {};
        for(var i in category_ids) {
            ids[category_ids[i]] = 1; 
        }

        // 普通用户打勾
        if($(self).find('img').length == 1) {
            $(self).removeClass('selected');
            $(self).find('img').remove();

            ids[$(self).attr('data-id')] = undefined;
        }
        else {
            $(self).addClass('selected');
            $(self).append('<img src="/image/right.pic" alt="">');

            ids[$(self).attr('data-id')] = 1;
        }

        
        if($(self).parent().find("img").length == 0) {
            ids[$("input[name='manufa_1']").val()] = undefined;
        }
        else {
            ids[$("input[name='manufa_1']").val()] = 1;
        }

        var category_ids = [];
        for(var i in ids) {
            if(ids[i] == 1) {
                category_ids.push(i);
            }
        }
        category_ids = category_ids.join('|');

        $("input[name='category_ids']").val(category_ids);
    }

    $("#verifyCode").click(function() {
        var phone = $("#phoneNum").val();
        if(phone == '') {  
            alert('请输入手机号码');
            return false;
        }
        $.get('/verify?phone=' + phone);

        time(this);
    });

    $("#listManufaLevel1 .select").click(function() {
        var self = this;

        if($(self).parent().parent().attr('id') == 'listManufaLevel1' && $(self).parent().find(".selected").length >= 5) {
            alert('最多勾选5个一级行业');
            return false;
        }
        if($(self).parent().parent().attr('id') == 'listManufaLevel2' && $(self).parent().find(".selected").length >= 15) {
            alert('最多勾选15个一级行业');
            return false;
        }
        var type = $("input[name='type']:checked").val();
        $("input[name='manufa_1']").val($(this).attr('data-id'));
        if(type != 3) {
            location.href= "?step=3&" + $("form").serialize();
            return false;
        }
        selectClick(this, 1);
    });

    $("#listManufaLevel2 .select").click(function() {
        $("input[name='manufa_2']").val($(this).attr('data-id'));
        selectClick(this, 2);

        $("#listManufaLevel2 button").text('确定(' + $("#listManufaLevel2 .selected").length + ')');
    });

    $("#listManufaLevel1 .nextStep").click(function() {

        var type = $("input[name='type']:checked").val();
        var category_ids = $("input[name='category_ids']").val();
        if(category_ids == '') {
            alert('请至少选择一个行业');
            return false;
        }

        location.href= "?step=4&" + $("form").serialize();
    });

    $("#listManufaLevel2 .nextStep").click(function() {
        //$("input[name='manufa_2']").val($(this).attr('data-id'));
        location.href= "?step=2&" + $("form").serialize();
    })

$(function() { 
    
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
        location.href= "?step=2&" + $("form").serialize();
    });
         
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
        if(type != 3  && $("#industry_name").val() == "") {
            alert("请输入厂商名称");
            return false;
        }
        $("#province_city").val( $("#city-picker").attr("data-codes") );

        $("form").submit();
    });

    $("#city-picker").cityPicker({
        title: "请选择省份城市",
        //showDistrict: false,
        onChange: function() {
            $("#province_city").val( $("#city-picker").attr("data-codes") );
        }
    });
   
});
</script>
@endsection
