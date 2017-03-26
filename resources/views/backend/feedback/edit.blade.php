@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            反馈修改
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($feedback, ['route' => ['admin.feedback.update', $feedback->id], 'method' => 'patch']) !!}

                        @include('backend.feedback.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
