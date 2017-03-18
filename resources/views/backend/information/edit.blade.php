@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Information
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($information, ['route' => ['admin.information.update', $information->id], 'method' => 'patch', 'files'=>true]) !!}

                        @include('backend.information.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
