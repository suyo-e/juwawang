{!! Form::open(['route' => ['admin.scores.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
<!--
    <a href="{{ route('admin.scores.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i> {{ trans('buttons.general.crud.view') }}
    </a>
    <a href="{{ route('admin.scores.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i> {{ trans('buttons.general.crud.edit') }}
    </a>
-->
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>' . trans('buttons.general.crud.edit'), [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}
