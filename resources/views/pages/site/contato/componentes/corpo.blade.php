<section class="s-map">

    @foreach ($contato as $item)

        @if ($item->categorias[0]->id == 12 && $item->categorias[1]->id == 6)

        {!!str_replace('width="600"', 'width="100%"', $item->texto)!!}

        @endif
    
    @endforeach
    

</section>

<section class="s-contacts" style="background-image: url({{asset('assets_site/img/bg-contacts.svg')}});" id="contato">
    <div class="container">

    @foreach ($contato as $item)

        @if ($item->categorias[0]->id == 2)

        <h2 class="title-decor">{{$item->titulo}}<span>{{$item->descricao}}</span></h2>
        <p class="slogan">{!!strip_tags($item->texto)!!}</p>

        @endif
    
    @endforeach
       
        <div class="row">
            <div class="col-md-5 col-lg-4">
                <div class="contact-item">
                    <div class="contact-item-left">
                        <img src="{{asset('assets_site/img/icon-1.svg')}}" alt="img">
                        <h4>Telefone</h4>
                    </div>
                    <div class="contact-item-right">
                        <ul class="contact-item-list">

                        @foreach ($contato as $item)

                            @if ($item->categorias[0]->id == 12 && isset($item->categorias[2]->id) && $item->categorias[2]->id == 22)

                            <li><a href="{{$item->url}}">{{$item->descricao}}</a></li>

                            @endif
    
                        @endforeach

                        </ul>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-item-left">
                        <img src="{{asset('assets_site/img/icon-2.svg')}}" alt="img">
                        <h4>E-mail</h4>
                    </div>
                    <div class="contact-item-right">
                        <ul class="contact-item-list">
                            
                        @foreach ($contato as $item)

                            @if ($item->categorias[0]->id == 12 && isset($item->categorias[2]->id) && $item->categorias[2]->id == 23)

                            <li><a href="{{$item->url}}">{{$item->descricao}}</a></li>

                            @endif
    
                        @endforeach

                        </ul>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-item-left">
                        <img src="{{asset('assets_site/img/icon-3.svg')}}" alt="img">
                        <h4>Endereço</h4>
                    </div>
                    <div class="contact-item-right">
                        <ul class="contact-item-list">

                        @foreach ($contato as $item)

                            @if ($item->categorias[0]->id == 12 && $item->categorias[1]->id == 6)

                            <li><a href="{{$item->url}}">{{$item->descricao}}</a></li>

                            @endif
    
                        @endforeach

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-lg-8">
               
                @if (session('error_contato'))
                <div class="alert alert-danger">
                    <center>{{ session('error_contato') }}</center>
                </div>
                @endif
                @if (session('status_contato'))
                <div class="alert alert-success">
                    <center>{{ session('status_contato') }}</center>
                </div>

                @endif

                <form action="{{route('contatos.enviar')}}" method="POST">
                    @csrf
                    <ul class="form-cover">

                        @if (isset($_COOKIE['nome']))

                        <li class="inp-name">
                            <label>Nome *</label>
                            <input id="nome" required="" type="text" name="nome" value="{{$_COOKIE['nome']}}">
                        </li>
                        <li class="inp-email">
                            <label>E-mail *</label>
                            <input id="email" required="" type="email" name="email" value="{{$_COOKIE['email']}}">
                        </li>
                        <li class="inp-email">
                            <label>Telefone *</label>
                            <input id="telefone" required="" type="text" name="telefone" value="{{$_COOKIE['telefone']}}">
                        </li>
                        <li class="inp-text">
                            <label>Mensagem *</label>
                            <textarea id="mensagem" required="" name="texto">{{$_COOKIE['texto']}}</textarea>
                        </li>

                        @else

                        <li class="inp-name">
                            <label>Nome *</label>
                            <input id="nome" required="" type="text" name="nome">
                        </li>
                        <li class="inp-email">
                            <label>E-mail *</label>
                            <input id="email" required="" type="email" name="email">
                        </li>
                        <li class="inp-email">
                            <label>Telefone *</label>
                            <input id="telefone" required="" type="text" name="telefone">
                        </li>
                        <li class="inp-text">
                            <label>Mensagem *</label>
                            <textarea id="mensagem" required="" name="texto"></textarea>
                        </li>

                        @endif
                        
                    </ul>
                    <div class="btn-form-cover">
                        <button id="#submit" type="submit" class="btn" style="width: 100%;">Enviar mensagem</button>
                    </div><br>

                    {{--  reCAPTCHA Site  --}}
                    <div id="RecaptchaField1" class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6LfN6mgaAAAAAMaUtpZo7ZZ6sc0WsGhKsDq532Vf" style="width: 100%"></div><br>

                    {{--  reCAPTCHA Localhost  --}}
                    {{--  <div id="RecaptchaField1" class="g-recaptcha" data-sitekey="6LdyhV0aAAAAALv6AgSJnpVELPCu2dq6umHtwrPc"></div>  --}}
                
                </form>
                
                <div id="message"></div>
            </div>
        </div>
    </div>
</section>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="{{asset('js/sb-admin-2.js')}}"></script>
<script src="{{asset('js/jquery.mask.min.js')}}"></script>
<script>
    $("#telefone").mask("(00) 000000009");
</script>