@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Industry
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($industry, ['route' => ['admin.industries.update', $industry->id], 'method' => 'patch']) !!}

                        @include('backend.industries.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
