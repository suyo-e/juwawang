<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', '商品名:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
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

<!-- Type Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type_name', '类型:') !!}
    {!! Form::text('type_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('category_id', 'Category Id:') !!}
    {!! Form::select('category_id', ['0' => 'All'], null, ['class' => 'form-control']) !!}
</div>

<!-- Industry Id Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('industry_id', 'Industry Id:') !!}
    {!! Form::select('industry_id', ['0' => 'All'], null, ['class' => 'form-control']) !!}
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

<!-- Brand Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('brand_name', '品牌名称:') !!}
    {!! Form::text('brand_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Pic Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pic_url', '图片地址:') !!}
    {!! Form::file('pic_url') !!}
</div>
<div class="clearfix"></div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', '价格:') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('address', '地址:') !!}
    {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
</div>

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

<!-- Banner Urls Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('banner_urls', 'Banner Urls:') !!}
    {!! Form::file('banner_urls') !!}
</div>
<div class="clearfix"></div>

<!-- Status Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['0' => 'Normal', '1' => 'Off'], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.products.index') !!}" class="btn btn-default">Cancel</a>
</div>
