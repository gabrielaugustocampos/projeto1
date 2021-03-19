@foreach ($sobre as $item)

    @if ($item->categorias[0]->id == 1)

    <section class="s-header-title" style="background-image: url({{asset('imagens_paginas/'.$item->imagem)}});">
        <div class="container">
            <h1 class="title" style="color: #fff;">{{$item->titulo}}</h1>
            <ul class="breadcrambs">
                <li style="color: #fff;"><a style="color: #fff;" href="/home">Home</a></li>
                <li style="color: #fff;">{{$item->titulo}}</li>
            </ul>
        </div>
    </section>

    @endif
    
@endforeach

