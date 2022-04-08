@extends('adminlte::page')

@section('title','Lecturas')

@section('content_header')
    <h1> Lecturas de los Metrocontadores</h1>
@stop

@section('css')
    <script src="{{asset('/vendor/cdn/taildwind.css')}}"></script>
    <link rel="stylesheet" href="{{asset('/vendor/bootstrap/js/bootstrap.min.js')}}">
    <link rel="stylesheet" href="path/to/font-awesome5.min.css" type="text/css" />
@endsection


@section('content')
    <div class="card-body">
        @livewire('live-lecturas')
    </div>
@stop

@section('js')
<script>
    $(document).ready(function(){
        $("#modal").on('shown.bs.modal', function(){
            $(this).find('#lectura').focus();
        });
    });
</script>

<script> {{-- Este Script elimina el envio del formulario por el ENTER --}}
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('input[type=text]').forEach( node => node.addEventListener('keypress', e => {
        if(e.keyCode == 13)
        {
            e.preventDefault();
        }
      }))
    });
</script>

<script>
    window.livewire.on('Pon-Foco-Input-Lectura', function () {
         $("#lectura").focus();
     });
 </script>

 <script>
     window.livewire.on('Pon-Foco-Boton', function () {
         $("#guardar").focus();
     });
 </script>
@endsection
