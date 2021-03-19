<section class="s-welcome-fitness" style="margin-top: 20px;">
    <div class="container">
        <div class="welcome-fitness-row">

        @foreach ($sobre as $item)

            @if ($item->categorias[0]->id == 5)

            <div class="welcome-fitness-img">
                <img class="rx-lazy" src="{{asset('imagens_paginas/'.$item->imagem)}}" data-src="{{asset('imagens_paginas/'.$item->imagem)}}" alt="{{$item->titulo}} {{$item->descricao}}" title="{{$item->titulo}} {{$item->descricao}}">
            </div>

            <div class="welcome-fitness-item">
                <div class="welcome-fitness-info">
                    <h2 class="title-decor">{{$item->titulo}}<span>{{$item->descricao}}</span></h2>
                    {!!$item->texto!!}
                    <a href="/sobre" class="btn">Saiba mais</a>
                </div>               
            </div>

            @endif
            
        @endforeach

        </div>
    </div>
</section>