@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            商品编辑
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($product, ['route' => ['admin.products.update', $product->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('backend.products.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
