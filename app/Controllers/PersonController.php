<?php
require_once __DIR__ . '/../Models/Person.php';

class PersonController extends BaseController
{
    public function index()
    {
        $dados = Person::getAll();

        // Os dados estarão disponíveis automaticamente na view
        return (['dados' => $dados]);
    }

    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'start_dt_year' => $_POST['start_dt_year'],
                'start_dt_month' => $_POST['start_dt_month'],
                'start_dt_day' => $_POST['start_dt_day'],
                'end_dt_year' => $_POST['end_dt_year'],
                'end_dt_month' => $_POST['end_dt_month'],
                'end_dt_day' => $_POST['end_dt_day'],
                'id_group' => $_POST['id_group'],
                'sex' => $_POST['sex'],
                'update_str' => $_POST['update_str'],
                'generation' => $_POST['generation'],
                'start_unknown' => isset($_POST['start_unknown']),
                'end_unknown' => isset($_POST['end_unknown']),
            ];

            $success = Person::insert($this->replaceEmptyStringsWithNull($data));

            if ($success) {
                $this->addSuccessMessage('Nova pessoa cadastrada com sucesso!');
            } else {
                $this->addDangerMessage('Erro ao cadastrar a pessoa.');
            }

            header('Location: /person/index');
            exit;
        }
    }

    public function editar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'start_dt_year' => $_POST['start_dt_year'],
                'start_dt_month' => $_POST['start_dt_month'],
                'start_dt_day' => $_POST['start_dt_day'],
                'end_dt_year' => $_POST['end_dt_year'],
                'end_dt_month' => $_POST['end_dt_month'],
                'end_dt_day' => $_POST['end_dt_day'],
                'id_group' => $_POST['id_group'],
                'sex' => $_POST['sex'],
                'update_str' => $_POST['update_str'],
                'generation' => $_POST['generation'],
                'start_unknown' => isset($_POST['start_unknown']),
                'end_unknown' => isset($_POST['end_unknown']),
            ];

            $updated = Person::update($id, $this->replaceEmptyStringsWithNull($data));

            if ($updated) {
                $this->addSuccessMessage('Registro atualizado com sucesso!');
            } else {
                $this->addDangerMessage('Erro ao atualizar o registro.');
            }

            header('Location: /person/index');
            exit;
        }

        $registro = Person::getById($id);

        // Torna o registro disponível para a view
        return (['item' => $registro]);
    }

    public function excluir($id)
    {
        $deleted = Person::delete($id);

        if ($deleted) {
            $this->addSuccessMessage('Registro excluído com sucesso!');
        } else {
            $this->addDangerMessage('Erro ao excluir o registro.');
        }

        header('Location: /person/index');
        exit;
    }
}
