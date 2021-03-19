@extends('base.site.index', ["rodape" => $rodape, "contato" => $contato])
@section('content')

    @component('base.site.componentes.navbar', ["menu" => $menu, "contato" => $contato])
    @endcomponent

    @component('pages.site.cursos.componentes.cabecalho', ["cursos" => $cursos])
    @endcomponent

    @component('pages.site.cursos.componentes.corpo', ["cursos" => $cursos])
    @endcomponent
    
@endsection