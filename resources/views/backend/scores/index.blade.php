@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">用户积分详情</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" href="{!! route('admin.scores.create') !!}">添加积分</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('backend.scores.table')
            </div>
        </div>
    </div>
@endsection

