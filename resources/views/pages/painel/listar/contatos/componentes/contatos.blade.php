<!-- Begin Page Content -->
<div id="topo_lista_paginas" class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Contatos</h1>
    <div class="tabela">
        <div class="row">
            <!-- DataTales Example -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead style="background-color: #335acb;color: white;">

                                    <tr>
                                        <th>Nome</th>
                                        <th>E-mail</th>
                                        <th>Telefone</th>
                                        <th>Mensagem</th>
                                        <th>Localização</th>
                                        <th>Ações</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach ($contatos as $contato)
                                    <tr>
                                        <th>{{$contato->nome}}</th>
                                        <th>{{$contato->email}}</th>
                                        <th>{{$contato->telefone}}</th>
                                        <th>{!! str_limit($contato->texto, $limit = 30, $end = '...') !!}</th>
                                        <th>{{$contato->localizacao}}</th>
                                        <th>
                                            <div class="row" style="display: flex;justify-content: center;">
                                                <div class="col-md-6" style="display: flex;justify-content: center;">
                                                    <button type="button" class="btn btn-primary btn_modal"
                                                        value="{{$contato->id}}">
                                                        <i class="fas fa-info-circle"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    @endforeach

                                </tbody>
                                <tfoot style="background-color: #335acb;color: white;">
                                    <tr>
                                        <th>Nome</th>
                                        <th>E-mail</th>
                                        <th>Telefone</th>
                                        <th>Mensagem</th>
                                        <th>Localização</th>
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
<div class="modal fade" id="modal_info_contatos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Contato informações</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("click",".btn_modal",function() {
    let id_contato = $(this).val();
    $.ajax({
      url: "{{route('contato.get_info')}}",
      type: 'post',
      data:{
        _token: '{!! csrf_token() !!}',
        id_contato:id_contato,
      },
      success: function(result){
        $(".modal-body").empty();
        $(".modal-body").html(result);
        $("#modal_info_contatos").modal('show');
      }
    });

  });
</script>