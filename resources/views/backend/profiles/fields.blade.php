<!-- Type Field -->
<div class="form-group col-sm-12 hidden">
    {!! Form::label('type', 'Type:') !!}
    <label class="radio-inline">
        {!! Form::radio('type', "0", null) !!} admin
    </label>

    <label class="radio-inline">
        {!! Form::radio('type', "1", null) !!} manufacturer
    </label>

    <label class="radio-inline">
        {!! Form::radio('type', "2", null) !!} agent
    </label>

    <label class="radio-inline">
        {!! Form::radio('type', "3", null) !!} user
    </label>

</div>

<!-- User Id Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Prov Id Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('prov_id', 'Prov Id:') !!}
    {!! Form::select('prov_id', ['0' => 'All'], null, ['class' => 'form-control']) !!}
</div>

<!-- City Id Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('city_id', 'City Id:') !!}
    {!! Form::select('city_id', ['0' => 'All'], null, ['class' => 'form-control']) !!}
</div>

<!-- Industry Id Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('industry_id', 'Industry Id:') !!}
    {!! Form::select('industry_id', ['0' => 'All'], null, ['class' => 'form-control']) !!}
</div>

<!-- Industry Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('industry_name', '商家名称:') !!}
    {!! Form::text('industry_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('category_id', 'Category Id:') !!}
    {!! Form::select('category_id', ['0' => 'All'], null, ['class' => 'form-control']) !!}
</div>

<!-- Service Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('service', '主营业务:') !!}
    {!! Form::textarea('service', null, ['class' => 'form-control']) !!}
</div>

<!-- Identity Urls Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('identity_urls', 'Identity Urls:') !!}
    {!! Form::file('identity_urls') !!}
</div>
<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.profiles.index') !!}" class="btn btn-default">取消</a>
</div>
