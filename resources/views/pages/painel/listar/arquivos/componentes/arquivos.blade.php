<!-- Begin Page Content -->
<div id="topo_lista_paginas" class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Arquivos</h1>
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
                                        <th>Titulo</th>
                                        <th>Descrição</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach ($arquivos as $arquivo)
                                    <tr>
                                        <th>{{$arquivo->titulo}}</th>
                                        <th>{{$arquivo->descricao}}</th>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="checkbox">
                                                        <input type="hidden" value="{{$arquivo->id}}">
                                                        @if ($arquivo->excluido == 0)
                                                        <div href="#" style="color:green;display: flex;"><i class="fas fa-check-circle"></i>
                                                            <p style="margin-bottom: auto;padding-left: 6px;">Ativo<p>
                                                        </div>
                                                        @else
                                                        <div href="#" style="color:red;display: flex;"><i class="fas fa-times-circle"></i>
                                                            <p style="margin-bottom: auto;padding-left: 6px;">Excluido<p>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="row">
                                                @if ($arquivo->excluido == 0)
                                                  <div class="col-md-6" style="display: flex;justify-content: center;">
                                                    <a href="{{route('status', ['id' => $arquivo->id])}}" type="button" class="btn btn-danger status" value="{{$arquivo->id}}"><i class="fas fa-times-circle"></i></a>
                                                  </div>
                                                @else
                                                  <div class="col-md-6" style="display: flex;justify-content: center;">
                                                    <a href="{{route('status', ['id' => $arquivo->id])}}" type="button" class="btn btn-info status"  value="{{$arquivo->id}}"><i class="fas fa-trash-restore-alt"></i></a>
                                                  </div>
                                                @endif
                                                <div class="col-md-6" style="display: flex;justify-content: center;">
                                                  <a href="{{route('arquivos.edit', [$arquivo->id])}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                                </div>
                                              </div>
                                        </th>
                                    </tr>
                                    @endforeach

                                </tbody>
                                <tfoot style="background-color: #335acb;color: white;">
                                    <tr>
                                        <th>Titulo</th>
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