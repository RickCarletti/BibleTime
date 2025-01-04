<?php
require_once __DIR__ . '/../Models/Person.php';
require_once __DIR__ . '/../Models/PersonPerson.php';

class PersonController extends BaseController {
    public function index() {
        $dados = Person::getAll();

        // Os dados estarão disponíveis automaticamente na view
        return (['dados' => $dados]);
    }

    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['start_date'])) {
                $start_date = $_POST['start_date']; // Exemplo: '31/12/2024'
                list($day, $month, $year) = explode('/', $start_date);

                // Agora você pode salvar $day, $month e $year separadamente no banco
                $data['start_dt_day'] = $day;
                $data['start_dt_month'] = $month;
                $data['start_dt_year'] = $year;
            }

            if (!empty($_POST['end_date'])) {
                $end_date = $_POST['end_date']; // Exemplo: '31/12/2024'
                list($day, $month, $year) = explode('/', $end_date);

                // Agora você pode salvar $day, $month e $year separadamente no banco
                $data['end_dt_day'] = $day;
                $data['end_dt_month'] = $month;
                $data['end_dt_year'] = $year;
            }

            $data = [
                'name' => $_POST['name'],
                'start_dt_year' => $data['start_dt_year'],
                'start_dt_month' => $data['start_dt_month'],
                'start_dt_day' => $data['start_dt_day'],
                'end_dt_year' => $data['end_dt_year'],
                'end_dt_month' => $data['end_dt_month'],
                'end_dt_day' => $data['end_dt_day'],
                'id_group' => $_POST['id_group'],
                'sex' => $_POST['sex'],
                'update_str' => $_POST['update_str'],
                'generation' => $_POST['generation'],
                'start_unknown' => isset($_POST['start_unknown']),
                'end_unknown' => isset($_POST['end_unknown']),
                'relationships' => $_POST['relationships']
            ];

            $success = Person::insert($this->replaceEmptyStringsWithNull($data));

            if ($success) {
                $this->addSuccessMessage('Nova pessoa cadastrada com sucesso!');
            } else {
                $this->addDangerMessage('Erro ao cadastrar a pessoa.');
            }

            header('Location: /person/cadastrar');
            exit;
        } else {
            $people = Person::getAll();
            return (['people' => $people]);
        }
    }

    public function editar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['start_date'])) {
                $start_date = $_POST['start_date']; // Exemplo: '31/12/2024'
                list($day, $month, $year) = explode('/', $start_date);

                // Agora você pode salvar $day, $month e $year separadamente no banco
                $data['start_dt_day'] = $day;
                $data['start_dt_month'] = $month;
                $data['start_dt_year'] = $year;
            }

            if (!empty($_POST['end_date'])) {
                $end_date = $_POST['end_date']; // Exemplo: '31/12/2024'
                list($day, $month, $year) = explode('/', $end_date);

                // Agora você pode salvar $day, $month e $year separadamente no banco
                $data['end_dt_day'] = $day;
                $data['end_dt_month'] = $month;
                $data['end_dt_year'] = $year;
            }

            $data = [
                'name' => $_POST['name'],
                'start_dt_year' => $data['start_dt_year'],
                'start_dt_month' => $data['start_dt_month'],
                'start_dt_day' => $data['start_dt_day'],
                'end_dt_year' => $data['end_dt_year'],
                'end_dt_month' => $data['end_dt_month'],
                'end_dt_day' => $data['end_dt_day'],
                'id_group' => $_POST['id_group'],
                'sex' => $_POST['sex'],
                'update_str' => $_POST['update_str'],
                'generation' => $_POST['generation'],
                'start_unknown' => isset($_POST['start_unknown']),
                'end_unknown' => isset($_POST['end_unknown']),
                'relationships' => $_POST['relationships']
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
        $relationships = PersonPerson::getByPersonId($id);
        $people = Person::getAll();
        // Torna o registro disponível para a view
        return (['item' => $registro, 'relationships' => $relationships, 'people' => $people]);
    }

    public function excluir($id) {
        $deleted = Person::delete($id);

        if ($deleted) {
            $this->addSuccessMessage('Registro excluído com sucesso!');
        } else {
            $this->addDangerMessage('Erro ao excluir o registro.');
        }

        header('Location: /person/index');
        exit;
    }

    public function atualizar() {
        $atualizacao = Person::updateAllStr();

        if ($atualizacao) {
            $this->addSuccessMessage('Pessoas atualizadas com sucesso!');
        } else {
            $this->addDangerMessage('Erro na atualização');
        }

        header('Location: /person/index');
        exit;
    }
}
