<section class="s-news">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-9 blog-cover">

            @foreach ($blogs as $item)

            <div class="post-item-cover">
                <div class="post-header">
                    <div class="post-thumbnail">
                        <a href="blog_detalhado/{{$item->id_texto}}/{{preg_replace('/[^a-z]/', '',strtolower($item->titulo))}}">
                            <img src="{{asset('imagens_paginas/'.$item->imagem)}}" alt="{{$item->titulo}}" title="{{$item->titulo}}">
                        </a>
                    </div>
                </div>
                <div class="post-content">
                    <div class="meta">
                        <span class="post-date"><i class="fa fa-calendar" aria-hidden="true"></i>{{ \Carbon\Carbon::parse($item->created_at)->formatLocalized('%d de %B de %Y')}}</span>
                        <span class="post-category">
                            <i class="fa fa-tag" aria-hidden="true"></i>
                            @for ($i = 0; $i < count($item->categorias); $i++)

                                @if ($item->categorias[$i]->id != 6)

                                <a href="/blog_filtro/{{$item->categorias[$i]->id}}/2}}">{{$item->categorias[$i]->nome}}</a>

                                @endif

                            @endfor
                        </span>
                    </div>
                    <h2 class="title"><a href="/blog_detalhado/{{$item->id_texto}}/{{preg_replace('/[^a-z]/', '',strtolower($item->titulo))}}">{{$item->titulo}}</a></h2>
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
                        <span class="post-tags"><i class="fa fa-hashtag" aria-hidden="true"></i>

                            @for ($i = 0; $i < count($item->icones); $i++)

                            <a href="/blog_filtro/{{$item->icones[$i]->titulo}}/3">{{$item->icones[$i]->titulo}}</a>

                            @endfor

                        </span>                       
                    </div>
                    <a href="/blog_detalhado/{{$item->id_texto}}/{{preg_replace('/[^a-z]/', '',strtolower($item->titulo))}}" class="btn"><span>Leia mais</span></a>
                </div>
            </div>

            @endforeach

                <div class="paginacao">
                    {!! $blogs->links() !!}
                </div>
            </div>
            <div class="col-12 col-lg-3 sidebar">
                <a href="#" class="btn btn-sidebar"><span>Widgets</span></a>
                <ul class="widgets">
                    <li class="widget widget-search">
                        <h3 class="title">Pesquisa</h3>
                        <form class="search-form" action="/blog_filtro/palavra_chave/4" method="POST">
                            @csrf
                            <input class="inp-form" type="text" name="palavra" placeholder="Palavra-chave">
                            <button type="submit" class="btn-form"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>
                    </li>
                    <li class="widget widget-archive">
                        <h3 class="title">Mês da publicação</h3>
                        <ul>

                            @foreach ($meses as $item)

                            <li><a href="/blog_filtro/{{ \Carbon\Carbon::parse($item->created_at)->formatLocalized('%Y-%m')}}/1">{{ \Carbon\Carbon::parse($item->created_at)->formatLocalized('%B de %Y')}}</a></li>
                                
                            @endforeach

                        </ul>
                    </li>
                    <li class="widget widget-categories">
                        <h3 class="title">Categorias</h3>
                        <ul>

                            @foreach ($categorias as $item)

                            <li><a href="/blog_filtro/{{$item->id_categoria}}/2">{{$item->nome}}</a></li>
                                
                            @endforeach

                        </ul>
                    </li>
                    <li class="widget widget-recent-posts">
                        <h3 class="title">Artigos recentes</h3>
                        <ul>

                            @foreach ($blog_recente as $item)

                            <li>
                                <a href="/blog_detalhado/{{$item->id_texto}}/{{preg_replace('/[^a-z]/', '',strtolower($item->titulo))}}">{{$item->titulo}}</a>
                                <div class="date"><i class="fa fa-calendar" aria-hidden="true"></i>{{ \Carbon\Carbon::parse($item->created_at)->formatLocalized('%d de %B de %Y')}}</div>
                            </li>
                                
                            @endforeach

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>