<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema MVC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        footer {
            background-color: #f8f9fa;
            padding: 10px 0;
            text-align: center;
        }
    </style>
    <script src="https://unpkg.com/imask"></script>
</head>

<body>

    <header class="bg-secondary text-white p-1">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand">Sistema MVC</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <!-- Menu de Teste -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="menuTeste" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Teste
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="menuTeste">
                                <li><a class="dropdown-item" href="/teste/index">Consultar Testes</a></li>
                                <li><a class="dropdown-item" href="/teste/cadastrar">Cadastrar Teste</a></li>
                            </ul>
                        </li>

                        <!-- Menu de Person -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="menuPerson" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Pessoa
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="menuPerson">
                                <li><a class="dropdown-item" href="/person/index">Consultar Pessoas</a></li>
                                <li><a class="dropdown-item" href="/person/cadastrar">Cadastrar Pessoa</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Exibindo as mensagens, se existirem -->
    <?php
    if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])):
        foreach ($_SESSION['messages'] as $message):
            $type = $message['type']; // Pode ser 'success', 'warning', ou 'danger'
            $msg = $message['message'];
    ?>
            <div class="alert alert-<?= htmlspecialchars($type) ?> my-2 mx-5 alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($msg) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    <?php
        endforeach;
        // Limpa as mensagens após exibi-las, para não exibir na próxima requisição
        unset($_SESSION['messages']);
    endif;
    ?>



    <!-- Conteúdo Principal -->
    <main class="container mt-4">