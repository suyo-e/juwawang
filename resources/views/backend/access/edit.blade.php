@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.access.users.management') }}
        <small>{{ trans('labels.backend.access.users.edit') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($user, ['route' => ['admin.access.user.update', $user], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.access.users.edit') }}</h3>
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('name', trans('validation.attributes.backend.access.users.name'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.users.name')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                @if ($profile) 
                <div class="form-group">
                    {{ Form::label('avatar', '用户头像', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        <input id="upload-file" type="file" name="avatar_file" class="upload-file" />
                        <img id="avatar_img" src="{{ $profile->avatar }}" height="100"/>
                        {!! Form::text('avatar', $profile->avatar, ['class'=>'hidden', 'id'=>'avatar_input' ]) !!}
                    </div><!--col-lg-10-->
                </div>
                <div class="form-group">
                    {{ Form::label('type', '用户类型', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {!! Form::select('type', ['1' => '厂商', '2' => '经销商', '3' => '用户'], $profile->type, ['class' => 'form-control']) !!}
                    </div><!--col-lg-10-->
                </div>
                <div class="form-group">
                    {{ Form::label('phone', '手机号码', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {!! Form::text('phone', null, ['class'=>'form-control']) !!}
                    </div><!--col-lg-10-->
                </div>
                <div class="form-group">
                    {{ Form::label('invite_code', '邀请码', ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {!! Form::text('invite_code', $profile->invite_code, ['class'=>'form-control', 'disabled'=>true]) !!}
                    </div><!--col-lg-10-->
                </div>
                @endif

                <div class="form-group hidden">
                    {{ Form::label('email', trans('validation.attributes.backend.access.users.email'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.users.email')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                
                @if ($user->id != 1)
                    <div class="form-group hidden">
                        {{ Form::label('status', trans('validation.attributes.backend.access.users.active'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-1">
                            {{ Form::checkbox('status', '1', $user->status == 1) }}
                        </div><!--col-lg-1-->
                    </div><!--form control-->

                    <div class="form-group hidden">
                        {{ Form::label('confirmed', trans('validation.attributes.backend.access.users.confirmed'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-1">
                            {{ Form::checkbox('confirmed', '1', $user->confirmed == 1) }}
                        </div><!--col-lg-1-->
                    </div><!--form control-->

                    <div class="form-group hidden">
                        {{ Form::label('status', trans('validation.attributes.backend.access.users.associated_roles'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-3">
                            @if (count($roles) > 0)
                                @foreach($roles as $role)
                                    <input type="checkbox" value="{{$role->id}}" name="assignees_roles[{{ $role->id }}]" {{ is_array(old('assignees_roles')) ? (in_array($role->id, old('assignees_roles')) ? 'checked' : '') : (in_array($role->id, $user_roles) ? 'checked' : '') }} id="role-{{$role->id}}" /> <label for="role-{{$role->id}}">{{ $role->name }}</label>
                                        <a href="#" data-role="role_{{$role->id}}" class="show-permissions small">
                                            (
                                                <span class="show-text">{{ trans('labels.general.show') }}</span>
                                                <span class="hide-text hidden">{{ trans('labels.general.hide') }}</span>
                                                {{ trans('labels.backend.access.users.permissions') }}
                                            )
                                        </a>
                                    <br/>
                                    <div class="permission-list hidden" data-role="role_{{$role->id}}">
                                        @if ($role->all)
                                            {{ trans('labels.backend.access.users.all_permissions') }}<br/><br/>
                                        @else
                                            @if (count($role->permissions) > 0)
                                                <blockquote class="small">{{--
                                            --}}@foreach ($role->permissions as $perm){{--
                                            --}}{{$perm->display_name}}<br/>
                                                    @endforeach
                                                </blockquote>
                                            @else
                                                {{ trans('labels.backend.access.users.no_permissions') }}<br/><br/>
                                            @endif
                                        @endif
                                    </div><!--permission list-->
                                @endforeach
                            @else
                                {{ trans('labels.backend.access.users.no_roles') }}
                            @endif
                        </div><!--col-lg-3-->
                    </div><!--form control-->
                @endif
            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.access.user.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-success btn-xs']) }}
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->

        @if ($user->id == 1)
            {{ Form::hidden('status', 1) }}
            {{ Form::hidden('confirmed', 1) }}
            {{ Form::hidden('assignees_roles[]', 1) }}
        @endif

    {{ Form::close() }}
@endsection

@section('after-scripts')
    {{ Html::script('js/backend/access/users/script.js') }}
@endsection

@section('scripts')
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
<script type="text/javascript" src="/js/city-picker.min.js" charset="utf-8"></script>
<script src="/js/jquery.ui.widget.js"></script>
<script src="/js/jquery.iframe-transport.js"></script>
<script src="/js/jquery.fileupload.js"></script>
<script>
$(function() {
    $('#upload-file').fileupload({
        url: '/upload',
        dataType: 'json',
        done: function (e, data) {
            var path = data.result.data.path;
            $("#avatar_input").val(path);
            $("#avatar_img").attr('src', path);
        }
    });
});

</script>
@endsection


