@extends('base.site.index', ["rodape" => $rodape, "contato" => $contato])
@section('content')

    @component('base.site.componentes.navbar', ["menu" => $menu, "contato" => $contato])
    @endcomponent

    @component('pages.site.contato.componentes.cabecalho', ["contato" => $contato])
    @endcomponent

    @component('pages.site.contato.componentes.corpo', ["contato" => $contato])
    @endcomponent
    
@endsection