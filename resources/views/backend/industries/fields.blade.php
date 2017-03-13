<!-- Display Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('display_name', 'Display Name:') !!}
    {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id:unsigned:foreign,users,id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id:unsigned:foreign,users,id', 'User Id:unsigned:foreign,users,id:') !!}
    {!! Form::text('user_id:unsigned:foreign,users,id', null, ['class' => 'form-control']) !!}
</div>

<!-- Avatar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('avatar', 'Avatar:') !!}
    {!! Form::file('avatar') !!}
</div>
<div class="clearfix"></div>

<!-- Pic Urls Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pic_urls', 'Pic Urls:') !!}
    {!! Form::file('pic_urls') !!}
</div>
<div class="clearfix"></div>

<!-- Indetity Urls Field -->
<div class="form-group col-sm-6">
    {!! Form::label('indetity_urls', 'Indetity Urls:') !!}
    {!! Form::file('indetity_urls') !!}
</div>
<div class="clearfix"></div>

<!-- Prov Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('prov_id', 'Prov Id:') !!}
    {!! Form::select('prov_id', ['0' => 'All'], null, ['class' => 'form-control']) !!}
</div>

<!-- City Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city_id', 'City Id:') !!}
    {!! Form::select('city_id', ['0' => 'All'], null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Service Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('service', 'Service:') !!}
    {!! Form::textarea('service', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.industries.index') !!}" class="btn btn-default">Cancel</a>
</div>
