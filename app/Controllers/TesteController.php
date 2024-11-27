<?php
// Inclua o modelo Teste para interagir com o banco de dados
require_once __DIR__ . '/../Models/Teste.php';

class TesteController
{

    public function consulta()
    {
        // Lógica para buscar e exibir os registros
        $dados = Teste::getAll();
        include __DIR__ . '/../Views/consulta.php';
    }

    public function inserir()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Quando o formulário for enviado
            $descricao = $_POST['descricao'];

            // Chama o modelo para inserir os dados no banco
            Teste::insert($descricao);

            // Redireciona para a tela de consulta após inserção
            header('Location: /consulta');
            exit;
        }

        // Exibe o formulário de inserção
        include __DIR__ . '/../Views/cadastrar.php';
    }

    public function editar($id)
    {
        // Verifica se foi enviado o formulário para editar o item
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $descricao = $_POST['descricao'];
            Teste::update($id, $descricao); // Atualiza o item
            header('Location: /consulta');  // Redireciona para a consulta
            exit;
        }

        // Pega o item do banco de dados para preencher o formulário
        $item = Teste::getById($id);
        include __DIR__ . '/../Views/editar.php'; // Exibe a view de edição
    }


    public function excluir($id)
    {
        // Lógica para excluir um registro
        Teste::delete($id);
        header('Location: /consulta');
        exit;
    }
}
