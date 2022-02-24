@extends('adminlte::page')

@section('title','Metros')

@section('content_header')
    <h1> Metrocontadores</h1>
@stop

@section('css')
    <script src="{{asset('/vendor/cdn/taildwind.css')}}"></script>
@endsection


@section('content')
 <div class="content">
     @livewire('live-metros')
 </div>
@stop

@section('js')

    </script>

@endsection
