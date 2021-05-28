<?php

require_once "authentication.php";
require_once "mysqlConnection.php";

$pdo = mysqlConnect();

// exitWhenNotLogged($pdo);

?>

<!doctype html>
<html lang="pt-BR">

<head>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- Common CSS -->
    <link rel="stylesheet" href="../style/style.css">

    <link rel="stylesheet" href="./css/dashboard.css">

    <title>Clínica</title>
</head>


<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-darkblue d-md-none">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                Clínica Blu <span class="text-muted">Dashboard</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="./worker.html">
                            <i class="bi bi-journal-plus me-2"></i>
                            Novo funcionário
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./patient.html">
                            <i class="bi bi-person-plus me-2"></i>
                            Novo paciente
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./list_workers.html">
                            <i class="bi bi-person-badge me-2"></i>
                            Listar funcionários
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./list_patients.html">
                            <i class="bi bi-person-lines-fill me-2"></i>
                            Listar pacientes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./addresses.php">
                            <i class="bi bi-signpost-2 me-2"></i>
                            Listar endereços
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./schedules.html">
                            <i class="bi bi-card-list me-2"></i>
                            Listar todos agendamentos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./personal_schedules.html">
                            <i class="bi bi-card-checklist me-2"></i>
                            Listar meus agendamentos
                        </a>
                    </li>
                    <hr class="bg-white">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-box-arrow-left me-2"></i>
                            Sair
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container-fluid border-1">
        <div class="row">
            <div class="d-flex flex-column flex-shrink-0 p-3 text-white d-md-block d-none bg-darkblue side-menu">
                <a class="navbar-brand text-white" href="#">
                    Clínica Blu
                    <br>
                    <span class="text-muted">Dashboard</span>
                </a>
                <ul class="nav nav-pills flex-column mt-3 mb-auto">
                    <li>
                        <a href="./worker.html" class="nav-link">
                            <i class="bi bi-journal-plus me-2"></i>
                            <span class="d-lg-inline d-none">Novo funcionário</span>
                        </a>
                    </li>
                    <li>
                        <a href="./patient.html" class="nav-link">
                            <i class="bi bi-person-plus me-2"></i>
                            <span class="d-lg-inline d-none">Novo paciente</span>
                        </a>
                    </li>
                    <li>
                        <a href="./list_workers.html" class="nav-link">
                            <i class="bi bi-person-badge me-2"></i>
                            <span class="d-lg-inline d-none">Listar funcionários</span>
                        </a>
                    </li>
                    <li>
                        <a href="./list_patients.html" class="nav-link">
                            <i class="bi bi-person-lines-fill me-2"></i>
                            <span class="d-lg-inline d-none">Listar pacientes</span>
                        </a>
                    </li>
                    <li>
                        <a href="./addresses.php" class="nav-link">
                            <i class="bi bi-signpost-2 me-2"></i>
                            <span class="d-lg-inline d-none">Listar endereços</span>
                        </a>
                    </li>
                    <li>
                        <a href="./schedules.html" class="nav-link">
                            <i class="bi bi-card-list me-2"></i>
                            <span class="d-lg-inline d-none">Listar todos agendamentos</span>
                        </a>
                    </li>
                    <li>
                        <a href="./personal_schedules.html" class="nav-link">
                            <i class="bi bi-card-checklist me-2"></i>
                            <span class="d-lg-inline d-none">Listar meus agendamentos</span>
                        </a>
                    </li>
                    <hr class="bg-white">
                    <li>
                        <a href="#" class="nav-link">
                            <i class="bi bi-box-arrow-left me-2"></i>
                            <span class="d-lg-inline d-none">Sair</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col">
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
                <h1>Olá User, seja bem-vindo!</h1>
            </div>
        </div>
    </main>


    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>
</body>

</html>