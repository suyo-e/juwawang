@extends('frontend.layouts.app')

<div class="contet">
    <form action="">
        <textarea name="" id="content" cols="30" rows="10" placeholder="请写下你对本平台的意见和建议"></textarea>
    </form>
</div>

<div class="btnlo">
    <button id="submit" type="submit" class="btnAll">提交</button>
</div>

@section('script')
<script>
$('#submit').click(function() {
    $.get('api/feedback?content='+ $("#content").val(), function(data) {
        alert('反馈成功');
        history.go(-1);
    });
});
</script>
@endsection
