<!-- Id Field -->
<div class="form-group hidden">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $profile->id !!}</p>
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', '类型:') !!}
    <p>
<?php 
switch($profile->type) {
case 1:
    echo '厂商';
    break;
case 2:
    echo '经销商';
    break;
case 3:
    echo '普通用户';
    break;
}
?>
    </p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', '用户id:') !!}
    <p>{!! $profile->user_id !!}</p>
</div>

<!-- Prov Id Field -->
<div class="form-group">
    {!! Form::label('prov_id', '省份/城市/区域:') !!}
    <p>{!! $profile->prov_id !!}, {!! $profile->city_id !!}, {!! $profile->area_id !!}</p>
    <p>{!! $profile->province_city_name  !!}</p>
</div>

<div class="form-group">
    {!! Form::label('identity_str', '身份证号码/营业执照:') !!}
    <p>{!! $profile->identity_str !!}</p>
</div>

<!-- Industry Name Field -->
<div class="form-group">
    {!! Form::label('industry_name', '商户名称:') !!}
    <p>{!! $profile->industry_name !!}</p>
</div>

<!-- Service Field -->
<div class="form-group">
    {!! Form::label('service', '主营业务:') !!}
    <p>{!! $profile->service !!}</p>
</div>

<!-- Identity Urls Field -->
<div class="form-group">
    {!! Form::label('identity_urls', '审核图片:') !!}
    <p></p>
    <?php $urls = json_decode($profile->identity_urls) ?>
    @if ($urls)
    @foreach ($urls as $url) 
        <a target="_blank" href="{{ $url }}"><img src="{{$url}}" height="100"/></a>
    @endforeach
    @endif
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', '创建时间:') !!}
    <p>{!! $profile->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', '修改时间:') !!}
    <p>{!! $profile->updated_at !!}</p>
</div>

