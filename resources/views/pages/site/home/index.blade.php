@extends('base.site.index', ["rodape" => $rodape, "contato" => $contato])
@section('content')

    @component('base.site.componentes.navbar', ["menu" => $menu, "contato" => $contato])
    @endcomponent

    @component('pages.site.home.componentes.banner', ["banners_desk" => $banners_desk])
    @endcomponent

    @component('pages.site.home.componentes.sobre', ["sobre" => $sobre])
    @endcomponent

    @component('pages.site.home.componentes.cursos', ["cursos" => $cursos])
    @endcomponent

    @component('pages.site.home.componentes.depoimentos', ["depoimentos" => $depoimentos])
    @endcomponent

    @component('pages.site.home.componentes.blog', ["blog" => $blog])
    @endcomponent

    @component('pages.site.home.componentes.galeria', ["galeria" => $galeria])
    @endcomponent

@endsection