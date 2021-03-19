<section class="s-club-cards club-cards-lite club-cards-fitness">
    <span class="section-title-bg"></span>
    <div class="container">

    @foreach ($cursos as $item)

        @if ($item->categorias[0]->id == 1)

        <h2 class="title-decor">{{$item->titulo}} <br><span>{{$item->descricao}}</span></h2>
        <p class="slogan">{!!strip_tags($item->descricao)!!}</p>

        @endif
    
    @endforeach

        <div class="row">

        @foreach ($cursos as $item)

            @if ($item->categorias[0]->id == 6)
                
            <div class="col-md-4 club-card-col" style="margin-bottom: 10px; margin-top: 10px;">
                <div style="width: 100%; height: 100%; background-image: url({{asset('imagens_paginas/'.$item->imagem)}}); background-size: 150%; background-position: center; background-repeat: no-repeat;">
                <div class="club-card-item" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.8);">
                    <div class="price-cover">

                        @if (isset($item->icones[0]->titulo))

                            <div class="price" style="color: #959595;"><span>R$</span>{{$item->icones[0]->titulo}}</div>
                            
                        @endif
                        
                        <div class="date"></div>
                    </div>
                    <div class="club-card-text" style="color: #fff;">{{$item->descricao}}</div>
                    <a href="curso_detalhado/{{$item->id_texto}}/{{preg_replace('/[^a-z]/', '',strtolower($item->titulo))}}" class="btn">+ informações</a>
                </div>
                </div>
            </div>

            @elseif (isset($item->categorias[1]->id) && $item->categorias[1]->id == 6)

            <div class="col-md-4 club-card-col" style="margin-bottom: 10px; margin-top: 10px;">
                <div style="width: 100%; height: 100%; background-image: url({{asset('imagens_paginas/'.$item->imagem)}}); background-size: 150%; background-position: center; background-repeat: no-repeat;">
                <div class="club-card-item" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.8);">
                    <div class="price-cover">

                        @if (isset($item->icones[0]->titulo))

                            <div class="price" style="color: #959595;"><span>R$</span>{{$item->icones[0]->titulo}}</div>
                            
                        @endif
                        
                        <div class="date"></div>
                    </div>
                    <div class="club-card-text" style="color: #fff;">{{$item->descricao}}</div>
                    <a href="curso_detalhado/{{$item->id_texto}}/{{preg_replace('/[^a-z]/', '',strtolower($item->titulo))}}" class="btn">+ informações</a>
                </div>
                </div>
            </div>
                            
            @endif
    
        @endforeach

        </div>
    </div>
</section>