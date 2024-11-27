<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Registros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="text-center">Consulta de Registros</h4>
                    </div>
                    <div class="card-body">

                        <!-- Verifica se há resultados para exibir -->
                        <?php if (empty($dados)) : ?>
                            <div class="alert alert-warning" role="alert">
                                Não há registros disponíveis.
                            </div>
                        <?php else : ?>
                            <!-- Tabela de resultados -->
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Descrição</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dados as $item) : ?>
                                        <tr>
                                            <td><?= htmlspecialchars($item->id) ?></td>
                                            <td><?= htmlspecialchars($item->descricao) ?></td>
                                            <td>
                                                <a href="/editar/<?= $item->id ?>" class="btn btn-warning btn-sm">Editar</a>
                                                <a href="/excluir/<?= $item->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este registro?')">Excluir</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>

                        <div class="mt-3">
                            <a href="/inserir" class="btn btn-primary">Cadastrar Novo Registro</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>