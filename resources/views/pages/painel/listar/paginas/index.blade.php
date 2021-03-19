@extends('base.painel.index')
@section('content')

  @component('pages.painel.listar.paginas.componentes.listar_paginas', ["localizacao" => $localizacao, "paginas" => $paginas])
  @endcomponent

  @component('pages.painel.listar.paginas.componentes.modal_cadastro_localizacao')
  @endcomponent

@endsection
