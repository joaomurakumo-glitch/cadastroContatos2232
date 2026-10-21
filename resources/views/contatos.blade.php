<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Lista de Contatos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body style="background-color: #386D7B;">
    <div class="row" style="margin-left: 50px; margin-top: 50px; margin-right: 50px;">
        <div class="col-sm-6">
            <div class="card" style="background-color: #6998A7; color:white">
                <div class="card-body">
                    <h5 class="card-title">Cadastrar Novo Contato</h5>
                    <form action="{{ url('/save') }}" method="POST">
                        @csrf <!-- Token de segurança no laravel p/ POST -->
                        <div class="form-group">
                            <label>Nome</label>
                            <input class="form-control rounded-pill" type="text" name="nome" value="{{ old('nome') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Telefone:</label>
                            <input class="form-control rounded-pill" type="text" name="telefone" value="{{ old('telefone') }}" required placeholder="(00) 0000-0000">
                        </div>
                        <div class="form-group">
                            <label>E-mail:</label>
                            <input class="form-control rounded-pill" type="email" name="email" value="{{ old('email') }}" required placeholder="name@example.com">
                        </div>
                        <div class="form-group">
                            <label>Endereço:</label>
                            <input class="form-control rounded-pill" type="text" name="endereco" value="{{ old('endereco') }}" required>
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            Verifique os dados informados e tente novamente.
                        </div>
                        @endif
                        <button type="submit" class="btn" style="background-color: #386D7B; color:white; margin-left: auto">Salvar Contato</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title; align-text: center">Contatos salvos</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($contatos as $c)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{$c->nome}}</strong> - {{$c->telefone}} | {{$c->email}} | {{$c->endereco}}
                            </div>
                            <div class="d-flex ml-3">
                                <a href="{{ url('/edit/' . $c->id) }}" class="btn btn-warning btn-sm mr-2">Editar</a>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal" data-delete-url="{{ route('contatos.delete', $c->id) }}" data-contact-name="{{ $c->nome }}">Excluir</button>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Excluir contato</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza de que deseja excluir <strong id="contactToDelete"></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form id="deleteContactForm" method="POST" class="m-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir contato</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $('#confirmDeleteModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget);
            $('#deleteContactForm').attr('action', button.data('delete-url'));
            $('#contactToDelete').text(button.data('contact-name'));
        });
    </script>
</body>

</html>
