<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $industry->id !!}</p>
</div>

<!-- Display Name Field -->
<div class="form-group">
    {!! Form::label('display_name', 'Display Name:') !!}
    <p>{!! $industry->display_name !!}</p>
</div>

<!-- User Id:unsigned:foreign,users,id Field -->
<div class="form-group">
    {!! Form::label('user_id:unsigned:foreign,users,id', 'User Id:unsigned:foreign,users,id:') !!}
    <p>{!! $industry->user_id:unsigned:foreign,users,id !!}</p>
</div>

<!-- Avatar Field -->
<div class="form-group">
    {!! Form::label('avatar', 'Avatar:') !!}
    <p>{!! $industry->avatar !!}</p>
</div>

<!-- Pic Urls Field -->
<div class="form-group">
    {!! Form::label('pic_urls', 'Pic Urls:') !!}
    <p>{!! $industry->pic_urls !!}</p>
</div>

<!-- Indetity Urls Field -->
<div class="form-group">
    {!! Form::label('indetity_urls', 'Indetity Urls:') !!}
    <p>{!! $industry->indetity_urls !!}</p>
</div>

<!-- Prov Id Field -->
<div class="form-group">
    {!! Form::label('prov_id', 'Prov Id:') !!}
    <p>{!! $industry->prov_id !!}</p>
</div>

<!-- City Id Field -->
<div class="form-group">
    {!! Form::label('city_id', 'City Id:') !!}
    <p>{!! $industry->city_id !!}</p>
</div>

<!-- Address Field -->
<div class="form-group">
    {!! Form::label('address', 'Address:') !!}
    <p>{!! $industry->address !!}</p>
</div>

<!-- Service Field -->
<div class="form-group">
    {!! Form::label('service', 'Service:') !!}
    <p>{!! $industry->service !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $industry->description !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $industry->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $industry->updated_at !!}</p>
</div>

