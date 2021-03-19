@extends('base.painel.index')
@section('content')

  @component('pages.painel.listar.banner.componentes.banner', ["banners_excluidos" => $banners_excluidos, "banners_ativos" => $banners_ativos])
  @endcomponent

@endsection
