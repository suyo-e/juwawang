<!-- Display Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('display_name', 'Display Name:') !!}
    {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Parent Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent_id', 'Parent Id:') !!}
    {!! Form::select('parent_id', $data, null, ['class' => 'form-control']) !!}
</div>

<!-- Pic Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pic_url', 'Pic Url:') !!}
    {!! Form::file('pic_url') !!}
</div>
<div class="clearfix"></div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::select('type', ['0' => 'All', '1' => '厂商注册', '2' => '代理商注册', '3' => '用户注册', '4' => '厂商发布商品', '5' => '代理商发布商品', '6' => '用户发布商品'], null, ['class' => 'form-control']) !!}
</div>

<!-- Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('url', 'Url:') !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.categories.index') !!}" class="btn btn-default">Cancel</a>
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
