@extends('base.site.index', ["rodape" => $rodape, "contato" => $contato])
@section('content')

    @component('base.site.componentes.navbar', ["menu" => $menu, "contato" => $contato])
    @endcomponent

    @component('pages.site.sobre.componentes.cabecalho', ["sobre" => $sobre])
    @endcomponent

    @component('pages.site.sobre.componentes.corpo', ["sobre" => $sobre, "contato" => $contato])
    @endcomponent

    @component('pages.site.sobre.componentes.depoimentos', ["depoimentos" => $depoimentos])
    @endcomponent
    
@endsection