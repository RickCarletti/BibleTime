<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="text-center">Editar Registro</h4>
            </div>
            <div class="card-body">
                <!-- Formulário de Edição -->
                <form action="/teste/editar/<?= $item->id ?>" method="POST">
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" id="descricao" name="descricao" class="form-control"
                            placeholder="Digite uma nova descrição" value="<?= htmlspecialchars($item->descricao) ?>" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Salvar Alterações</button>
                    </div>
                </form>

                <div class="mt-3">
                    <a href="/teste/index" class="btn btn-secondary">Voltar para Consulta</a>
                </div>
            </div>
        </div>
    </div>
</div>