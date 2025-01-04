<?php
require_once __DIR__ . '/../Models/Person.php';
require_once __DIR__ . '/../Models/PersonPerson.php';

class GraphicController extends BaseController {
    public function index() {
        $pessoas = Person::getAll();
        $relacionamentos = PersonPerson::getAll();

        // Os dados estarão disponíveis automaticamente na view
        return (['persons' => $pessoas, 'relationships' => $relacionamentos]);
    }
}
