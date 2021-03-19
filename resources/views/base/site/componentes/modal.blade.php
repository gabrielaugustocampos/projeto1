{{-- <!-- Modal -->
<div id="exampleModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-12 col-sm-6">
                        <div class="d-flex justify-content-center align-items-center">
                        <img src="{{asset('imagens_paginas'.'/'.$modal->imagem)}}" alt="" class="img-fluid"
                                style="margin-top: 5px!important;">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 text-justify">
                        <p class="mbr-section-title mbr-fonts-style mbr-bold display-5 text-center text-red mt-2">
                            <strong>{{$modal->titulo}}</strong></p>
                        <p class="mb-4 mbr-text mbr-fonts-style display-7 text-center text-black"><strong>{{$modal->descricao}}</strong></p>

                        <div class="form-block" style="padding: 1rem!important;">
                              
                            <form class="mbr-form display-4" action="{{route('contatos.enviar')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 p-2">
                                        <input type="text" class="form-control input" placeholder="Nome*" name="nome"
                                            title="Preencha este campo" required>
                                    </div>
                                    <div class="col-md-12 p-2">
                                        <input type="email" class="form-control input" placeholder="Email*" name="email"
                                            title="Preencha este campo" required>
                                    </div>
                                    <div class="col-md-12 p-2">
                                        <input type="text" class="form-control phone" placeholder="Telefone/Celular*"
                                            name="telefone" title="Preencha este campo" id="telefone" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-bgr btn-secondary display-7 mr-2"
                                        data-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-sm-m btn-primary display-7">Solicitar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <script>
        Swal.fire({
            type: 'success',
            title: 'Sucesso',
            text: '{!!$message!!}',
        })
    </script>
@endif --}}
