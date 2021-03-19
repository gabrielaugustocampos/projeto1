@extends('base.painel.index')
@section('content')

  @component('pages.painel.cadastro.fotos.componentes.cadastro_fotos', ["fotos_ativas" => $fotos_ativas, "id" => $id, "galeria" => $galeria])
  @endcomponent

@endsection
