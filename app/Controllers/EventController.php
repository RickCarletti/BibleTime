<?php
require_once __DIR__ . '/../Models/Event.php';

class EventController extends BaseController {
    public function index() {
        $dados = Event::getAll();

        // Os dados estarão disponíveis automaticamente na view
        return ['dados' => $dados];
    }

    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['date'])) {
                $date = $_POST['date']; // Exemplo: '31/12/2024'
                list($day, $month, $year) = explode('/', $date);

                // Armazenar o dia, mês e ano separadamente
                $data['day'] = $day;
                $data['month'] = $month;
                $data['year'] = $year;
            }

            $data = [
                'name' => $_POST['name'],
                'day' => $data['day'] ?? null,
                'month' => $data['month'] ?? null,
                'year' => $data['year'] ?? null,
                'update_str' => $_POST['update_str']
            ];

            $success = Event::insert($this->replaceEmptyStringsWithNull($data));

            if ($success) {
                $this->addSuccessMessage('Evento cadastrado com sucesso!');
            } else {
                $this->addDangerMessage('Erro ao cadastrar o evento.');
            }

            header('Location: /event/cadastrar');
            exit;
        } else {
            return [];
        }
    }

    public function editar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['date'])) {
                $date = $_POST['date']; // Exemplo: '31/12/2024'
                list($day, $month, $year) = explode('/', $date);

                // Armazenar o dia, mês e ano separadamente
                $data['day'] = $day;
                $data['month'] = $month;
                $data['year'] = $year;
            }

            $data = [
                'name' => $_POST['name'],
                'day' => $data['day'] ?? null,
                'month' => $data['month'] ?? null,
                'year' => $data['year'] ?? null,
                'update_str' => $_POST['update_str']
            ];

            $updated = Event::update($id, $this->replaceEmptyStringsWithNull($data));

            if ($updated) {
                $this->addSuccessMessage('Evento atualizado com sucesso!');
            } else {
                $this->addDangerMessage('Erro ao atualizar o evento.');
            }

            header('Location: /event/index');
            exit;
        }

        $registro = Event::getById($id);
        return ['item' => $registro];
    }

    public function excluir($id) {
        $deleted = Event::delete($id);

        if ($deleted) {
            $this->addSuccessMessage('Evento excluído com sucesso!');
        } else {
            $this->addDangerMessage('Erro ao excluir o evento.');
        }

        header('Location: /event/index');
        exit;
    }
}
