@extends('base.painel.index')
@section('content')

      @component('pages.painel.cadastro.segmentos.componentes.cadastro', ["videos" => $videos, "cases" => $cases])
      @endcomponent

@endsection
