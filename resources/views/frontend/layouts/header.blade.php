<div class="headTop">
    {!! Form::open(['route' => 'frontend.industries.index', 'method' => 'get']) !!}
    <div class="search">
        <p><img src="image/search.png" alt=""/></p>
        <input name="display_name" type="text" placeholder="搜索商家"/>
        <input type="submit" style="display:none" />
    </div>
    {!! Form::close() !!}
    <div class="Release">
        <a href="/products/categories">发布</a>
    </div>
</div>
