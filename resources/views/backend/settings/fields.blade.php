<!-- Setting Key Field -->
<div class="form-group col-sm-6">
    {!! Form::label('setting_key', '配置名:') !!}
    {!! Form::text('setting_key', null, ['class' => 'form-control']) !!}
</div>

<!-- Setting Val Field -->
<div class="form-group col-sm-6">
    {!! Form::label('setting_val', '配置值:') !!}
    {!! Form::text('setting_val', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.settings.index') !!}" class="btn btn-default">Cancel</a>
</div>
