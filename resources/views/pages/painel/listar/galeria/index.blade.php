@extends('base.painel.index')
@section('content')

  @component('pages.painel.listar.galeria.componentes.galeria', ["galerias_ativo" => $galerias_ativo, "galerias_excluido" => $galerias_excluido])
  @endcomponent

@endsection
