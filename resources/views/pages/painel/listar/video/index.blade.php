@extends('base.painel.index')
@section('content')

  @component('pages.painel.listar.video.componentes.videos', ["videos_ativos" => $videos_ativos, "videos_excluidos" => $videos_excluidos])
  @endcomponent

@endsection
