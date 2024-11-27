<?php
require_once __DIR__ . '/../Models/Teste.php';

class TesteController extends BaseController
{
    public function index()
    {
        $dados = Teste::getAll();

        // Os dados estarão disponíveis automaticamente na view
        return (['dados' => $dados]);
    }

    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $descricao = $_POST['descricao'];
            $success = Teste::insert($descricao);

            if ($success) {
                // Mensagem de sucesso
                $this->addSuccessMessage('Novo registro adicionado com sucesso!');
            } else {
                // Mensagem de erro
                $this->addDangerMessage('Erro ao adicionar o registro.');
            }

            // Redireciona para consulta após inserção
            header('Location: /teste/index');
            exit;
        }
    }

    public function editar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $descricao = $_POST['descricao'];
            // Suponha que Teste::update seja um método que atualiza o banco de dados
            $updated = Teste::update($id, $descricao);

            if ($updated) {
                // Mensagem de sucesso
                $this->addSuccessMessage('Registro atualizado com sucesso!');
            } else {
                // Mensagem de erro
                $this->addDangerMessage('Erro ao atualizar o registro.');
            }

            // Redireciona para consulta após edição
            header('Location: /teste/index');
            exit;
        }

        $registro = Teste::getById($id);

        // Torna o registro disponível para a view
        return (['item' => $registro]);
    }

    public function excluir($id)
    {
        $deleted = Teste::delete($id);

        if ($deleted) {
            // Mensagem de sucesso
            $this->addSuccessMessage('Registro Excluido com sucesso!');
        } else {
            // Mensagem de erro
            $this->addDangerMessage('Erro ao excluir o registro.');
        }

        // Redireciona para consulta após edição
        header('Location: /teste/index');
        exit;
    }
}
