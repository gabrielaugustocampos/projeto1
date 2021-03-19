<!-- Begin Page Content -->
<div id="topo_lista_paginas" class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Páginas</h1>
    <div class="tabela">
        <div class="row">

            <div class="col-md-6 col-sm-12">
                <div class="result_localizacao">
                    <div class="form-group">
                        <!-- <label for="exampleFormControlSelect1">Localização</label> -->
                        <select class="form-control" id="select_localizacao">
                            <option selected value="none">Selecione uma Localização</option>
                            @foreach ($localizacao as $item)
                            <option value="{{$item->id_localizacao_texto}}">{{$item->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="result_localizacao">
                    <div class="form-group">
                        <!-- <label for="exampleFormControlSelect1">Localização</label> -->
                        <select class="form-control" id="select_filtro">
                            <option selected value="none">Filtro Busca</option>
                            <option value="0">Ativos</option>
                            <option value="1">Excluidos</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12" style="display: flex;align-items: center;">
                <div class="form-group" style="width: 100%;">
                    <button type="button" class="btn btn-primary" style="width: 100%;" data-toggle="modal"
                        data-target="#modal_cadastro_localizacao">
                        <i class="fas fa-plus"></i> Adicionar Localização
                    </button>
                </div>
            </div>
            <div class="col-md-3 col-sm-12" style="display: flex;align-items: center;">
                <div class="form-group" style="width: 100%;">
                    <button id="btn_remover_localizacao" type="button" class="btn btn-danger" style="width: 100%;">
                        <i class="fas fa-trash-alt"></i> Remover Localização
                    </button>
                </div>
            </div>
            <div class="col-md-3 col-sm-12" style="display: flex;align-items: center;">
                <div class="form-group" style="width: 100%;">
                    <button id="btn_buscar_paginas" type="button" class="btn btn-secondary" style="width: 100%;">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </div>
            </div>
            <div class="col-md-3 col-sm-12" style="display: flex;align-items: center;">
                <div class="form-group" style="width: 100%;">
                    <a href="{{url('/cadastro_pagina')}}" class="btn btn-success" style="width: 100%;">
                        <i class="fas fa-folder-plus"></i> Adicionar página
                    </a>
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
                                    @if (!empty($paginas[0]))
                                    @foreach ($paginas as $pagina)
                                    <tr>
                                        <th>{{$pagina->titulo}}</th>
                                        <th>{{ str_limit($pagina->descricao, $limit = 30, $end = '...') }}</th>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="checkbox">
                                                        <input type="hidden" value="{{$pagina->id_texto}}">
                                                        @if ($pagina->excluido == 0)
                                                        <div href="#" style="color:green;display: flex;"><i
                                                                class="fas fa-check-circle"></i>
                                                            <p style="margin-bottom: auto;padding-left: 6px;">Ativo<p>
                                                        </div>
                                                        @else
                                                        <div href="#" style="color:red;display: flex;"><i
                                                                class="fas fa-times-circle"></i>
                                                            <p style="margin-bottom: auto;padding-left: 6px;">Excluido
                                                                <p>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="row">
                                                @if ($pagina->excluido == 0)
                                                <div class="col-md-6" style="display: flex;justify-content: center;">
                                                    <button type="button" class="btn btn-danger status"
                                                        value="{{$pagina->id_texto}}"><i
                                                            class="fas fa-times-circle"></i></button>
                                                </div>
                                                @else
                                                <div class="col-md-6" style="display: flex;justify-content: center;">
                                                    <button type="button" class="btn btn-info status"
                                                        value="{{$pagina->id_texto}}"><i
                                                            class="fas fa-trash-restore-alt"></i></button>
                                                </div>
                                                @endif
                                                <div class="col-md-6" style="display: flex;justify-content: center;">
                                                    <a href="{{url('/paginas/editar', [$pagina->id_texto])}}"
                                                        class="btn btn-primary edit"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="odd">
                                        <td valign="top" colspan="6" class="dataTables_empty text-center">Nenhum
                                            resultado encontrado</td>
                                    </tr>
                                    @endif
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
    function loading_show() {
        $('.loading').html("<img src='{{asset('img/loader.gif')}}'/>").fadeIn('fast');
    }

    function loading_hide() {
        $('.loading').fadeOut('fast');
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).on("click", "#btn_buscar_paginas", function () {
        let id_localizacao = $("#select_localizacao").val();
        let valor_filtro = $('#select_filtro').val();
        $.ajax({
            url: "/paginas/listar/paginas/id",
            type: 'post',
            data: {
                _token: '{!! csrf_token() !!}',
                valor_filtro: valor_filtro,
                id_localizacao: id_localizacao,
            },

            // beforeSend: function(){
            //   loading_show();
            // },

            success: function (result) {
                // loading_hide();

                if (result == 1) {
                    Swal.fire(
                        'Ops!',
                        'Selecione uma localização para consultar!',
                        'error'
                    )
                } else {
                    $('.tabela').empty();
                    $('.tabela').html(result);
                }
                // $('#modal_cadastro_localizacao').modal('hide');
            }
        });
    });

    // $(document).on("change", "#select_filtro", function(){
    //   let valor_filtro = $(this).val();
    //   let id_localizacao = $('#select_localizacao').val();
    //   $.ajax({
    //     url: "/paginas/listar/paginas/id",
    //     type: 'post',
    //     data:{
    //       _token: '{!! csrf_token() !!}',
    //       valor_filtro:valor_filtro,
    //       id_localizacao:id_localizacao,
    //     },
    //
    //     beforeSend: function(){
    //       loading_show();
    //     },
    //
    //     success: function(result){
    //       // loading_hide();
    //
    //       if (result == 1) {
    //         Swal.fire(
    //           'Ops!',
    //           'Selecione uma localização para consultar!',
    //           'error'
    //         )
    //       }else{
    //         $('.tabela').empty();
    //         $('.tabela').html(result);
    //       }
    //       // $('#modal_cadastro_localizacao').modal('hide');
    //     }
    //   });
    // });

    $(document).on("click", ".status", function () {

        let id_pagina = $(this).val();
        let aux_evento_botao = 0;
        $.ajax({
            url: "/paginas/alterar_status/localizacao",
            type: 'post',
            data: {
                _token: '{!! csrf_token() !!}',
                id_pagina: id_pagina,
                aux_evento_botao: aux_evento_botao,
            },

            // beforeSend: function(){
            //   loading_show();
            // },

            success: function (result) {
                // loading_hide();
                $('.tabela').empty();
                $('.tabela').html(result);
                // $('#modal_cadastro_localizacao').modal('hide');
                // Swal.fire(
                //   'Bom trabalho!',
                //   'Localização cadastrada com sucesso!',
                //   'success'
                // )
            }
        });
    });

    // $(document).on("click",".edit",function() {
    //
    //   let id_pagina = $(this).val();
    //
    //   $.ajax({
    //     url: "paginas/editar",
    //     type: 'post',
    //     data:{
    //       _token: '{!! csrf_token() !!}',
    //       id_pagina:id_pagina,
    //     },
    //
    //     beforeSend: function(){
    //       loading_show();
    //     },
    //
    //     success: function(result){
    //       // loading_hide();
    //       $('.tabela').empty();
    //       $('.tabela').html(result);
    //       // $('#modal_cadastro_localizacao').modal('hide');
    //       // Swal.fire(
    //       //   'Bom trabalho!',
    //       //   'Localização cadastrada com sucesso!',
    //       //   'success'
    //       // )
    //     }
    //   });
    // });

    $(document).on("click", "#btn_cadastro_localizacao", function () {
        let nome_localizacao = $('#nome_localizacao').val();
        let is_produto = $('#is_produto').val();


        if (nome_localizacao == "") {

        }
        $.ajax({
            url: "/paginas/cadastro/localizacao",
            type: 'post',
            data: {
                _token: '{!! csrf_token() !!}',
                nome_localizacao: nome_localizacao,
                is_produto: is_produto
            },

            // beforeSend: function(){
            //   loading_show();
            // },

            success: function (result) {
                // loading_hide();
                if (result == 1) {
                    Swal.fire(
                        'Erro!!',
                        'Está tentando alterar os valores então!!',
                        'error'
                    )
                } else {
                    $('.result_localizacao').empty();
                    $('.result_localizacao').html(result);
                    $('#modal_cadastro_localizacao').modal('hide');
                    Swal.fire(
                        'Bom trabalho!',
                        'Localização cadastrada com sucesso!',
                        'success'
                    )

                }
            }
        });
    });

    // $(document).on("change","#select_localizacao",function() {
    //
    // });

    $(document).on("click", "#btn_remover_localizacao", function () {
        let id_localizacao = $('#select_localizacao').val();

        $.ajax({
            url: "/paginas/remover/localizacao",
            type: 'post',
            data: {
                _token: '{!! csrf_token() !!}',
                id_localizacao: id_localizacao,
            },

            // beforeSend: function(){
            //   loading_show();
            // },

            success: function (result) {
                // loading_hide();
                if (result == 0) {
                    Swal.fire(
                        'Ops!',
                        'Selecione uma localização primeiro para excluir!',
                        'error'
                    )
                } else if (result == 1) {
                    Swal.fire(
                        'Ops!',
                        'Exclua os registros dependentes dessa página primeiro!',
                        'error'
                    )
                } else {
                    $('.result_localizacao').empty();
                    $('.result_localizacao').html(result);
                    Swal.fire(
                        'Bom trabalho!',
                        'Localização removida com sucesso!',
                        'success'
                    )
                }
            }
        });
    });

</script>
