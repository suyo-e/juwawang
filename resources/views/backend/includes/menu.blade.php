@role('Administrator')
<li class="{{ Request::is('profiles*') ? 'active' : '' }}">
    <a href="{!! route('admin.profiles.index', ['is_identities'=>'1,3']) !!}">
        <i class="fa fa-circle-o"></i><span>审核及资料修改</span>
    </a>
</li>
<li class="active treeview">
    <a href="#">
        <i class="fa fa-list"></i>
        <span>用户管理</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>

    <ul class="treeview-menu"> 
        <li class="{{ Request::is('users*') ? 'active' : '' }}">
            <a href="{{ route('admin.access.user.index') }}">
                <i class="fa fa-circle-o"></i><span>用户资料</span>
            </a>
        </li>
<!--
        <li class="{{ Request::is('industries*') ? 'active' : '' }}">
            <a href="{{ route('admin.industries.index', ['type'=>'user']) }}">
                <i class="fa fa-circle-o"></i><span>普通商户管理</span>
            </a>
        </li>
-->
        <li class="{{ Request::is('industries*') ? 'active' : '' }}">
            <a href="{{ route('admin.industries.index', ['type'=>'agent']) }}">
                <i class="fa fa-circle-o"></i><span>经销商商户管理</span>
            </a>
        </li>
        <li class="{{ Request::is('industries*') ? 'active' : '' }}">
            <a href="{{ route('admin.industries.index', ['type'=>'manufacturer']) }}">
                <i class="fa fa-circle-o"></i><span>厂商商户管理</span>
            </a>
        </li>
    </ul>
</li>
<li class="active treeview">
    <a href="#">
        <i class="fa fa-list"></i>
        <span>内容管理</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('banners*') ? 'active' : '' }}">
            <a href="{!! route('admin.banners.index') !!}">
                <i class="fa fa-circle-o"></i><span>导航banner</span>
            </a>
        </li>
        <li class="{{ Request::is('information*') ? 'active' : '' }}">
            <a href="{!! route('admin.information.index') !!}">
                <i class="fa fa-circle-o"></i><span>资讯文章</span>
            </a>
        </li>
        <li class="{{ Request::is('feedback*') ? 'active' : '' }}">
            <a href="{!! route('admin.feedback.index') !!}"><i class="fa fa-circle-o"></i><span>反馈</span></a>
        </li>

        <li class="{{ Request::is('icons*') ? 'active' : '' }}">
            <a href="{!! route('admin.icons.index') !!}"><i class="fa fa-circle-o"></i><span>首页Icon配置</span></a>
        </li>

    </ul>
</li>
<li class="header">商户管理</li>
<li class="active treeview">
    <a href="#">
        <i class="fa fa-list"></i>
        <span>商品管理</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('categories*') ? 'active' : '' }}">
            <a href="{!! route('admin.categories.index', ['type'=>'product']) !!}">
                <i class="fa fa-circle-o"></i><span>商品发布行业</span>
            </a>
        </li>
        <li class="{{ Request::is('categories*') ? 'active' : '' }}">
            <a href="{!! route('admin.categories.index', ['type'=>'register']) !!}">
                <i class="fa fa-circle-o"></i><span>商户注册行业</span>
            </a>
        </li>
        <li class="{{ Request::is('products*') ? 'active' : '' }}">
            <a href="{!! route('admin.products.index') !!}">
                <i class="fa fa-circle-o"></i><span>商品管理</span>
            </a>
        </li>
        <li class="{{ Request::is('orders*') ? 'active' : '' }}">
            <a href="{!! route('admin.orders.index') !!}">
                <i class="fa fa-circle-o"></i><span>求购意向列表</span>
            </a>
        </li>
    </ul>
</li>
@endauth

@if( access()->user()->phone != '19000000001')
<li class="active treeview">
    <a href="#">
        <i class="fa fa-list"></i>
        <span>信息管理</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>

    <ul class="treeview-menu"> 
        <li class="{{ Request::is('users*') ? 'active' : '' }}">
            <a href="{{ route('admin.profile') }}">
                <i class="fa fa-circle-o"></i><span>个人信息管理</span>
            </a>
        </li>
        <li class="{{ Request::is('users*') ? 'active' : '' }}">
            <a href="{{ route('admin.industry') }}">
                <i class="fa fa-circle-o"></i><span>商户信息管理</span>
            </a>
        </li>
    </ul>
</li>
<li class="active treeview">
    <a href="#">
        <i class="fa fa-list"></i>
        <span>商品管理</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>

    <ul class="treeview-menu"> 
        <li class="{{ Request::is('users*') ? 'active' : '' }}">
            <a href="{!! route('admin.products.index') !!}">
                <i class="fa fa-circle-o"></i><span>我的商品</span>
            </a>
        </li>
    </ul>
</li>
<li class="active treeview">
    <a href="#">
        <i class="fa fa-list"></i>
        <span>我的意向订单</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>

    <ul class="treeview-menu"> 
        <li class="{{ Request::is('users*') ? 'active' : '' }}">
            <a href="{!! route('admin.orders.index', ['type'=>'recieve']) !!}">
                <i class="fa fa-circle-o"></i><span>我收到的</span>
            </a>
        </li>
    </ul>
    <ul class="treeview-menu"> 
        <li class="{{ Request::is('users*') ? 'active' : '' }}">
            <a href="{!! route('admin.orders.index', ['type'=>'send']) !!}">
                <i class="fa fa-circle-o"></i><span>我发出的</span>
            </a>
        </li>
    </ul>
</li>
@endif

@role('Administrator')
<li class="active treeview">
    <a href="#">
        <i class="fa fa-list"></i>
        <span>数据报表</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu"> 
        <li class="{{ Request::is('stats*') ? 'active' : '' }}">
            <a href="{!! route('admin.stats.users') !!}">
                <i class="fa fa-circle-o"></i><span>用户数据</span>
            </a>
        </li>
        <li class="{{ Request::is('stats*') ? 'active' : '' }}">
            <a href="{!! route('admin.stats.products') !!}">
                <i class="fa fa-circle-o"></i><span>商品数据</span>
            </a>
        </li>
        <li class="{{ Request::is('stats*') ? 'active' : '' }}">
            <a href="{!! route('admin.stats.orders') !!}">
                <i class="fa fa-circle-o"></i><span>意向订单</span>
            </a>
        </li>
    </ul>
</li>
<li class="{{ Request::is('settings*') ? 'active' : '' }} treeview">
    <a href="{!! route('admin.settings.index') !!}">
        <i class="fa fa-list"></i>
		<span>分享配置</span>
	</a>
</li>
@endauth

<li class="active treeview">
    <a href="{!! route('admin.scores.index') !!}">
        <i class="fa fa-list"></i>
        <span>积分管理</span>
    </a>
</li>
