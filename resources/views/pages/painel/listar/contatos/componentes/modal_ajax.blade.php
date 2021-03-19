<div class="row">
    <div class="col-md-12" style="padding-bottom: 1pc;">
        <div class="card">
            <h5 class="card-header">Nome</h5>
            <div class="card-body">
            <p class="card-text">{{$contato->nome}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="padding-bottom: 1pc;">
        <div class="card">
            <h5 class="card-header">E-mail</h5>
            <div class="card-body">
                <p class="card-text">{{$contato->email}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="padding-bottom: 1pc;">
        <div class="card">
            <h5 class="card-header">Telefone</h5>
            <div class="card-body">
                <p class="card-text">{{$contato->telefone}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="padding-bottom: 1pc;">
        <div class="card">
            <h5 class="card-header">Mensagem</h5>
            <div class="card-body">
                <p class="card-text">{!!$contato->texto!!}</p>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="padding-bottom: 1pc;">
        <div class="card">
            <h5 class="card-header">Localizacao</h5>
            <div class="card-body">
                <p class="card-text">{{$contato->localizacao}}</p>
            </div>
        </div>
    </div>
</div>