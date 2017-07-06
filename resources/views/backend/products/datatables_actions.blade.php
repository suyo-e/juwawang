{!! Form::open(['route' => ['admin.products.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
<!--
    <a href="{{ route('admin.products.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
-->
    <a href="{{ route('admin.products.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
@role('Administrator')
    @if ($is_recommand == 1)
    <a href="{{ route('admin.products.recommand', ['product_id' => $id ]) }}" class="btn btn-xs btn-success">取消推荐</a> 
    @else
    <a href="{{ route('admin.products.recommand', ['product_id' => $id ]) }}" class="btn btn-xs btn-success">推荐</a>
    @endif
@endauth
</div>
{!! Form::close() !!}
