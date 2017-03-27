@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">
           <a class="btn btn-primary" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('admin.icons.index', ['type'=>3]) !!}">普通用户</a>
           <a class="btn btn-primary" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('admin.icons.index', ['type'=>2]) !!}">代理商</a>
           <a class="btn btn-primary" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('admin.icons.index', ['type'=>1]) !!}">厂商</a>
        </h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('admin.icons.create') !!}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('backend.icons.table')
            </div>
        </div>
    </div>
@endsection

