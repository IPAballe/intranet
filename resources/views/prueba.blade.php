@extends('adminlte::page')

@section('title','Prueba')

@section('content_header')
    <h1> Prueba</h1>
@stop


@section('content')
  <div>
    @livewire('employee-list');
  </div>



@stop
