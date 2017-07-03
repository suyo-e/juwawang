@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">配置管理</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" href="{!! route('admin.settings.create') !!}">添加配置</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('backend.settings.table')
            </div>
        </div>
    </div>
@endsection

