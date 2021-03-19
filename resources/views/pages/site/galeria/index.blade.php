@extends('base.site.index', ["rodape" => $rodape, "contato" => $contato])
@section('content')

    @component('base.site.componentes.navbar', ["menu" => $menu, "contato" => $contato])
    @endcomponent

    @component('pages.site.galeria.componentes.cabecalho', ["galeria" => $galeria])
    @endcomponent

    @component('pages.site.galeria.componentes.corpo', ["galeria" => $galeria])
    @endcomponent
    
@endsection