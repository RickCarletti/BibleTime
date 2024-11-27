<?php
// index.php

// Incluindo controladores e modelos necessários
require_once __DIR__ . '/app/Controllers/TesteController.php';

$request = $_SERVER['REQUEST_URI'];

// Roteamento para a página de consulta
switch ($request) {
    case '/':
    case '/consulta':
        $controller = new TesteController();
        $controller->consulta();
        break;

    case '/inserir': // Página para inserção de dados
        $controller = new TesteController();
        $controller->inserir();
        break;

    case '/editar/' . preg_replace('/[^0-9]/', '', $_SERVER['REQUEST_URI']):
        $id = preg_replace('/[^0-9]/', '', $_SERVER['REQUEST_URI']);
        $controller = new TesteController();
        $controller->editar($id);
        break;

    case (preg_match('/\/excluir\/(\d+)/', $request, $matches) ? true : false):
        $controller = new TesteController();
        $controller->excluir($matches[1]);
        break;

    default:
        echo "Página não encontrada!";
        break;
}
