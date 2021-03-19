<section class="s-fitness-gallery">
    <div class="section-title-bg"></div>
    <div class="container">

    @foreach ($galeria as $item)

        @if ($item->categorias[0]->id != 1)

        <h2 class="title-decor">{{$item->titulo}}<span>{{$item->descricao}}</span></h2>
        <p class="slogan"></p>
        <div class="row-gallery" style="margin-bottom: 25px;">
            <div class="grid-gallery">
                <div class="grid-sizer"></div>

                @for ($i = 0; $i < count($item->gallery); $i++)

                    @if (isset($item->gallery[$i]->imagem))

                    <div class="gallery-item">
                        <a href="{{asset('imagens_galerias/'.$item->gallery[$i]->imagem)}}" data-fancybox="gallery1">
                            <img src="{{asset('imagens_galerias/'.$item->gallery[$i]->imagem)}}" alt="{{$item->gallery[$i]->titulo}}" title="{{$item->gallery[$i]->titulo}}">
                            <div class="gal-item">
                                <h4 class="title">{{$item->gallery[$i]->titulo}}</h4>
                            </div>
                        </a>
                    </div>
                        
                    @endif

                @endfor

            </div>
        </div>
            
        @endif

    @endforeach

    </div>
</section>