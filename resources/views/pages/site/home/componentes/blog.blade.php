<section class="s-fitness-posts">
    <div class="section-title-bg"></div>
    <div class="container">

    @foreach ($blog as $item)

        @if ($item->categorias[0]->id == 1)

        <h2 class="title-decor">{{$item->titulo}} <span>{{$item->descricao}}</span></h2>
        <p class="slogan">{!!strip_tags($item->texto)!!}</p>

        @endif
        
    @endforeach

        <div class="row" style="margin-bottom: 25px;">

        @foreach ($blog as $item)

            @if ($item->categorias[0]->id == 6)

            <div class="col-md-4 fitness-post-col">
                <div class="post-item-cover">
                    <div class="post-header" style="background-image: url({{asset('imagens_paginas/'.$item->imagem)}});">
                        <div class="date" style="background-color: rgba(0, 0, 0, 0.8); width: 100%; height: 140px; display: flex; align-items: center; justify-content: center;">{{ \Carbon\Carbon::parse($item->created_at)->formatLocalized('%B, %Y')}}</div>
                    </div>
                    <div class="post-content" style="min-height: 240px;">
                        <h4 class="title"><a href="single-blog.html">{{$item->titulo}}</a></h4>
                        <div class="text">

                            @if (!empty($item->descricao))
                            
                            <p>{{$item->descricao}}</p>

                            @else

                            {!!mb_strimwidth($item->texto, 0, 255, "...");!!}

                            @endif

                            
                        </div>
                    </div>
                    <div class="post-footer">
                        <div class="meta">
                            <div class="col-md-5">
                                <span class="post-category"><i class="fa fa-tag" aria-hidden="true"></i>

                                @for ($i = 0; $i < count($item->categorias); $i++)

                                    @if ($item->categorias[$i]->id != 6)

                                    <a href="/blog_filtro/{{$item->categorias[$i]->id}}/2}}">{{$item->categorias[$i]->nome}}</a>

                                    @endif

                                @endfor

                                </span>
                            </div>
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-5">
                                <span class="post-tags"><i class="fa fa-hashtag" aria-hidden="true"></i>

                                @for ($i = 0; $i < count($item->icones); $i++)

                                <a href="/blog_filtro/{{$item->icones[$i]->titulo}}/3">{{$item->icones[$i]->titulo}}</a>

                                @endfor

                                </span>
                            </div>
                        </div>
                        <a href="blog_detalhado/{{$item->id_texto}}/{{preg_replace('/[^a-z]/', '',strtolower($item->titulo))}}" class="btn"><span>+ informações</span></a>
                    </div>
                </div>
            </div>

            @endif
        
        @endforeach

        </div>
        <div style="display: flex; align-items: center; justify-content: center;">
            <a href="/blog" class="btn">Ver todos os artigos</a>
        </div>
    </div>
</section>