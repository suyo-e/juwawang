{!! Form::open(['route' => ['admin.industries.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
    <a href="{{ route('admin.industries.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    @if ($is_recommand == 1)
    <a href="{{ route('admin.access.user.recommand', $user_id ) }}" class="btn btn-xs btn-success">取消推荐</a> 
    <a href="{{ route('admin.industries.show', $id) }}" class='btn btn-default btn-xs'>
        置顶
    </a>
    @else
    <a href="{{ route('admin.access.user.recommand', $user_id) }}" class="btn btn-xs btn-success">推荐</a>
    @endif
</div>
{!! Form::close() !!}
