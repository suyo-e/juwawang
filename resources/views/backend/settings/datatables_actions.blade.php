{!! Form::open(['route' => ['admin.settings.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('admin.settings.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i> {{ trans('buttons.general.crud.edit') }}
    </a>
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>' . trans('buttons.general.crud.delete'), [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}
