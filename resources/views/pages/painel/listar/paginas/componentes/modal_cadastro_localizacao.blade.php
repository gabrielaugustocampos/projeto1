<div class="modal fade" id="modal_cadastro_localizacao" tabindex="-1" role="dialog"
  aria-labelledby="TituloModalCentralizado" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalCentralizado">Cadastro de Localização</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="" action="index.html" method="post">
          <div class="row" style="display: flex;flex-direction: row;justify-content: center;">
            <div class="col-md-12">
              <div class="loading" style="display: flex;justify-content: center;">

              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="exampleFormControlSelect1">Nome Localização</label>
                <input type="text" class="form-control form-control-user" id="nome_localizacao"
                  placeholder="Nome Localização">
              </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="prodruto_check">Esta localização é um produto?</label>
                    <select class="form-control" id="is_produto" id="prodruto_check">
                      <option value="1">Sim</option>
                      <option value="0" selected>Não</option>
                    </select>
                  </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button id="btn_cadastro_localizacao" type="button" class="btn btn-primary">Salvar mudanças</button>
      </div>
    </div>
  </div>
</div>