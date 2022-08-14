@extends('adminlte::page')

@section('title','Planes')

@section('content_header')
    <h1> Planes de los Metrocontadores</h1>
@stop

@section('css')
    <script src="{{asset('/vendor/cdn/taildwind.css')}}"></script>
    <link rel="stylesheet" href="{{asset('/vendor/bootstrap/js/bootstrap.min.js')}}">
    <link rel="stylesheet" href="path/to/font-awesome5.min.css" type="text/css" />
@endsection


@section('content')
    <div class="card-body">
        @livewire('live-planes')
    </div>
@stop

@section('js')

@endsection
