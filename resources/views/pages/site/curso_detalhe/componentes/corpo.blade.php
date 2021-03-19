<section class="s-about" style="margin-bottom: 40px;">
    <div class="container">
        <img class="about-effect-tringle" src="{{asset('assets_site/img/tringle-about-top.svg')}}" alt="img">
        <div class="row about-row">
            <div class="col-md-5 about-img-col">
                <div class="about-img-cover">
                    <div class="about-img-1">
                        <img class="about-img-effect-1" src="{{asset('assets_site/img/square-yellow.svg')}}" alt="img">
                        <img class="about-img-effect-2" src="{{asset('assets_site/img/group-circle-2.svg')}}" alt="img">

                        <img style="max-width: 320px;" src="{{asset('imagens_paginas/'.$curso->imagem)}}" alt="{{$curso->descricao}}" title="{{$curso->descricao}}">
                        
                    </div>
                    <div class="about-img-2">

                    @foreach ($cursos as $item)

                        @if ($item->categorias[0]->id == 7)

                        <img style="max-width: 320px;" src="{{asset('imagens_paginas/'.$item->imagem)}}" alt="{{$curso->descricao}}" title="{{$curso->descricao}}">

                        @endif
                        
                    @endforeach

                    </div>
                </div>
            </div>
            <div class="col-md-7 about-info-cover">
                <h2 class="title-decor">{{$curso->titulo}} <span>{{$curso->descricao}}</span></h2>

                @if (isset($curso->icones[0]->titulo))

                    <h3>R$ <span style="color: #d63139;">{{$curso->icones[0]->titulo}}</span></h3>
    
                @endif

                <div class="text">
                    {!!$curso->texto!!}
                </div>
                <br>
                <a href="{{$curso->url}}" class="btn">Comprar curso</a>
                <br>
                <h3>Para informações</h3>
                <ul class="about-cont">

                @foreach ($contato as $item)

                    @if ($item->categorias[0]->id == 12 && isset($item->categorias[1]->id) && $item->categorias[1]->id == 3)

                    <li><i class="{{str_replace(['far','fas','far','fab'], 'fa',$item->icones[0]->codigo_icone)}}" aria-hidden="true"></i><a href="{{$item->url}}" target="_blank">{{$item->descricao}}</a></li>

                    @endif
    
                @endforeach

                </ul>
            </div>
        </div>
    </div>
</section>