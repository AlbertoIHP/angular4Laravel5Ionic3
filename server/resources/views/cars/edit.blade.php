@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Car
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($car, ['route' => ['cars.update', $car->id], 'method' => 'patch']) !!}

                        @include('cars.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection