@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Setting
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($setting, ['route' => ['admin.settings.update', $setting->id], 'method' => 'patch']) !!}

                        @include('backend.settings.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection