@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            资料编辑
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($profile, ['route' => ['admin.profiles.update', $profile->id], 'method' => 'patch']) !!}

                        @include('backend.profiles.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
