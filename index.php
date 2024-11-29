<?php
// Autoload para carregar automaticamente controladores e modelos
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/app/Controllers/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

$requestUri = trim($_SERVER['REQUEST_URI'], '/');
$requestParts = explode('/', $requestUri);

// Extrair controlador, ação e parâmetros
$controllerName = ucfirst(strtolower(!empty($requestParts[0]) ? $requestParts[0] : 'person')) . 'Controller';
$action = $requestParts[1] ?? 'index';
$param = $requestParts[2] ?? null;

session_start(); // Inicia a sessão

try {
    if (class_exists($controllerName)) {
        $controller = new $controllerName();
        if (method_exists($controller, $action)) {
            // Executa a ação e captura o retorno
            ob_start();
            $data = $controller->$action($param) ?? []; // Retorna os dados ou array vazio
            $output = ob_get_clean();

            if (!headers_sent() && empty($output)) {
                renderAutomaticView($controllerName, $action, $data);
            } else {
                echo $output; // Exibe saída capturada
            }
        } else {
            throw new Exception("Ação '{$action}' não encontrada no controlador '{$controllerName}'.");
        }
    } else {
        throw new Exception("Controlador '{$controllerName}' não encontrado.");
    }
} catch (Exception $e) {
    http_response_code(404);
    echo "Erro 404: " . $e->getMessage();
}

// Função para renderizar views automaticamente
function renderAutomaticView($controllerName, $action, $data = [])
{
    $controllerName = str_replace('Controller', '', $controllerName); // Remove 'Controller'
    $viewPath = __DIR__ . "/app/Views/{$controllerName}/{$action}.php";

    if (file_exists($viewPath)) {
        // Torna as variáveis disponíveis na view
        extract($data);

        require_once __DIR__ . '/app/Views/layout/header.php';
        require_once $viewPath;
        require_once __DIR__ . '/app/Views/layout/footer.php';
    } else {
        throw new Exception("View '{$controllerName}/{$action}.php' não encontrada.");
    }
}
