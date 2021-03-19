@extends('base.painel.index')
@section('content')

  @component('pages.painel.listar.segmentos.componentes.listar_segmentos', ["segmentos" => $segmentos])
  @endcomponent

@endsection
