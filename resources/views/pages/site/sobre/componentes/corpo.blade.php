<section class="s-about">
    <div class="container">
        <img class="about-effect-tringle" src="{{asset('assets_site/img/tringle-about-top.svg')}}" alt="img">
        <div class="row about-row">

        @foreach ($sobre as $item)

            @if ($item->categorias[0]->id == 6)

            <div class="col-md-5 about-img-col">
                <div class="about-img-cover">
                    <div class="about-img-1">
                        <img class="about-img-effect-1" src="{{asset('assets_site/img/square-yellow.svg')}}" alt="img">
                        <img class="about-img-effect-2" src="{{asset('assets_site/img/group-circle-2.svg')}}" alt="img">
                        <img style="max-width: 420px;" src="{{asset('imagens_paginas/'.$item->imagem)}}" alt="{{$item->titulo}}{{$item->descricao}}" title="{{$item->titulo}}{{$item->descricao}}">
                    </div>
                    <div class="about-img-2">

                    @foreach ($sobre as $item2)

                        @if ($item2->categorias[0]->id == 7)

                        <img style="max-width: 320px;" src="{{asset('imagens_paginas/'.$item2->imagem)}}" alt="{{$item->titulo}}{{$item->descricao}}" title="{{$item->titulo}}{{$item->descricao}}">
                    
                        @endif
    
                    @endforeach

                    </div>
                </div>
            </div>
            <div class="col-md-7 about-info-cover">
                <h2 class="title-decor">{{$item->titulo}}<span>{{$item->descricao}}</span></h2>
                <div class="text">
                    {!!$item->texto!!}
                </div>
                <ul class="about-cont">

                @foreach ($contato as $item)

                    @if ($item->categorias[0]->id == 12 && isset($item->categorias[1]->id) && $item->categorias[1]->id == 3)

                    <li><i class="{{str_replace(['far','fas','far','fab'], 'fa',$item->icones[0]->codigo_icone)}}" aria-hidden="true"></i><a href="{{$item->url}}" target="_blank">{{$item->descricao}}</a></li>

                    @endif
    
                @endforeach
                </ul>
                <ul class="social-list">
                    <li><a target="_blank" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a target="_blank" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a target="_blank" href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                    <li><a target="_blank" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
            </div>

            @endif
    
        @endforeach
            
        </div>
    </div>
</section>

<section class="s-about-bottom" style="margin-bottom: 8em;">
    <div class="container">
        <div class="row" style="justify-content: center;">

        @foreach ($sobre as $item)

            @if ($item->categorias[0]->id == 2)

            <div class="col-md-4">
                <div class="about-bottom-item">
                    <div class="date-cover">
                        <div class="date">{{$item->titulo}}</div>
                        <h4>{{$item->descricao}}</h4>
                    </div>
                    <div class="about-bottom-info">{!!strip_tags($item->texto)!!}</div>
                </div>
            </div>
        
            @endif
    
        @endforeach
            
        </div>
    </div>
</section>