

<li class="{{ Request::is('orders*') ? 'active' : '' }}">
    <a href="{!! route('admin.orders.index') !!}"><i class="fa fa-circle-o"></i><span>Orders</span></a>
</li>

<li class="{{ Request::is('collects*') ? 'active' : '' }}">
    <a href="{!! route('admin.collects.index') !!}"><i class="fa fa-circle-o"></i><span>Collects</span></a>
</li>

<li class="{{ Request::is('industries*') ? 'active' : '' }}">
    <a href="{!! route('admin.industries.index') !!}"><i class="fa fa-circle-o"></i><span>Industries</span></a>
</li>

<li class="{{ Request::is('categories*') ? 'active' : '' }}">
    <a href="{!! route('admin.categories.index') !!}"><i class="fa fa-circle-o"></i><span>Categories</span></a>
</li>

<li class="{{ Request::is('banners*') ? 'active' : '' }}">
    <a href="{!! route('admin.banners.index') !!}"><i class="fa fa-circle-o"></i><span>Banners</span></a>
</li>




<li class="{{ Request::is('profiles*') ? 'active' : '' }}">
    <a href="{!! route('admin.profiles.index') !!}"><i class="fa fa-circle-o"></i><span>Profiles</span></a>
</li>



<li class="{{ Request::is('products*') ? 'active' : '' }}">
    <a href="{!! route('admin.products.index') !!}"><i class="fa fa-circle-o"></i><span>Products</span></a>
</li>

