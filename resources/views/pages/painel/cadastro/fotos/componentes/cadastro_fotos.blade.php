<style media="screen">

  .image_input{
    border: 0px;
    background-color: transparent;
    margin-bottom: 1pc;
  }

</style>

<div class="container-fluid">
  <form id="cadastro_titulo_galeria" action="/galeria/editar/titulo" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row" style="display: flex;flex-direction: row;align-items: flex-end;justify-content: center;">
      <div class="col-md-8">
        <div class="form-group">
          <label for="exampleFormControlSelect1">Titulo</label>
          <input type="hidden" name="id_galeria" value="{{$id}}">
          @if (!empty($galeria->nome))
            <input type="text" class="form-control form-control-user" name="titulo_pagina" value="{{$galeria->nome}}" placeholder="Titulo da galeria">
          @else
            <input type="text" class="form-control form-control-user" name="titulo_pagina" placeholder="Titulo da galeria">
          @endif
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group" style="width: 100%;">
          <button id="btn_editar_titulo_galeria" type="submit" onclick="loading_show()" class="btn btn-info" style="width: 100%;">
            <i class="fas fa-folder-plus"></i> Salvar
          </button>
        </div>
      </div>
    </div>
  </form>
  @if(session()->has('success'))
     <div class="alert alert-success">
         {{ session()->get('success') }}
     </div>
   @elseif (session()->has('error'))
     <div class="alert alert-danger">
         {{ session()->get('error') }}
     </div>
   @endif
    <div class="form-group" style="width: 100%;">
      <div class="col-md-12">
        <div class="loading" style="display:flex;justify-content:center;">

        </div>
      </div>
      <div class="file-upload">
        <form id="form_cadastro_fotos" action="/cadastro/fotos" method="post" enctype="multipart/form-data">
          @csrf

        <input id="input_upload_imagem" style="display:none;" multiple type='file' name="imagem[]" accept="image/*">
        <input type="hidden" name="id_localizacao_galeria" value="{{$id}}">
        <div class="image-upload-wrap">
          <div class="col-md-12 col-sm-12">
            <div class="file-upload-input"></div>
            <div class="drag-text">
              <h3 style="">Selecione uma imagem</h3>
            </div>
          </div>
        </div>
        </form>
        @if (!empty($fotos_ativas[0]))
          <h3 style="text-align:center;padding-top:1pc;">Fotos</h3>
          <div class="file-upload-content" style="display: flex;flex-wrap: wrap;">
            @foreach ($fotos_ativas as $foto)
              <div class="col-md-4 col-sm-12 col-xl-3">
                <form action="/editar/foto/titulo" method="post">
                  @csrf
                <div class="col-md-12">
                  <div class="alinhamento">
                  <img class="file-upload-image" src="{{asset('imagens_galerias').'/'.$foto->imagem}}" alt="your image" />
                  <input type="hidden" name="id_imagem" value="{{$foto->id_galeria}}">
                  <div class="">
                   <input type="text" style="text-align:center;" name="titulo" class="image_input" value="{{$foto->titulo}}" /><i style="padding-left: 5px;color: #36b9cc;" class="fas fa-edit"></i>
                 </div>
                </div>
                </div>
                <div class="align_btn_img" style="display: flex;flex-wrap: wrap;justify-content: center;">
                  <div class="col-md-12">
                    <div class="image-title-wrap">
                      <button id="btn_salvar_imagem" onclick="loading_show()" style="width:100%;" type="submit" value="{{$foto->id_galeria}}" class="btn btn-primary"><i class="fas fa-cloud-upload-alt"></i> Salvar alterações</button>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="image-title-wrap">
                      <button style="width:100%;" type="button" value="{{$foto->id_galeria}}" class="btn btn-danger btn_excluir_imagem"><i class="fas fa-trash"></i> Excluir</button>
                    </div>
                  </div>
                </div>
              </form>
              </div>
            @endforeach
          </div>

        @else
          <div class="file-upload-content" style="display: flex;flex-wrap: wrap;padding-top: 1pc;">
            <div class="col-md-12">
              <div class="alert alert-info" role="alert" style="text-align: center;">
                Nenhuma foto cadastrada!
              </div>
            </div>
          </div>
        @endif
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

  $(document).on("click",".image-upload-wrap",function() {
    $('#input_upload_imagem').click();
  });

  // $(document).on("ready","#input_upload_imagem",function(e) {
    //   if(e.target.files.length == 0) {
      //     $('.file-upload-image').attr('src', '');
      //     $('.file-upload-content').show();
      //     $('#input_upload_imagem').val('');
      //
      //   } else {
        //     for (var i = 0; i < e.target.files.length; i++) {
          //       // $('#nome_imagem').append(e.target.files[i].name);
          //       $('#img').append("<img class='file-upload-image' src='"+URL.createObjectURL(event.target.files[i])+"'>");
          //     }
          //     $('.image-upload-wrap').hide();
          //
          //     $('.file-upload-content').show();
          //   }
          // });
  $(document).on("click", ".btn_excluir_imagem", function(){
    let id_foto = $(this).val();
    $.ajax({
      url: "{{url('/excluir/foto/')}}",
      type: 'post',
      data:{
        _token: '{!! csrf_token() !!}',
        id_foto:id_foto,
      },
      beforeSend: function(){
        loading_show();
      },

      success: function(result){
        loading_hide();
        $(".file-upload-content").empty();
        $(".file-upload-content").html(result);
      }
    });
  });

          $(document).on("change","#input_upload_imagem",function(e) {
            if(e.target.files.length == 0) {
              $('.file-upload-image').attr('src', '');
              $('.file-upload-content').show();
              $('#input_upload_imagem').val('');

            } else {
              $('.file-upload').hide();
              loading_show();
              $( "#form_cadastro_fotos" ).submit();
              // for (var i = 0; i < e.target.files.length; i++) {
                //   $('#img').append("<img class='file-upload-image' src='"+URL.createObjectURL(event.target.files[i])+"'>");
                // }
                // <img class="file-upload-image" src="#" alt="your image" />
                // $('.file-upload-image').attr('src', URL.createObjectURL(event.target.files[0]));
                // $('#input_upload_imagem').val(URL.createObjectURL(event.target.files[0]));
                // $('.image-upload-wrap').hide();
                //
                // $('.file-upload-content').show();
              }
            });
          </script>
