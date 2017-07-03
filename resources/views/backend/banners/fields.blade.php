<!-- Display Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('display_name', '展示名称:') !!}
    {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('url', '链接地址:') !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>

<!-- Pic Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pic_url', 'banner图片:') !!}
    {!! Form::file('pic_url') !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', '类型:') !!}
    {!! Form::select('type', ['0' => 'All', '1' => '厂商', '2' => '经销商', '3' => '用户 ', '10' => '邀请注册'], null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', '描述:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.banners.index') !!}" class="btn btn-default">取消</a>
</div>
