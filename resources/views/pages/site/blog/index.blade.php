@extends('base.site.index', ["rodape" => $rodape, "contato" => $contato])
@section('content')

    @component('base.site.componentes.navbar', ["menu" => $menu, "contato" => $contato])
    @endcomponent

    @component('pages.site.blog.componentes.cabecalho', ["blog" => $blog])
    @endcomponent

    @component('pages.site.blog.componentes.corpo', ["blog" => $blog, "blog_recente" => $blog_recente, "blogs" => $blogs, "meses" => $meses, "categorias" => $categorias])
    @endcomponent
    
@endsection