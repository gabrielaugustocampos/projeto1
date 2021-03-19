<div class="form-group">
  <!-- <label for="exampleFormControlSelect1">Localização</label> -->
  <select class="form-control" id="select_localizacao">
    <option selected value="none">Selecione uma Localização</option>
    @foreach ($localizacao as $item)
      <option value="{{$item->id_localizacao_texto}}">{{$item->nome}}</option>
    @endforeach
  </select>
</div>
