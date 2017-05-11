<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', '商品名:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="clearfix"></div>

<!-- Banner Urls Field -->
<div class="form-group col-sm-6 ">
    {!! Form::label('banner_urls', '商品图片:') !!}
    <?php
    $banner_urls = [];
    if(isset($product))
        $banner_urls = json_decode($product->banner_urls);
    ?>
    <div id="banner-container">   
        @foreach ($banner_urls as $url) 
        <img class="banner-image" src="{{ $url }}" height="100" />
        <input name="banner_urls[]" value="{{ $url }}" type="hidden"/>
        @endforeach
    </div>
    <input id="upload-file" type="file" name="upload_file" />
</div>

<!-- Brand Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('brand_name', '品牌名称:') !!}
    {!! Form::text('brand_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-12">
    {!! Form::label('price', '价格:') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Prov City Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('province_city_name', '地区:') !!}
    {!! Form::text('province_city_name', null, ['class' => 'form-control']) !!}
    {!! Form::text('province_city_code', null, ['class' => 'form-control hidden', 'id'=>'province_city_code']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('address', '地址:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Name Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('type_name', '类型:') !!}
    {!! Form::text('type_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', '类别:') !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
    {!! Form::text('category_name', null, ['class' => 'hidden', 'id'=>'category_name']) !!}
</div>

<div class="clearfix"></div>

<!-- Contact Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contact_name', '联系名:') !!}
    {!! Form::text('contact_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Wechat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('wechat', '微信:') !!}
    {!! Form::text('wechat', null, ['class' => 'form-control']) !!}
</div>

<!-- Qq Field -->
<div class="form-group col-sm-6">
    {!! Form::label('qq', 'QQ') !!}
    {!! Form::text('qq', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', '电话:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>



<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', '描述:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Industry Id Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('industry_id', 'Industry Id:') !!}
    {!! Form::select('industry_id', ['0' => 'All'], null, ['class' => 'form-control']) !!}
</div>

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
    {!! Form::label('area_id', 'Area Id:') !!}
    {!! Form::text('area_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Pic Url Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('pic_url', '图片地址:') !!}
    {!! Form::file('pic_url') !!}
</div>
<div class="clearfix"></div>

<!-- View Count Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('view_count', 'View Count:') !!}
    {!! Form::text('view_count', null, ['class' => 'form-control']) !!}
</div>

<!-- Collect Count Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('collect_count', 'Collect Count:') !!}
    {!! Form::text('collect_count', null, ['class' => 'form-control']) !!}
</div>

<div class="clearfix"></div>

<!-- Status Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['0' => 'Normal', '1' => 'Off'], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.products.index') !!}" class="btn btn-default">取消</a>
</div>
