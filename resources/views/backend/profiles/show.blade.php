@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            商户详情
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('backend.profiles.show_fields')
                    <a href="{!! route('admin.profiles.index') !!}" class="btn btn-default">Back</a>
                    <a href="{!! route('admin.profile.verify', ['profile_id'=>$profile->id, 'is_identity' => 2]) !!}" class="btn btn-default">
                        审核通过
                    </a>
                    <a href="{!! route('admin.profile.verify', ['profile_id'=>$profile->id, 'is_identity' => 3]) !!}" class="btn btn-danger">
                        审核拒绝
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
