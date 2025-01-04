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

    <!-- INI: VIS -->
    <!-- INI: VIS-NETWORK -->
    <script type="text/javascript" src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>
    <!-- END: VIS-NETWORK -->
    <!-- INI: VIS-TIMELINE -->
    <script type="text/javascript"
        src="https://unpkg.com/vis-timeline@latest/standalone/umd/vis-timeline-graph2d.min.js"></script>
    <link href="https://unpkg.com/vis-timeline@latest/styles/vis-timeline-graph2d.min.css" rel="stylesheet"
        type="text/css" />
    <!-- END: VIS-TIMELINE -->
    <!-- END: VIS -->

    <!-- INI: BOOTSTRAP -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- END: BOOTSTRAP -->

    <!-- INI: CONFIGS PESSOAIS -->
    <style>
        .base {
            width: 100%;
            /* Preencherá toda a largura do elemento pai */
            min-height: 200px;
            /* Defina uma altura fixa ou ajustável */
            border-radius: 2%;
        }

        #nodes_base {
            width: 100%;
            /* Preencherá toda a largura do elemento pai */
            height: 300px;
            /* Defina uma altura fixa ou ajustável */
            border: 1px solid lightgray;
        }
        #custom-axis {
            height: 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #ddd;
            padding: 0 10px;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .axis-label {
            text-align: center;
        }
    </style>
    <!-- END: CONFIGS PESSOAIS -->
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
                                <li><a class="dropdown-item" href="/person/atualizar">Atualizar Pessoas</a></li>
                            </ul>
                        </li>


                        <!-- Menu de Event -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="menuEvent" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Evento
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="menuEvent">
                                <li><a class="dropdown-item" href="/event/index">Consultar Eventos</a></li>
                                <li><a class="dropdown-item" href="/event/cadastrar">Cadastrar Evento</a></li>
                            </ul>
                        </li>

                        <!-- Menu de Event -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="/graphic/index">
                                Graficos
                            </a>
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