@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            商家推荐
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'admin.banners.store', 'files' => true]) !!}

                    <input type="hidden" name="display_name" value="{{ $category_ids }}" />
                    <input type="hidden" name="type" value="4" />

                    <!-- Url Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('url', '商家ID:') !!}
                        {!! Form::text('url', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Pic Url Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('pic_url', '商家图片:') !!}
                        {!! Form::file('pic_url') !!}
                    </div>

                    <!-- Description Field -->
                    <div class="form-group col-sm-12 col-lg-12">
                        {!! Form::label('description', '描述:') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Submit Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
                        <a href="{!! route('admin.banners.index') !!}" class="btn btn-default">取消</a>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
