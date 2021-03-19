@foreach ($cursos as $item)

    @if ($item->categorias[0]->id == 1)

    <section class="s-header-title" style="background-image: url({{asset('imagens_paginas/'.$item->imagem)}});">
        <div class="container">
            <h1 class="title" style="color: #fff;">{{$curso->descricao}}</h1>
            <ul class="breadcrambs" style="color: #fff;">
                <li style="color: #fff;"><a style="color: #fff;" href="/home">Home</a></li>
                <li><a style="color: #fff;" href="/cursos">Cursos</a></li>
                <li>Sobre o Curso</li>
            </ul>
        </div>
    </section>

    @endif
    
@endforeach

