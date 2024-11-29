<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="text-center">Consulta de Pessoas</h4>
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
                                <th scope="col">Nome</th>
                                <th scope="col">Ano de Início</th>
                                <th scope="col">Ano de Fim</th>
                                <th scope="col">Grupo</th>
                                <th scope="col">Geração</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dados as $item) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($item->id) ?></td>
                                    <td><?= htmlspecialchars($item->name) ?></td>
                                    <td><?= htmlspecialchars($item->start_dt_year) ?></td>
                                    <td><?= htmlspecialchars($item->end_dt_year) ?></td>
                                    <td><?= htmlspecialchars($item->id_group) ?></td>
                                    <td><?= htmlspecialchars($item->generation) ?></td>
                                    <td>
                                        <a href="/person/editar/<?= $item->id ?>" class="btn btn-warning btn-sm">Editar</a>
                                        <a href="/person/excluir/<?= $item->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este registro?')">Excluir</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

                <div class="mt-3">
                    <a href="/person/cadastrar" class="btn btn-primary">Cadastrar Nova Pessoa</a>
                </div>

            </div>
        </div>
    </div>
</div>
