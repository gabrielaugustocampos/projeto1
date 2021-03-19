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
                                    <a href="{{url('/paginas/editar', [$segmento->id])}}" class="btn btn-primary edit"><i class="fas fa-pencil-alt"></i></a>
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

<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>
