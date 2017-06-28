<!-- Display Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('display_name', '商户名称:') !!}
    {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('province_city_name', '地区:') !!}
    <div id="province_city_name"></div>
    {!! Form::text('province_city_code', null, ['class' => 'form-control hidden', 'id'=>'province_city_code']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- QQ Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('qq', 'QQ:') !!}
    {!! Form::text('qq', null, ['class' => 'form-control']) !!}
</div>

<!-- wechat Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('wechat', 'Wechat:') !!}
    {!! Form::text('wechat', null, ['class' => 'form-control']) !!}
</div>

<!-- wechat Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('phone', '电话:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Avatar Field -->
<div class="form-group col-sm-12">
    {!! Form::label('avatar', '商户图片:') !!}
    <input id="upload-file" type="file" name="avatar_file" class="upload-file" />
    <img id="avatar_img" src="{{ $industry->avatar }}" height="100"/>
    {!! Form::text('avatar', null, ['class'=>'hidden', 'id'=>'avatar_input']) !!}
</div>
<div class="clearfix"></div>

<!-- Pic Urls Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('pic_urls', 'Pic Urls:') !!}
    {!! Form::file('pic_urls') !!}
</div>
<div class="clearfix"></div>

<!-- Indetity Urls Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('identity_urls', 'Indetity Urls:') !!}
    {!! Form::file('identity_urls') !!}
</div>
<div class="clearfix"></div>

<!-- Prov Id Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('prov_id', 'Prov Id:') !!}
    {!! Form::text('prov_id', null, ['class' => 'form-control']) !!}
</div>

<!-- City Id Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('city_id', 'City Id:') !!}
    {!! Form::text('city_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Area Id Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('area_id', 'City Id:') !!}
    {!! Form::text('area_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('address', '地址:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Service Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('service', '主营业务:') !!}
    {!! Form::text('service', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', '描述:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.industries.index') !!}" class="btn btn-default">取消</a>
</div>

