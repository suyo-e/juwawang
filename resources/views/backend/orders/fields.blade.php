<!-- Product Id Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('product_id', 'Product Id:') !!}
    {!! Form::text('product_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Contact Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contact_name', '联系人:') !!}
    {!! Form::text('contact_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', '电话号码:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
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

<!-- Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity', '数量:') !!}
    {!! Form::text('quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Remark Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('remark', '备注:') !!}
    {!! Form::textarea('remark', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['0' => 'All'], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.orders.index') !!}" class="btn btn-default">取消</a>
</div>
