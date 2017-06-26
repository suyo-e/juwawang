@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management'))

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@endsection

@section('page-header')
    <h1>
<!--
        {{ trans('labels.backend.access.users.management') }}
        <small>{{ trans('labels.backend.access.users.active') }}</small>
-->
        用户管理
    </h1>
@endsection

@section('content')
    <div class="box box-success">


        <div class="box-body">
            <div class="table-responsive">
                <table id="users-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>用户id</th>
                            <th>用户名</th>
                            <th>手机号码</th>
                            <th>用户头像</th>
                            <th>地区</th>
                            <th>是否激活</th>
                            <th>类型</th>
                            <th>邀请码</th>
                            <th>Coin</th>
                            <th>创建时间</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->

    @if (false)
    @permissions(['manage-roles'])
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {!! history()->renderType('User') !!}
        </div><!-- /.box-body -->
    </div><!--box box-success-->
    @endauth
    @endif
@endsection

@section('after-scripts')
    {{ Html::script("js/backend/plugin/datatables/jquery.dataTables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables.bootstrap.min.js") }}

    <script>
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.access.user.get") }}',
                    type: 'post',
                    data: {status: 1, trashed: false}
                },
                columns: [
                    {data: 'id', name: '{{config('access.users_table')}}.id'},
                    {data: 'name', name: '{{config('access.users_table')}}.name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'avatar', name: 'avatar', sortable: false},
                    {data: 'province_city_name', name: 'province_city_name', sortable: false},
                    //{data: 'email', name: '{{config('access.users_table')}}.email'},
                    {data: 'confirmed', name: '{{config('access.users_table')}}.confirmed'},
                    //{data: 'roles', name: '{{config('access.roles_table')}}.name', sortable: false},
                    {data: 'type', name: 'type', sortable: false},
                    {data: 'invite_code', name: '邀请码', sortable: false},
                    {data: 'amount', name: 'coin', sortable: false},
                    {data: 'created_at', name: '{{config('access.users_table')}}.created_at'},
                    //{data: 'updated_at', name: '{{config('access.users_table')}}.updated_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
        });
    </script>
@endsection
