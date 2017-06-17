<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', '用户ID:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', '添加/扣除积分:') !!}
    {!! Form::text('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Current Amount Field
<div class="form-group col-sm-6">
    {!! Form::label('current_amount', 'Current Amount:') !!}
    {!! Form::text('current_amount', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Typename Field -->
<div class="form-group col-sm-6 hidden">
    {!! Form::label('typename', 'Typename:') !!}
    {!! Form::text('typename', '后台操作积分', ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', '备注描述:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.scores.index') !!}" class="btn btn-default">Cancel</a>
</div>
