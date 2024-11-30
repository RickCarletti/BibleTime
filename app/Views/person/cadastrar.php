<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="text-center">Cadastrar Nova Pessoa</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Digite o nome" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Data de Início</label>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="number" name="start_dt_year" class="form-control" placeholder="Ano">
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="start_dt_month" class="form-control" placeholder="Mês">
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="start_dt_day" class="form-control" placeholder="Dia">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Data de Fim</label>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="number" name="end_dt_year" class="form-control" placeholder="Ano">
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="end_dt_month" class="form-control" placeholder="Mês">
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="end_dt_day" class="form-control" placeholder="Dia">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="id_group" class="form-label">Grupo</label>
                        <input type="number" id="id_group" name="id_group" class="form-control" placeholder="Digite o ID do grupo">
                    </div>

                    <div class="mb-3">
                        <label for="sex" class="form-label">Sexo</label>
                        <select id="sex" name="sex" class="form-select">
                            <option value="">Selecione</option>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="update_str" class="form-label">Atualização</label>
                        <input type="text" id="update_str" name="update_str" class="form-control" placeholder="Informação adicional">
                    </div>

                    <div class="mb-3">
                        <label for="generation" class="form-label">Geração</label>
                        <input type="number" id="generation" name="generation" class="form-control" placeholder="Número da geração">
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" id="start_unknown" name="start_unknown" class="form-check-input">
                        <label for="start_unknown" class="form-check-label">Início desconhecido</label>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" id="end_unknown" name="end_unknown" class="form-check-input">
                        <label for="end_unknown" class="form-check-label">Fim desconhecido</label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Relacionamentos</label>
                        <div id="relationship-container">
                        </div>
                        <button type="button" class="btn btn-primary btn-sm mt-2" id="add-relationship-btn">Adicionar Relacionamento</button>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Inserir</button>
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
    // Script para adicionar relacionamentos
    document.getElementById('add-relationship-btn').addEventListener('click', function() {
        const container = document.getElementById('relationship-container');
        const index = container.children.length;

        const relationshipDiv = document.createElement('div');
        relationshipDiv.classList.add('row', 'mb-2', 'relationship-item');
        relationshipDiv.innerHTML = `
            <div class="col-md-5">
                <select name="relationships[${index}][id_person_2]" class="form-select" required>
                    <option value="">Selecione uma pessoa</option>
                    <?php foreach ($people as $person): ?>
                        <option value="<?= $person->id ?>"><?= htmlspecialchars($person->name) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-5">
                <input type="text" name="relationships[${index}][relationship]" class="form-control" 
                    placeholder="Tipo de relacionamento" required>
            </div>
            <div class="col-md-2 text-end">
                <button type="button" class="btn btn-danger btn-sm remove-relationship-btn">Remover</button>
            </div>
        `;

        container.appendChild(relationshipDiv);
        attachRemoveEvent(relationshipDiv.querySelector('.remove-relationship-btn'));
    });

    // Função para anexar o evento de remover
    function attachRemoveEvent(button) {
        button.addEventListener('click', function() {
            const relationshipItem = button.closest('.relationship-item');
            relationshipItem.remove();
        });
    }

    // Anexa o evento a botões existentes (na tela de edição)
    document.querySelectorAll('.remove-relationship-btn').forEach(attachRemoveEvent);
</script>