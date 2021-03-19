@extends('base.site.index', ["rodape" => $rodape, "contato" => $contato])
@section('content')

    @component('base.site.componentes.navbar', ["menu" => $menu, "contato" => $contato])
    @endcomponent

    @component('pages.site.curso_detalhe.componentes.cabecalho', ["curso" => $curso, "cursos" => $cursos])
    @endcomponent

    @component('pages.site.curso_detalhe.componentes.corpo', ["curso" => $curso, "cursos" => $cursos, "contato" => $contato])
    @endcomponent
    
@endsection