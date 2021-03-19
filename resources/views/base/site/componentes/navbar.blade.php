<header class="header-fitness">
    <a href="#" class="nav-btn">
        <span></span>
        <span></span>
        <span></span>
    </a>
    <div class="top-panel">
        <div class="container">
            <div class="row top-panel-row">
                <div class="col-sm-4 top-panel-left">
                    <ul class="header-cont">
                        
                    </ul>
                </div>
                <div class="col-sm-4 top-panel-center">
                    <ul class="header-cont">
                        
                    </ul>
                </div>
                <div class="col-sm-4 top-panel-right">
                    <ul class="header-cont">

                    @foreach ($contato as $item)

                        @if ($item->categorias[0]->id == 11)

                            @for ($i = 0; $i < count($item->icones); $i++)

                            <li><a href="{{$item->icones[$i]->titulo}}" target="_blank"><i class="{{str_replace(['far','fas','far','fab'], 'fa',$item->icones[$i]->codigo_icone)}}" aria-hidden="true"></i></a></li>

                            @endfor

                        @elseif ($item->categorias[0]->id == 12 && isset($item->categorias[1]->id) && $item->categorias[1]->id == 3)
                        
                        <li><a href="{{$item->url}}" target="_blank"><i class="{{str_replace(['far','fas','far','fab'], 'fa',$item->icones[0]->codigo_icone)}}" aria-hidden="true"></i></a></li>

                        @endif
            
                    @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header-menu">
        <div class="container">
            <div class="header-logo">

            @foreach ($menu as $item)

                @if ($item->categorias[0]->id == 6)

                <a href="/home" class="logo"><img style="width: 200px;" src="{{asset('imagens_paginas/'.$item->imagem)}}" alt="{{$item->descricao}}" title="{{$item->descricao}}"></a>
            
                @endif
            
            @endforeach
            
            </div>
            <nav class="nav-menu">
                <ul class="nav-list">
                    <li><a href="/home">Home</a></li>
                    <li><a href="/sobre">Sobre nós</a></li>
                    <li><a href="/cursos">Cursos</a></li>
                    <li><a href="/blog">Blog</a></li>
                    <li><a href="/nossa_galeria">Galeria</a></li>
                    <li><a href="/info_contatos">Contato</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>