<!-- Begin Page Content -->
<div id="topo_lista_paginas" class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Segmentos</h1>
    <div class="tabela">
    <div class="row">


    <div class="container-fluid" style="display: flex;flex-wrap: wrap;justify-content: center;">
      <div class="col-md-6 col-sm-12">
        <div class="result_localizacao">
          <div class="form-group">
            <select class="form-control" id="select_filtro">
              <option selected value="none">Filtro Busca Excluidos</option>
              <option value="1">Excluidos</option>
              <option value="0">Não excluido</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12" style="display: flex;align-items: center;">
        <div class="form-group" style="width: 100%;">
          <a href="{{route('segmentos.create')}}" class="btn btn-success" style="width: 100%;">
            <i class="fas fa-folder-plus"></i> Adicionar Segmento
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="loading" style="display:flex;justify-content:center;">

      </div>
    </div>


    <!-- DataTales Example -->
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead style="background-color: #335acb;color: white;">

                <tr>
                  <th>Nome</th>
                  <th>Descrição</th>
                  <th>Status</th>
                  <th>Ações</th>
                </tr>

              </thead>

              <tbody>
                  @foreach ($segmentos as $segmento)
                    <tr>
                      <th>{{$segmento->titulo}}</th>
                      <th>{{ str_limit($segmento->descricao, $limit = 30, $end = '...') }}</th>
                      <th>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="checkbox">
                              <input type="hidden" value="{{$segmento->id}}">
                              @if ($segmento->excluido == 0)
                                <div href="#" style="color:green;display: flex;"><i class="fas fa-check-circle"></i><p style="margin-bottom: auto;padding-left: 6px;">Ativo<p></div>
                                @else
                                  <div href="#" style="color:red;display: flex;"><i class="fas fa-times-circle"></i><p style="margin-bottom: auto;padding-left: 6px;">Excluido<p></div>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </th>
                          <th>
                            <div class="row" style="display: flex;justify-content: center;flex-wrap: nowrap;">
                              @if ($segmento->excluido == 0)
                                <div class="col-md-3" style="display: flex;justify-content: center;">
                                  <button type="button" class="btn btn-danger status" value="{{$segmento->id}}"><i class="fas fa-times-circle"></i></button>
                                </div>
                              @else
                                <div class="col-md-3" style="display: flex;justify-content: center;">
                                  <button type="button" class="btn btn-info status"  value="{{$segmento->id}}"><i class="fas fa-trash-restore-alt"></i></button>
                                </div>
                              @endif
                              <div class="col-md-3" style="display: flex;justify-content: center;">
                                <a href="{{route('segmentos.edit', ['id' => $segmento->id])}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                              </div>
                            </div>
                          </th>
                        </tr>
                      @endforeach

                  </tbody>
                  <tfoot style="background-color: #335acb;color: white;">
                    <tr>
                      <th>Nome</th>
                      <th>Descrição</th>
                      <th>Status</th>
                      <th>Ações</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
    </div>
  </div>

  </div>
  </div>
  <!-- /.container-fluid -->
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


    $(document).on("change", "#select_filtro", function(){
      let valor_filtro = $(this).val();
      $.ajax({
        url: "{{route('segmento.filtro')}}",
        type: 'post',
        data:{
          _token: '{!! csrf_token() !!}',
          valor_filtro:valor_filtro,
        },


        success: function(result){

          if (result == 1) {
            Swal.fire(
              'Ops!',
              'Então você se acha o espertinho alterarando o valor dos inputs!',
              'error'
            )
          }else{
            $('.tabela').empty();
            $('.tabela').html(result);
          }
        }
      });
    });

    $(document).on("click", ".status",function() {

      let id_segmento = $(this).val();
      $.ajax({
        url: "{{route('segmento.alterar_status')}}",
        type: 'post',
        data:{
          _token: '{!! csrf_token() !!}',
          id_segmento:id_segmento,
        },

        success: function(result){
          $('.tabela').empty();
          $('.tabela').html(result);
        }
      });
    });


  </script>
