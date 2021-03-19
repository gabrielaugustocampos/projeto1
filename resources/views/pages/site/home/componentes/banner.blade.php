<section class="s-fitness-slider">
    <div class="slider-navigation">
        <div class="container">
            <div class="slider-navigation-cover"></div>
        </div>
    </div>
    <div class="fitness-slider">

        @foreach ($banners_desk as $item)

        <div class="fitness-slide" style="background-image: url({{asset('imagens_banner/'.$item->imagem)}}); background-size: cover;">
            <div class="fitness-slider-effect">
                <div data-hover-only="true" class="scene">
                    <span class="scene-item" data-depth="0.4" style="background-image: url({{asset('imagens_banner/'.$item->imagem)}}); background-size: cover;"></span>
                </div>
            </div>
            <div class="slide-img-cover" style="background-color: rgba(0, 0, 0, 0.7);">
                <div data-hover-only="true" class="scene">
                    
                </div>
            </div>
            <div class="container">
                
                <div class="text-bg"></div>
                <div class="fitness-slide-cover">
                    <h2 class="title" style="color: #fff;">{{$item->titulo}}</h2>
                </div>
            </div>
        </div>
            
        @endforeach

    </div>
</section>