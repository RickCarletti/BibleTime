<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="text-center">Editar Pessoa</h4>
            </div>
            <div class="card-body">
                <!-- Formulário de Edição -->
                <form action="/person/editar/<?= $item->id ?>" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" id="name" name="name" class="form-control"
                            placeholder="Digite o nome" value="<?= htmlspecialchars($item->name) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Data de Inicio</label>
                        <input type="text" id="start_date" name="start_date" class="form-control" placeholder="DD/MM/AAAA" value="<?= isset($item->start_dt_day, $item->start_dt_month, $item->start_dt_year) ? sprintf('%02d/%02d/%04d', $item->start_dt_day, $item->start_dt_month, $item->start_dt_year) : '' ?>">
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label">Data de Fim</label>
                        <input type="text" id="end_date" name="end_date" class="form-control" placeholder="DD/MM/AAAA" value="<?= isset($item->end_dt_day, $item->end_dt_month, $item->end_dt_year) ? sprintf('%02d/%02d/%04d', $item->end_dt_day, $item->end_dt_month, $item->end_dt_year) : '' ?>">
                    </div>

                    <div class="mb-3">
                        <label for="id_group" class="form-label">Grupo</label>
                        <input type="number" id="id_group" name="id_group" class="form-control"
                            placeholder="Digite o ID do grupo" value="<?= htmlspecialchars($item->id_group) ?>">
                    </div>

                    <div class="mb-3">
                        <label for="sex" class="form-label">Sexo</label>
                        <select id="sex" name="sex" class="form-select">
                            <option value="" <?= empty($item->sex) ? 'selected' : '' ?>>Selecione</option>
                            <option value="M" <?= $item->sex === 'M' ? 'selected' : '' ?>>Masculino</option>
                            <option value="F" <?= $item->sex === 'F' ? 'selected' : '' ?>>Feminino</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="update_str" class="form-label">Atualização</label>
                        <textarea name="update_str" id="update_str" class="form-control" placeholder="Informação adicional" rows="10"><?= htmlspecialchars($item->update_str) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="generation" class="form-label">Geração</label>
                        <input type="number" id="generation" name="generation" class="form-control"
                            placeholder="Número da geração" value="<?= htmlspecialchars($item->generation) ?>">
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" id="start_unknown" name="start_unknown" class="form-check-input"
                            <?= $item->start_unknown ? 'checked' : '' ?>>
                        <label for="start_unknown" class="form-check-label">Início desconhecido</label>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" id="end_unknown" name="end_unknown" class="form-check-input"
                            <?= $item->end_unknown ? 'checked' : '' ?>>
                        <label for="end_unknown" class="form-check-label">Fim desconhecido</label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Relacionamentos</label>
                        <div id="relationship-container">
                            <?php if (!empty($relationships)): ?>
                                <?php foreach ($relationships as $index => $relationship): ?>
                                    <div class="row mb-2 relationship-item">
                                        <div class="col-md-4">
                                            <select name="relationships[<?= $index ?>][id_person_1]" class="form-select" required>
                                                <option value="">Selecione uma pessoa</option>
                                                <?php foreach ($people as $person): ?>
                                                    <option value="<?= $person->id ?>" <?= $person->id == $relationship->id_person_1 ? 'selected' : '' ?>>
                                                        [<?= htmlspecialchars($person->id) ?>] <?= htmlspecialchars($person->name) ?>(<?= htmlspecialchars($person->generation) ?>)
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="relationships[<?= $index ?>][id_person_2]" class="form-select" required>
                                                <option value="">Selecione uma pessoa</option>
                                                <?php foreach ($people as $person): ?>
                                                    <option value="<?= $person->id ?>" <?= $person->id == $relationship->id_person_2 ? 'selected' : '' ?>>
                                                        [<?= htmlspecialchars($person->id) ?>] <?= htmlspecialchars($person->name) ?>(<?= htmlspecialchars($person->generation) ?>)
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="relationships[<?= $index ?>][relationship]" class="form-control"
                                                placeholder="Tipo de relacionamento" value="<?= htmlspecialchars($relationship->relationship) ?>" required>
                                        </div>
                                        <div class="col-md-1 text-end">
                                            <button type="button" class="btn btn-danger btn-sm remove-relationship-btn">Remover</button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <button type="button" class="btn btn-primary btn-sm mt-2" id="add-relationship-btn">Adicionar Relacionamento</button>
                    </div>

                    <!-- Botão para salvar -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Salvar Alterações</button>
                    </div>
                </form>

                <div class="mt-3">
                    <a href="/person/index" class="btn btn-secondary">Voltar para Consulta</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('add-relationship-btn').addEventListener('click', function() {
        const container = document.getElementById('relationship-container');
        const index = container.children.length;

        // Obtém o ID da pessoa atual
        const currentPersonId = <?= $item->id ?>;

        const relationshipDiv = document.createElement('div');
        relationshipDiv.classList.add('row', 'mb-2', 'relationship-item');
        relationshipDiv.innerHTML = `
        <div class="col-md-4">
            <select name="relationships[${index}][id_person_1]" class="form-select" required>
                <option value="">Selecione uma pessoa</option>
                <?php foreach ($people as $person): ?>
                    <option value="<?= $person->id ?>" <?= $person->id == $item->id ? 'selected' : '' ?>>
                        [<?= htmlspecialchars($person->id) ?>] <?= htmlspecialchars($person->name) ?>(<?= htmlspecialchars($person->generation) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <select name="relationships[${index}][id_person_2]" class="form-select" required>
                <option value="">Selecione uma pessoa</option>
                <?php foreach ($people as $person): ?>
                    <option value="<?= $person->id ?>">[<?= htmlspecialchars($person->id) ?>] <?= htmlspecialchars($person->name) ?>(<?= htmlspecialchars($person->generation) ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3">
            <input type="text" name="relationships[${index}][relationship]" class="form-control" 
                placeholder="Tipo de relacionamento" required>
        </div>
        <div class="col-md-1 text-end">
            <button type="button" class="btn btn-danger btn-sm remove-relationship-btn">Remover</button>
        </div>
    `;

        container.appendChild(relationshipDiv);
        attachRemoveEvent(relationshipDiv.querySelector('.remove-relationship-btn'));
    });

    function attachRemoveEvent(button) {
        button.addEventListener('click', function() {
            const relationshipItem = button.closest('.relationship-item');
            relationshipItem.remove();
        });
    }

    document.querySelectorAll('.remove-relationship-btn').forEach(attachRemoveEvent);
</script>


<script>
    // Seleciona o campo de data
    const endDateInput = document.getElementById('end_date');
    const startDateInput = document.getElementById('start_date');

    // Aplica a máscara
    const mask_start = IMask(endDateInput, {
        mask: '00/00/0000',
        lazy: true, // Mostra o placeholder
        blocks: {
            dd: {
                mask: IMask.MaskedRange,
                from: 1,
                to: 31, // Limita o dia para o intervalo de 1 a 31
            },
            mm: {
                mask: IMask.MaskedRange,
                from: 1,
                to: 12, // Limita o mês para o intervalo de 1 a 12
            },
            yyyy: {
                mask: IMask.MaskedRange
            },
        },
    });

    const mask_end = IMask(startDateInput, {
        mask: '00/00/0000',
        lazy: true, // Mostra o placeholder
        blocks: {
            dd: {
                mask: IMask.MaskedRange,
                from: 1,
                to: 31, // Limita o dia para o intervalo de 1 a 31
            },
            mm: {
                mask: IMask.MaskedRange,
                from: 1,
                to: 12, // Limita o mês para o intervalo de 1 a 12
            },
            yyyy: {
                mask: IMask.MaskedRange
            },
        },
    });
</script>