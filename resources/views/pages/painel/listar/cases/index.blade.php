@extends('base.painel.index')
@section('content')

  @component('pages.painel.listar.cases.componentes.cases', ["cases_ativas" => $cases_ativas, "cases_excluidas" => $cases_excluidas])
  @endcomponent

@endsection
