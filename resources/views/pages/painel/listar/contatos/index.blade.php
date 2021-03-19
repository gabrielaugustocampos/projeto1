@extends('base.painel.index')
@section('content')

  @component('pages.painel.listar.contatos.componentes.contatos', ["contatos" => $contatos])
  @endcomponent

@endsection
