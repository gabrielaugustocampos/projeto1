<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="row" style="display: flex;align-items: center;padding-bottom: 1pc;">
    <div class="col-md-10">
      <h1 class="h3 mb-4 text-gray-800">Cases</h1>
    </div>
    <div class="col-md-2 col-sm-12" style="display: flex;justify-content: flex-end;">
      {{-- <a href="#" class="d-sm-inline-block btn btn-sm btn-primary" style="width: 100%;"><i class="fas fa-plus"></i> Adicionar Galeria</a> --}}
      <a href="{{route('cases.create')}}" class="d-sm-inline-block btn btn-sm btn-primary" style="width: 100%;"><i class="fas fa-plus"></i> Adicionar Case</a>
    </div>
  </div>
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-md-12">
      <div class="loading" style="display: flex;justify-content: center;">

      </div>
    </div>
    <div class="result_ajax_cases" style="display: flex;width: 100%;justify-content: center;flex-wrap: wrap;">
      <div class="col-sm-6 col-md-6 mb-4">
        <div class="row d-flex justify-content-center">
          <div class="col-md-12 col-sm-12">
            <h3 style="color:green;width:100%;text-align: center;">Ativado</h3>
          </div>
          @if (!empty($cases_ativas[0]))
            @foreach ($cases_ativas as $case)
              <div class="col-sm-12 col-md-6 mb-4">
                <div class="card shadow h-100 py-2 hover_card">
                  <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="no-gutters align-items-center">
                      <div class="container">
                        <div class="row">
                          <div class="col-md-12 mr-2" style="padding-bottom: 1pc;text-align:center;">
                            <div type="text" class="h5 mb-0 font-weight-bold text-gray-800">{{$case->titulo}}</div>
                          </div>
                      </div>
                      <div class="row d-flex justify-content-center flex-wrap" style="display: flex;justify-content: center;flex-wrap: wrap;">
                        <div class="col-md-12 col-sm-12" style="display: flex;justify-content: center;align-items: center;">
                          @if (!empty($case->imagem))
                            <img class="w-100" style="height: inherit;" src="{{asset('imagens_cases/'.$case->imagem)}}" alt="">
                          @else
                            <img style="height: 70%;width: 60%;" src="{{asset('img/no_img.png')}}" alt="">
                          @endif
                        </div>
                        <div class="col-md-12 mr-2" style="padding-bottom: 1pc;text-align:center;padding-top: 1pc;">
                          <div type="text" class="h5 mb-0 font-weight-bold text-gray-800">{{$case->descricao}}</div>
                        </div>
                      </div>
                      <div class="row" style="display: flex;justify-content: center;flex-wrap: wrap;padding-top: 1pc;">
                        <div class="col-md-12 col-sm-12">
                          <a href="{{route('cases.edit', [$case->id])}}" class="btn btn-info" style="width: 100%;margin-bottom:1pc;">
                            <i class="fas fa-pen-square"></i> Editar
                          </a>
                        </div>
                        <div class="col-md-12 col-sm-12">
                          <button value="{{$case->id}}" type="button" class="btn btn-primary alterar_status_case" style="width: 100%;">
                            <i class="fas fa-trash-alt"></i> Excluir
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
          Nenhuma case está ativa!
        </div>
      </div>
    @endif
  </div>
</div>

<div class="col-sm-6 col-md-6 mb-4">
  <div class="row d-flex justify-content-center">
    <div class="col-md-12 col-sm-12">
      <h3 style="color:red;width:100%;text-align: center;">Excluido</h3>
    </div>
    @if (!empty($cases_excluidas[0]))
      @foreach ($cases_excluidas as $case)
        <div class="col-sm-12 col-md-6 mb-4">
          <div class="card shadow h-100 py-2 hover_card">
            <div class="card-body d-flex align-items-center justify-content-center">
              <div class="no-gutters align-items-center">
                <div class="container">
                  <div class="row">
                    <div class="col-md-12 mr-2" style="padding-bottom: 1pc;text-align:center;">
                      <div type="text" class="h5 mb-0 font-weight-bold text-gray-800">{{$case->titulo}}</div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center flex-wrap" style="display: flex;justify-content: center;flex-wrap: wrap;">
                  <div class="col-md-12 col-sm-12">
                    <img class="w-100" style="height: inherit;" src="{{asset('imagens_cases/'.$case->imagem)}}" alt="">
                  </div>
                  <div class="col-md-12 mr-2" style="padding-bottom: 1pc;text-align:center;padding-top: 1pc;">
                    <div type="text" class="h5 mb-0 font-weight-bold text-gray-800">{{$case->descricao}}</div>
                  </div>
                </div>
                <div class="row" style="display: flex;justify-content: center;flex-wrap: wrap;padding-top: 1pc;">
                  <div class="col-md-12 col-sm-12">
                    <button value="{{$case->id}}" type="button" class="btn btn-primary alterar_status_case" style="width: 100%;">
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
          Nenhuma case está excluida!
        </div>
      </div>
    @endif
  </div>
</div>
</div>
</div>

<script type="text/javascript">

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).on("click", ".alterar_status_case", function(){
    let id_case = $(this).val();
    $.ajax({
      url: "{{route('cases.alterar_status')}}",
      type: 'post',
      data:{
        _token: '{!! csrf_token() !!}',
        id_case:id_case,
      },

      success: function(result){
        $('.result_ajax_cases').empty();
        $('.result_ajax_cases').html(result);
      }
    });
  });
</script>
