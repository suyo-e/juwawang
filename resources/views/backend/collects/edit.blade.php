@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Collect
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($collect, ['route' => ['admin.collects.update', $collect->id], 'method' => 'patch']) !!}

                        @include('backend.collects.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
