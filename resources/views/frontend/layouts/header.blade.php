<div class="headTop">
    <div class="Release">
        <a href="/logout">注销</a>
    </div>
    {!! Form::open(['route' => 'frontend.industries.index', 'method' => 'get']) !!}
    <div class="search" style="margin-left:0">
        <p><img src="image/search.png" alt=""/></p>
        <input name="from" type="hidden" value="{{ $from }}" />
        <input name="display_name" type="text" placeholder="搜索商家"/>
        <input type="submit" style="display:none" />
    </div>
    {!! Form::close() !!}
    <div class="Release">
        <a href="/products/categories">发布</a>
    </div>
</div>
