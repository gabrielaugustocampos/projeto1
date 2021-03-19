@foreach ($fotos_ativas as $foto)
  <div class="col-md-4 col-sm-12 col-xl-3">
    <form action="/editar/foto/titulo" method="post">
      @csrf
    <div class="col-md-12">
      <img class="file-upload-image" src="{{asset('imagens_galerias').'/'.$foto->imagem}}" alt="your image" />
      <input type="hidden" name="id_imagem" value="{{$foto->id_galeria}}">
      <input type="text" style="text-align:center;" name="titulo" class="image_input" value="{{$foto->titulo}}" /><i style="padding-left: 5px;color: #36b9cc;" class="fas fa-edit"></i>
    </div>
    <div class="align_btn_img" style="display: flex;flex-wrap: wrap;justify-content: center;">
      <div class="col-md-12">
        <div class="image-title-wrap">
          <button id="btn_salvar_imagem" onclick="loading_show()" style="width:100%;" type="submit" value="{{$foto->id_galeria}}" class="btn btn-primary"><i class="fas fa-cloud-upload-alt"></i> Salvar alterações</button>
        </div>
      </div>
      <div class="col-md-12">
        <div class="image-title-wrap">
          <button style="width:100%;" type="button" value="{{$foto->id_galeria}}" class="btn btn-danger"><i class="fas fa-trash btn_excluir_imagem"></i> Excluir</button>
        </div>
      </div>
    </div>
  </form>
  </div>
@endforeach
