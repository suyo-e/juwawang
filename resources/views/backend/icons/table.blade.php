<table class="table table-responsive" id="icons-table">
    <thead>
        <th>名称</th>
        <th>logo 图片</th>
        <th>目录id</th>
        <th>比重</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($icons as $icon)
        <tr>
            <td>{!! $icon->title !!}</td>
            <td><img src="{!! $icon->pic_url !!}" width=50 /></td>
            <td>{!! $icon->category_ids !!}</td>
            <td>{!! $icon->rank !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.icons.destroy', $icon->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.icons.show', [$icon->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.icons.edit', [$icon->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>