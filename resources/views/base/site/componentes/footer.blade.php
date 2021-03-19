<footer class="footer-fitness">
    <div class="container">
        <div class="row">
            <div class="col-md-3 footer-item-logo">

            @foreach ($rodape as $item)

                @if ($item->categorias[0]->id == 6)

                <a href="/home" class="logo-footer"><img src="{{asset('imagens_paginas/'.$item->imagem)}}" alt="{{$item->descricao}}" title="{{$item->descricao}}"></a>
            
                @endif
            
            @endforeach
            
            </div>
            <div class="col-md-3 footer-item footer-item-link">
                <h3>Links</h3>
                <ul class="footer-link">
                    <li><a href="/home">Home</a></li>
                    <li><a href="/sobre">Sobre nós</a></li>
                    <li><a href="/cursos">Cursos</a></li>
                    <li><a href="/blog">Blog</a></li>
                    <li><a href="/nossa_galeria">Galeria</a></li>
                    <li><a href="/info_contato">Contato</a></li>
                </ul>
            </div>
            <div class="col-md-3 footer-item footer-item-link">

            @foreach ($rodape as $item)

                @if ($item->categorias[0]->id == 7)

                <h3>{{$item->titulo}}</h3>

                @endif
            
            @endforeach
            
                <ul class="footer-link-social">

                @foreach ($contato as $item)

                    @if ($item->categorias[0]->id == 11)

                        @for ($i = 0; $i < count($item->icones); $i++)

                        <li><a href="{{$item->icones[$i]->titulo}}" target="_blank"><i class="{{str_replace(['far','fas','far','fab'], 'fa',$item->icones[$i]->codigo_icone)}}" aria-hidden="true"></i></a></li>

                        @endfor

                    @endif
            
                @endforeach

                </ul>
            </div>
            <div class="col-md-3 footer-item footer-item-subscribe" id="newsletter">

            @foreach ($rodape as $item)

                @if ($item->categorias[0]->id == 2)

                <h3>{{$item->titulo}}</h3>
                <p>{{$item->descricao}}</p>

                @endif
            
            @endforeach

                @if (session('status'))
                <div class="alert alert-success">
                    <center>{{ session('status') }}</center>
                </div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger">
                    <center>{{ session('error') }}</center>
                </div>
                @endif

                <form action="{{route('newsletter.enviar')}}" method="POST">
                    @csrf
                    <div class="subscribe-form">
                        <input class="inp-form" type="email" name="email" placeholder="Informe seu e-mail aqui" style="border: 1px solid #d63139;">
                        <button type="submit" class="btn-form"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div><br>

                    <center>
                        {{--  <div id="RecaptchaField1" class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6LfN6mgaAAAAAMaUtpZo7ZZ6sc0WsGhKsDq532Vf" style="width: 100%"></div><br>  --}}
                        <div id="RecaptchaField1" class="g-recaptcha" data-sitekey="6LdyhV0aAAAAALv6AgSJnpVELPCu2dq6umHtwrPc" style="width: 100%"></div>
                    </center>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="copyright">

            @foreach ($rodape as $item)

                @if ($item->categorias[0]->id == 12)  
                
                {!!str_replace(["<p>", "</p>"] , "", $item->texto)!!}

                @endif
            
            @endforeach

            </div>
        </div>
    </div>
</footer>

@foreach ($contato as $item)

    @if ($item->categorias[0]->id == 6 && $item->categorias[1]->id == 12)  

    <a class="btn-whats" role="button" href="{{$item->url}}" target="_blank"><i class="fa fa-whatsapp" style="color: #d61503;font-size: 38px;width: 38px;height: 38px; display: flex; align-items: center; justify-content: center;"></i></a>

    @endif
            
@endforeach