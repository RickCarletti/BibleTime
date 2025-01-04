<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="text-center">Consulta de Eventos</h4>
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
                                <th scope="col">Data</th>
                                <!-- <th scope="col">Atualização</th> -->
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dados as $item) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($item->id) ?></td>
                                    <td><?= htmlspecialchars($item->name) ?></td>
                                    <td><?= htmlspecialchars(sprintf('%02d/%02d/%04d', $item->day, $item->month, $item->year)) ?></td>
                                    <!-- <td><?= htmlspecialchars($item->update_str) ?></td> -->
                                    <td>
                                        <a href="/event/editar/<?= $item->id ?>" class="btn btn-warning btn-sm">Editar</a>
                                        <a href="/event/excluir/<?= $item->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este registro?')">Excluir</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

                <div class="mt-3">
                    <a href="/event/cadastrar" class="btn btn-primary">Cadastrar Novo Evento</a>
                </div>

            </div>
        </div>
    </div>
</div>