@extends('base.painel.index')
@section('content')

  @component('pages.painel.listar.arquivos.componentes.arquivos', ["arquivos" => $arquivos])
  @endcomponent

@endsection
