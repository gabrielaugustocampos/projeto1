@extends('base.painel.index')
@section('content')

  @component('pages.painel.cadastro.banner.componentes.cadastro_banner', ["banner" => $banner, "id" => $id])
  @endcomponent

@endsection
