<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="row" style="display: flex;align-items: center;padding-bottom: 1pc;">
    <div class="col-md-10">
      <h1 class="h3 mb-4 text-gray-800">Galeria</h1>
    </div>
    <div class="col-md-2 col-sm-12" style="display: flex;justify-content: flex-end;">
      {{-- <a href="#" class="d-sm-inline-block btn btn-sm btn-primary" style="width: 100%;"><i class="fas fa-plus"></i> Adicionar Galeria</a> --}}
      <button type="button" class="d-sm-inline-block btn btn-sm btn-primary" style="width: 100%;" data-toggle="modal" data-target="#modal_cadastro_galeria"><i class="fas fa-plus"></i> Adicionar Galeria</button>
    </div>
  </div>
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-md-12">
      <div class="loading" style="display: flex;justify-content: center;">

      </div>
    </div>
    <div class="result_ajax_galeria" style="display: flex;width: 100%;justify-content: center;flex-wrap: wrap;">
      <div class="col-sm-6 col-md-6 mb-4">
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <h3 style="color:green;width:100%;text-align: center;">Ativado</h3>
            </div>
            @if (!empty($galerias_ativo[0]))
              @foreach ($galerias_ativo as $galeria)
                <div class="col-sm-12 col-md-6 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="no-gutters align-items-center">
                        <div class="container">
                          <div class="row">
                            <div class="col-md-12 mr-2" style="padding-bottom: 1pc;text-align:center;">

                                <div type="text" class="h5 mb-0 font-weight-bold text-gray-800">{{$galeria->nome}}</div>

                              {{-- <div class="h6 mb-0 font-weight-bold text-gray-800">{{$galeria->descricao}}</div> --}}
                              <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: green;">Ativo</div>
                            </div>
                          </div>
                          <div class="row" style="display: flex;justify-content: center;flex-wrap: wrap;">
                            <div class="col-md-12 col-sm-12">
                              <button value="{{$galeria->id_localizacao_galeria}}" type="button" class="btn btn-danger btn_alterar_status_galeria" style="width: 100%;">
                                <i class="fas fa-trash-alt"></i> Excluir
                              </button>
                            </div>
                            <div class="col-md-12 col-sm-12" style="padding-top:1pc;">
                            <a href="{{url('fotos', [$galeria->id_localizacao_galeria])}}">
                              <button value="{{$galeria->id_localizacao_galeria}}" type="button" class="btn btn-info btn_editar_galeria" style="width: 100%;">
                                <i class="fas fa-pen-square"></i> Editar
                              </button>
                            </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <div class="col-md-12">
                <div class="alert alert-info" role="alert" style="text-align: center;">
                  Nenhuma galeria está ativa!
                </div>
              </div>
            @endif
          </div>
      </div>

      <div class="col-sm-6 col-md-6 mb-4">
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <h3 style="color:red;width:100%;text-align: center;">Excluido</h3>
          </div>
          @if (!empty($galerias_excluido[0]))
            @foreach ($galerias_excluido as $galeria)
              <div class="col-sm-12 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                  <div class="card-body">
                    <div class="no-gutters align-items-center">
                      <div class="container">
                        <div class="row">
                          <div class="col-md-12 mr-2" style="padding-bottom: 1pc;text-align: center;">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$galeria->nome}}</div>
                            {{-- <div class="h6 mb-0 font-weight-bold text-gray-800">{{$galeria->descricao}}</div> --}}
                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: red;">Excluido</div>
                          </div>
                        </div>
                        <div class="row" style="display: flex;justify-content: center;flex-wrap: wrap;">

                          <div class="col-md-12 col-sm-12">
                            <button value="{{$galeria->id_localizacao_galeria}}" type="button" class="btn btn-primary btn_alterar_status_galeria" style="width: 100%;">
                              <i class="fas fa-trash-restore-alt"></i> Restaurar
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          @else
            <div class="col-md-12">
              <div class="alert alert-info" role="alert" style="text-align: center;">
                Nenhuma galeria está excluida!
              </div>
            </div>
          @endif
        </div>
      </div>


  </div>
</div>

<div class="modal fade" id="modal_cadastro_galeria" tabindex="-1" role="dialog" aria-labelledby="titulo_modal_galeria" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titulo_modal_galeria">Cadastro de Galeria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12 col-sm-12">
          <div class="form-group">
            <label for="exampleInputEmail1">Titulo</label>
            <input type="text" class="form-control" id="titulo_galeria" placeholder="Digite o nome de sua galeria...">
          </div>
        </div>
        <div class="col-md-12 col-sm-12">
          <div class="form-group">
            <label for="exampleInputPassword1">Descrição</label>
            <input type="text" class="form-control" id="descricao_galeria" placeholder="Digite a descrição de sua galeria...">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btn_cadastro_galeria" class="btn btn-primary">Salvar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
function loading_show(){
  $('.loading').html("<img src='{{asset('img/loader.gif')}}'/>").fadeIn('fast');
}

function loading_hide(){
  $('.loading').fadeOut('fast');
}

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(document).on("click", "#btn_cadastro_galeria", function(){
  let titulo_galeria = $("#titulo_galeria").val();
  let descricao_galeria = $("#descricao_galeria").val();

  if(titulo_galeria == ""){
    Swal.fire(
      'Ops!',
      'Campo titulo não pode ser vazio!',
      'error'
    )
  }

  $.ajax({
    url: "/galeria/cadastro/localizacao",
    type: 'post',
    data:{
      _token: '{!! csrf_token() !!}',
      titulo_galeria:titulo_galeria,
      descricao_galeria:descricao_galeria,
    },

    beforeSend: function(){
      // loading_show();
      $("#modal_cadastro_galeria").modal('hide');
    },

    success: function(result){
      // loading_hide();

      // if (result == 1) {
      //   Swal.fire(
      //     'Ops!',
      //     'Esta galeria está vinculada a uma página!',
      //     'error'
      //   )
      // }else{
        $('.result_ajax_galeria').empty();
        $('.result_ajax_galeria').html(result);
      // }
      // $('#modal_cadastro_localizacao').modal('hide');
    }
  });

});

$(document).on("click", ".btn_alterar_status_galeria", function(){
  let id_galeria = $(this).val();
  // alert(id_galeria);
  $.ajax({
    url: "/galeria/alterar_status",
    type: 'post',
    data:{
      _token: '{!! csrf_token() !!}',
      id_galeria:id_galeria,
    },

    beforeSend: function(){
      // loading_show();
    },

    success: function(result){
      // loading_hide();

      if (result == 1) {
        Swal.fire(
          'Ops!',
          'Esta galeria está vinculada a uma página!',
          'error'
        )
      }else{
        $('.result_ajax_galeria').empty();
        $('.result_ajax_galeria').html(result);
      }
      // $('#modal_cadastro_localizacao').modal('hide');
    }
  });
});
</script>
