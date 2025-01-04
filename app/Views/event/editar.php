<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="text-center">Editar Evento</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome do Evento</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Digite o nome do evento"
                            value="<?= htmlspecialchars($item->name ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Data</label>
                        <input type="text" id="date" name="date" class="form-control" placeholder="DD/MM/AAAA"
                            value="<?= isset($item->day, $item->month, $item->year) ? sprintf('%02d/%02d/%04d', $item->day, $item->month, $item->year) : '' ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="update_str" class="form-label">Informações Adicionais</label>
                        <input type="text" id="update_str" name="update_str" class="form-control" placeholder="Informações adicionais"
                            value="<?= htmlspecialchars($item->update_str ?? '') ?>">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Atualizar</button>
                    </div>
                </form>

                <div class="mt-3">
                    <a href="/event/index" class="btn btn-secondary">Voltar para Consulta</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Aplica máscara ao campo de data
    const dateInput = document.getElementById('date');
    IMask(dateInput, {
        mask: '00/00/0000',
        lazy: true,
        blocks: {
            dd: {
                mask: IMask.MaskedRange,
                from: 1,
                to: 31
            },
            mm: {
                mask: IMask.MaskedRange,
                from: 1,
                to: 12
            },
            yyyy: {
                mask: IMask.MaskedRange
            }
        }
    });
</script>