<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Novo Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="text-center">Cadastrar Novo Registro</h4>
                    </div>
                    <div class="card-body">
                        <form action="/inserir" method="POST">
                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição</label>
                                <input type="text" id="descricao" name="descricao" class="form-control" placeholder="Digite uma descrição" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Inserir</button>
                            </div>
                        </form>

                        <div class="mt-3">
                            <a href="/consulta" class="btn btn-secondary">Voltar para Consulta</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>