<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $setting->id !!}</p>
</div>

<!-- Setting Key Field -->
<div class="form-group">
    {!! Form::label('setting_key', 'Setting Key:') !!}
    <p>{!! $setting->setting_key !!}</p>
</div>

<!-- Setting Val Field -->
<div class="form-group">
    {!! Form::label('setting_val', 'Setting Val:') !!}
    <p>{!! $setting->setting_val !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $setting->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $setting->updated_at !!}</p>
</div>

