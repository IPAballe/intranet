@extends('adminlte::page')

@section('title','Consumo')

@section('content_header')
    <h1> Consumo</h1>
@stop

@section('css')
    <script src="{{asset('/vendor/cdn/taildwind.css')}}"></script>
@endsection


@section('content')
 <div class="content">
     @livewire('live-consumos')
 </div>
@stop

@section('js')

    </script>

@endsection
