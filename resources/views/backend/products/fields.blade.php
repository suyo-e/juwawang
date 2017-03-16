<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type_name', 'Type Name:') !!}
    {!! Form::text('type_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', 'Category Id:') !!}
    {!! Form::select('category_id', ['0' => 'All'], null, ['class' => 'form-control']) !!}
</div>

<!-- Industry Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('industry_id', 'Industry Id:') !!}
    {!! Form::select('industry_id', ['0' => 'All'], null, ['class' => 'form-control']) !!}
</div>

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

<!-- Brand Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('brand_name', 'Brand Name:') !!}
    {!! Form::text('brand_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Pic Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pic_url', 'Pic Url:') !!}
    {!! Form::file('pic_url') !!}
</div>
<div class="clearfix"></div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Contact Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contact_name', 'Contact Name:') !!}
    {!! Form::text('contact_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Wechat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('wechat', 'Wechat:') !!}
    {!! Form::text('wechat', null, ['class' => 'form-control']) !!}
</div>

<!-- Qq Field -->
<div class="form-group col-sm-6">
    {!! Form::label('qq', 'Qq:') !!}
    {!! Form::text('qq', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Phone:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- View Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('view_count', 'View Count:') !!}
    {!! Form::text('view_count', null, ['class' => 'form-control']) !!}
</div>

<!-- Collect Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('collect_count', 'Collect Count:') !!}
    {!! Form::text('collect_count', null, ['class' => 'form-control']) !!}
</div>

<!-- Banner Urls Field -->
<div class="form-group col-sm-6">
    {!! Form::label('banner_urls', 'Banner Urls:') !!}
    {!! Form::file('banner_urls') !!}
</div>
<div class="clearfix"></div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['0' => 'Normal', '1' => 'Off'], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.products.index') !!}" class="btn btn-default">Cancel</a>
</div>
