<section class="s-club-cards club-cards-lite club-cards-fitness">
    <span class="section-title-bg"></span>
    <div class="container">

    @foreach ($cursos as $item)

        @if ($item->categorias[0]->id == 1)

        <h2 class="title-decor">{{$item->titulo}} <span>{{$item->descricao}}</span></h2>
        <p class="slogan">{!!strip_tags($item->texto)!!}</p>

        @endif
            
    @endforeach

        <div class="row" style=" margin-bottom: 25px;">

        @foreach ($cursos as $item)

            @if ($item->categorias[0]->id == 3 && $item->categorias[1]->id == 6)

            <div class="col-md-4 club-card-col">
                <div style="width: 100%; height: 100%; background-image: url({{asset('imagens_paginas/'.$item->imagem)}}); background-size: 150%; background-position: center; background-repeat: no-repeat;">
                <div class="club-card-item" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.8);">
                    <div class="price-cover">
                        <div class="price" style="color: #959595;"><span>{{$item->icones[0]->titulo}}</span>{!!strip_tags($item->icones[0]->descricao)!!}</div>
                        <div class="date"></div>
                    </div>
                    <div class="club-card-text" style="color: #fff;">{{$item->descricao}}</div>
                    <a href="curso_detalhado/{{$item->id_texto}}/{{preg_replace('/[^a-z]/', '',strtolower($item->descricao))}}" class="btn">+ informações</a>
                </div>
                </div>
            </div>

            @endif
            
        @endforeach

        </div>
        <div style="display: flex; align-items: center; justify-content: center;">
            <a href="/cursos" class="btn">Ver todos os cursos</a>
        </div>
    </div>
</section>