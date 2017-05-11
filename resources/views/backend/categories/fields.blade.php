<!-- Display Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('display_name', '名称:') !!}
    {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Parent Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent_id', '父节点:') !!}
    {!! Form::select('parent_id', $data, null, ['class' => 'form-control']) !!}
</div>

<!-- Pic Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pic_url', '图片地址:') !!}
    {!! Form::file('pic_url') !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('pic_url_input', '或者输入图片地址:') !!}
    {!! Form::text('pic_url_input', null, ['class' => 'form-control']) !!}
</div>
<div class="clearfix"></div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', '目录类型:') !!}
    {!! Form::select('type', ['0' => 'All', '1' => '厂商注册', '2' => '经销商注册', '3' => '用户注册', '4' => '厂商发布商品', '5' => '经销商发布商品', '6' => '用户发布商品'], null, ['class' => 'form-control']) !!}
</div>

<!-- Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('url', '跳转地址:') !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.categories.index') !!}" class="btn btn-default">取消</a>
</div>

@section('scripts')
<script>
jQuery("#parent_id").change(function() {
    if($(this).val() != 0){
        $("#type").attr('disabled', true);
        $("#type").val(0);
    }
    else {
        $("#type").attr('disabled', false);
    }
});
</script>
@endsection
