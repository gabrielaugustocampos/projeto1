<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="row" style="display: flex;align-items: center;padding-bottom: 1pc;">
    <div class="col-md-10">
      <h1 class="h3 mb-4 text-gray-800">Banners</h1>
    </div>
    <div class="col-md-2 col-sm-12" style="display: flex;justify-content: flex-end;">
      {{-- <a href="#" class="d-sm-inline-block btn btn-sm btn-primary" style="width: 100%;"><i class="fas fa-plus"></i> Adicionar Galeria</a> --}}
      <button type="button" class="d-sm-inline-block btn btn-sm btn-primary" style="width: 100%;" data-toggle="modal" data-target="#modal_cadastro_banner"><i class="fas fa-plus"></i> Adicionar Banner</button>
    </div>
  </div>
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-md-12">
      <div class="loading" style="display: flex;justify-content: center;">

      </div>
    </div>
    <div class="result_ajax_banner" style="display: flex;width: 100%;justify-content: center;flex-wrap: wrap;">
      <div class="col-sm-6 col-md-6 mb-4">
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <h3 style="color:green;width:100%;text-align: center;">Ativado</h3>
            </div>
            @if (!empty($banners_ativos[0]))
              @foreach ($banners_ativos as $banner)
                <div class="col-sm-12 col-md-6 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="no-gutters align-items-center">
                        <div class="container">
                          <div class="row">
                            <div class="col-md-12 mr-2" style="padding-bottom: 1pc;text-align:center;">

                                <div type="text" class="h5 mb-0 font-weight-bold text-gray-800">{{$banner->titulo}}</div>

                              {{-- <div class="h6 mb-0 font-weight-bold text-gray-800">{{$galeria->descricao}}</div> --}}
                              <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: green;">Ativo</div>
                              <div class="text-xs font-weight-bold text-uppercase mb-1"><i class="fas fa-{{$banner->is_mobile == 0 ? "desktop" : "mobile"}} fa-2x"></i></div>
                            </div>
                          </div>
                          <div class="row" style="display: flex;justify-content: center;flex-wrap: wrap;">
                            <div class="col-md-12 col-sm-12">
                              <button value="{{$banner->id_banner}}" type="button" class="btn btn-danger btn_alterar_status_banner" style="width: 100%;">
                                <i class="fas fa-trash-alt"></i> Excluir
                              </button>
                            </div>
                            <div class="col-md-12 col-sm-12" style="padding-top:1pc;">
                            <a href="{{url('/banner', [$banner->id_banner])}}">
                              <button value="{{$banner->id_banner}}" type="button" class="btn btn-info btn_editar_galeria" style="width: 100%;">
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
                  Nenhum banner está ativo!
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
          @if (!empty($banners_excluidos[0]))
            @foreach ($banners_excluidos as $banner)
              <div class="col-sm-12 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                  <div class="card-body">
                    <div class="no-gutters align-items-center">
                      <div class="container">
                        <div class="row">
                          <div class="col-md-12 mr-2" style="padding-bottom: 1pc;text-align: center;">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$banner->titulo}}</div>
                            {{-- <div class="h6 mb-0 font-weight-bold text-gray-800">{{$galeria->descricao}}</div> --}}
                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: red;">Excluido</div>
                            <div class="text-xs font-weight-bold text-uppercase mb-1"><i class="fas fa-{{$banner->is_mobile == 0 ? "desktop" : "mobile"}} fa-2x"></i></div>
                          </div>
                        </div>
                        <div class="row" style="display: flex;justify-content: center;flex-wrap: wrap;">

                          <div class="col-md-12 col-sm-12">
                            <button value="{{$banner->id_banner}}" type="button" class="btn btn-primary btn_alterar_status_banner" style="width: 100%;">
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
                Nenhum banner está excluido!
              </div>
            </div>
          @endif
        </div>
      </div>
  </div>
</div>

<div class="modal fade" id="modal_cadastro_banner" tabindex="-1" role="dialog" aria-labelledby="titulo_modal_galeria" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titulo_modal_banner">Cadastro de Galeria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form style="display: flex;flex-direction: column;width: 100%;"  action="/banner/cadastro" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="col-md-12 col-sm-12">
            <div class="form-group">
              <label for="exampleInputEmail1">Titulo</label>
              <input type="text" class="form-control" name="titulo_banner" placeholder="Digite o titulo do seu banner...">
            </div>
          </div>
          <div class="col-md-12 col-sm-12">
            <div class="form-group">
              <label for="exampleInputPassword1">Descrição</label>
              <input type="text" class="form-control" name="descricao_banner" placeholder="Digite a descrição do seu banner...">
            </div>
          </div>
          <div class="col-md-12 col-sm-12">
            <div class="form-group">
              <label for="exampleInputPassword1">Nome do botão</label>
              <input type="text" class="form-control" name="nome_botao" placeholder="Digite a o nome do botão...">
            </div>
          </div>
          <div class="col-md-12 col-sm-12">
            <div class="form-group">
              <label for="exampleInputPassword1">URL do botão</label>
              <input type="text" class="form-control" name="url_botao" placeholder="Digite a URL do botão...">
            </div>
          </div>
          <div class="col-md-12 col-sm-12">
            <div class="form-group">
               <label for="exampleFormControlSelect1">Tipo Banner</label>
               <select class="form-control" name="tipo_banner">
                 <option value="0">Banner Desktop</option>
                 <option value="1">Banner Mobile</option>
               </select>
             </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          <button type="submit" onclick="loading_show()" class="btn btn-primary">Salvar</button>
        </div>
    </form>
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

// $(document).on("click", "#btn_cadastro_banner", function(){
//   let titulo_banner = $("#titulo_banner").val();
//   let descricao_banner = $("#descricao_banner").val();
//
//   if(titulo_banner == ""){
//     Swal.fire(
//       'Ops!',
//       'Campo titulo não pode ser vazio!',
//       'error'
//     )
//   }
//
//   $.ajax({
//     url: "/banner/cadastro",
//     type: 'post',
//     data:{
//       _token: '{!! csrf_token() !!}',
//       titulo_banner:titulo_banner,
//       descricao_banner:descricao_banner,
//     },
//
//     beforeSend: function(){
//       $("#modal_cadastro_galeria").modal('hide');
//     },
//
//     success: function(result){
//         $('.result_ajax_banner').empty();
//         $('.result_ajax_banner').html(result);
//     }
//   });
//
// });

$(document).on("click", ".btn_alterar_status_banner", function(){
  let id_banner = $(this).val();
  // alert(id_galeria);
  $.ajax({
    url: "/banner/alterar_status",
    type: 'post',
    data:{
      _token: '{!! csrf_token() !!}',
      id_banner:id_banner,
    },

    success: function(result){
      // loading_hide();
      $('.result_ajax_banner').empty();
      $('.result_ajax_banner').html(result);
      // $('#modal_cadastro_localizacao').modal('hide');
    }
  });
});
</script>
