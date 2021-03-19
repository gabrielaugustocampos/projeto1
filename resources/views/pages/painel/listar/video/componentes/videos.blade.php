<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="row" style="display: flex;align-items: center;padding-bottom: 1pc;">
    <div class="col-md-10">
      <h1 class="h3 mb-4 text-gray-800">Vídeos</h1>
    </div>
    <div class="col-md-2 col-sm-12" style="display: flex;justify-content: flex-end;">
      {{-- <a href="#" class="d-sm-inline-block btn btn-sm btn-primary" style="width: 100%;"><i class="fas fa-plus"></i> Adicionar Galeria</a> --}}
      <a href="{{route('videos.create')}}" class="d-sm-inline-block btn btn-sm btn-primary" style="width: 100%;"><i class="fas fa-plus"></i> Adicionar Vídeo</a>
    </div>
  </div>
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-md-12">
      <div class="loading" style="display: flex;justify-content: center;">

      </div>
    </div>
    <div class="result_ajax_videos" style="display: flex;width: 100%;justify-content: center;flex-wrap: wrap;">
      <div class="col-sm-6 col-md-6 mb-4">
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <h3 style="color:green;width:100%;text-align: center;">Ativado</h3>
            </div>
            @if (!empty($videos_ativos[0]))
              @foreach ($videos_ativos as $video)
                <div class="col-sm-12 col-md-6 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="no-gutters align-items-center">
                        <div class="container">
                          <div class="row">
                            <div class="col-md-12 mr-2" style="padding-bottom: 1pc;text-align:center;">
                                <div type="text" class="h5 mb-0 font-weight-bold text-gray-800">{{$video->titulo}}</div>
                            </div>
                            <div class="col-md-12 mr-2" style="padding-bottom: 1pc;text-align:center;">
                                <div type="text" class="h5 mb-0 font-weight-bold text-gray-800">{{$video->descricao}}</div>
                            </div>
                          </div>
                          <div class="row" style="display: flex;justify-content: center;flex-wrap: wrap;">
                            <div class="col-md-12 col-sm-12">
                              <div class="video-container">
                                <iframe width="853" height="480" src="https://www.youtube.com/embed/{{$video->url}}" frameborder="0" allowfullscreen></iframe>
                              </div>
                            </div>
                          </div>
                          <div class="row" style="display: flex;justify-content: center;flex-wrap: wrap;padding-top: 1pc;">
                            <div class="col-md-12 col-sm-12">
                              <a href="{{route('videos.edit', [$video->id])}}" class="btn btn-info btn_editar_galeria" style="width: 100%;margin-bottom:1pc;">
                                <i class="fas fa-pen-square"></i> Editar
                              </a>
                            </div>
                            <div class="col-md-12 col-sm-12">
                              <button value="{{$video->id}}" type="button" class="btn btn-primary alterar_status_video" style="width: 100%;">
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
                  Nenhum vídeo está ativo!
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
          @if (!empty($videos_excluidos[0]))
            @foreach ($videos_excluidos as $video)
              <div class="col-sm-12 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                  <div class="card-body">
                    <div class="no-gutters align-items-center">
                      <div class="container">
                        <div class="row">
                          <div class="col-md-12 mr-2" style="padding-bottom: 1pc;text-align: center;">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$video->titulo}}</div>
                          </div>
                          <div class="col-md-12 mr-2" style="padding-bottom: 1pc;text-align:center;">
                              <div type="text" class="h5 mb-0 font-weight-bold text-gray-800">{{$video->descricao}}</div>
                          </div>
                        </div>
                        <div class="row" style="display: flex;justify-content: center;flex-wrap: wrap;">
                          <div class="col-md-12 col-sm-12">
                            <div class="video-container">
                              <iframe width="853" height="480" src="https://www.youtube.com/embed/{{$video->url}}" frameborder="0" allowfullscreen></iframe>
                            </div>
                          </div>
                        </div>
                        <div class="row" style="display: flex;justify-content: center;flex-wrap: wrap;padding-top: 1pc;">

                          <div class="col-md-12 col-sm-12">
                            <button value="{{$video->id}}" type="button" class="btn btn-primary alterar_status_video" style="width: 100%;">
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
                Nenhum vídeo está excluido!
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

$(document).on("click", ".alterar_status_video", function(){
  let id_video = $(this).val();
  // alert(id_galeria);
  $.ajax({
    url: "{{route('videos.alterar_status')}}",
    type: 'post',
    data:{
      _token: '{!! csrf_token() !!}',
      id_video:id_video,
    },

    success: function(result){
      // loading_hide();
      $('.result_ajax_videos').empty();
      $('.result_ajax_videos').html(result);
      // $('#modal_cadastro_localizacao').modal('hide');
    }
  });
});
</script>
