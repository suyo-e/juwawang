<table class="table table-responsive" id="stats-table">
    <thead>
        <th>日期</th>
        @foreach($categories as $category) 
        <th>{{ $category }}</th>
        @endforeach
    </thead>
    <tbody>
    @foreach($stats as $key=>$data)
        <tr>
            <td>{{ $key }}</td>
            @foreach($categories as $category_id => $category)
            @if(isset($data[$category_id]))
            <td>{{ $data[$category_id] }}</td>
            @else
            <td>0</td>
            @endif
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
