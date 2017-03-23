<li class="{{ Request::is('profiles*') ? 'active' : '' }}">
    <a href="{!! route('admin.profiles.index') !!}">
        <i class="fa fa-circle-o"></i><span>审核管理</span>
    </a>
</li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{{ route('admin.access.user.index') }}">
        <i class="fa fa-circle-o"></i><span>用户管理</span>
    </a>
</li>

<li class="{{ Request::is('orders*') ? 'active' : '' }}">
    <a href="{!! route('admin.orders.index') !!}">
        <i class="fa fa-circle-o"></i><span>订单管理</span>
    </a>
</li>

<li class="{{ Request::is('categories*') ? 'active' : '' }}">
    <a href="{!! route('admin.categories.index') !!}">
        <i class="fa fa-circle-o"></i><span>目录管理</span>
    </a>
</li>

<li class="{{ Request::is('banners*') ? 'active' : '' }}">
    <a href="{!! route('admin.banners.index') !!}">
        <i class="fa fa-circle-o"></i><span>导航banner</span>
    </a>
</li>

<li class="{{ Request::is('products*') ? 'active' : '' }}">
    <a href="{!! route('admin.products.index') !!}">
        <i class="fa fa-circle-o"></i><span>商品管理</span>
    </a>
</li>

<li class="{{ Request::is('information*') ? 'active' : '' }}">
    <a href="{!! route('admin.information.index') !!}">
        <i class="fa fa-circle-o"></i><span>资讯管理</span>
    </a>
</li>

