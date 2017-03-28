@extends('frontend.layouts.app')

@section('content')
<div class="forget">
    <form action="">
        <input id="phone" name="phone" class="inputAll" type="number" placeholder="请输入电话号码">
    </form>
    <br>
    <a id="find"><button class="btnAll" type="submit">立即找回</button></a>
</div>
<div class="release hidden" style="text-align:center">
    <p class="Countdown">您已发送验证码到:<span id="verify_phone"></span>等待<span id="waiting">1s</span></p>
{{ Form::open(['route' => 'frontend.users.resetPassword', 'class' => '']) }}
        <input name="phone" class="inputAll" type="hidden">
        <lebel><input name="verify_code" class="inputAll" type="number" placeholder="请输入验证码"></lebel>
        <lebel><input name="new_password" class="inputAll" type="password" placeholder=" 请输入新密码"></lebel>
        <lebel><input name="rep_password" class="inputAll" type="password" placeholder=" 请再次输入新密码"></lebel>
        <lebel><input class="btnAll" type="submit" value="提交" id="submit"></lebel>
{{ Form::close() }}
</div>
@endsection

@section('script')
<script>
$("#find").click(function() {
    var phone = $("#phone").val();
    if(phone == '') {
        alert('请输入手机号码');
        return false;
    }
    $("#verify_phone").text(phone);
    $("input[name='phone']").val(phone);

    $.get('/verify?phone='+phone, function(data) {
        var time = 0;
        setInterval(function() {
            time ++;
            $("#waiting").text(time + 's');
        }, 1000);

        $(".forget").hide();
        $(".release").show();
    });
});

$("#submit").click(function() {
    var verify_code = $("input[name='verify_code']").val();
    var new_password = $("input[name='new_password']").val();
    var rep_password = $("input[name='rep_password']").val();

    if(verify_code == '') {
        alert('请输入验证码');
        return false;
    }
    if(new_password == '') {
        alert('请输入密码');
        return false;
    }
    if(rep_password == '') {
        alert('请输入重复输入密码');
        return false;
    }

    return true;
});
</script>
@endsection
