@foreach ($depoimentos as $item)

@if ($item->categorias[0]->id == 1)

<section class="s-testimonials testimonials-border s-fitness-testimonials" style="background-image: url({{asset('imagens_paginas/'.$item->imagem)}});">
    
@endif
        
@endforeach

    <div class="mask"></div>
    <img class="testimonials-effect" src="{{asset('assets_site/img/bg-testi-2.svg')}}" alt="effect">
    <div class="container">
        <div class="testimonials-slider">

        @foreach ($depoimentos as $item)

            @if ($item->categorias[0]->id == 6)

            <div class="testimonial-slide">
                <img src="{{asset('imagens_paginas/'.$item->imagem)}}" alt="{{$item->titulo}}" title="{{$item->titulo}}">
                <h3 class="name">{{$item->titulo}}</h3>
                {!!$item->texto!!}
            </div>

            @endif
        
        @endforeach

        </div>
    </div>
</section>