@extends('base.painel.index')
@section('content')

  @if (isset($pagina))
    @if (isset($id))

      @component('pages.painel.cadastro.paginas.componentes.cadastro_pagina', ["localizacao" => $localizacao, "localizacao_galeria" => $localizacao_galeria, "pagina" => $pagina, "id" => $id, "icones" => $icones, "cat_sem_selecionar" => $cat_sem_selecionar])
      @endcomponent

    @else

      @component('pages.painel.cadastro.paginas.componentes.cadastro_pagina', ["localizacao" => $localizacao, "localizacao_galeria" => $localizacao_galeria, "pagina" => $pagina, "cat_sem_selecionar" => $cat_sem_selecionar])
      @endcomponent

    @endif

  @else

    @component('pages.painel.cadastro.paginas.componentes.cadastro_pagina', ["localizacao" => $localizacao, "localizacao_galeria" => $localizacao_galeria, 'categorias' => $categorias])
    @endcomponent

  @endif

@endsection
