<?php

require_once "./php/authentication.php";
require_once "./php/mysqlConnection.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

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

    <link rel="stylesheet" href="./css/patient.css">
    <title>Clínica</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-darkblue d-md-none">
        <div class="container-fluid">
            <a class="navbar-brand" href=".">
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
                        <a class="nav-link" href="./worker.php">
                            <i class="bi bi-journal-plus me-2"></i>
                            Novo funcionário
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-person-plus me-2"></i>
                            Novo paciente
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./list_workers.php">
                            <i class="bi bi-person-badge me-2"></i>
                            Listar funcionários
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./list_patients.php">
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
                        <a class="nav-link" href="./schedules.php">
                            <i class="bi bi-card-list me-2"></i>
                            Listar todos agendamentos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./personal_schedules.php">
                            <i class="bi bi-card-checklist me-2"></i>
                            Listar meus agendamentos
                        </a>
                    </li>
                    <hr class="bg-white">
                    <li class="nav-item">
                        <a href="./php/logout.php" class="nav-link">
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
                <a class="navbar-brand text-white" href=".">
                    Clínica Blu
                    <br>
                    <span class="text-muted">Dashboard</span>
                </a>
                <ul class="nav nav-pills flex-column mt-3 mb-auto">
                    <li>
                        <a href="./worker.php" class="nav-link">
                            <i class="bi bi-journal-plus me-2"></i>
                            <span class="d-lg-inline d-none">Novo funcionário</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link active">
                            <i class="bi bi-person-plus me-2"></i>
                            <span class="d-lg-inline d-none">Novo paciente</span>
                        </a>
                    </li>
                    <li>
                        <a href="./list_workers.php" class="nav-link">
                            <i class="bi bi-person-badge me-2"></i>
                            <span class="d-lg-inline d-none">Listar funcionários</span>
                        </a>
                    </li>
                    <li>
                        <a href="./list_patients.php" class="nav-link">
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
                        <a href="./schedules.php" class="nav-link">
                            <i class="bi bi-card-list me-2"></i>
                            <span class="d-lg-inline d-none">Listar todos agendamentos</span>
                        </a>
                    </li>
                    <li>
                        <a href="./personal_schedules.php" class="nav-link">
                            <i class="bi bi-card-checklist me-2"></i>
                            <span class="d-lg-inline d-none">Listar meus agendamentos</span>
                        </a>
                    </li>
                    <hr class="bg-white">
                    <li>
                        <a href="./php/logout.php" class="nav-link">
                            <i class="bi bi-box-arrow-left me-2"></i>
                            <span class="d-lg-inline d-none">Sair</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col p-5">
                <form action="#" class="mx-auto" method="POST">
                    <h1 class="mb-4">Cadastro de paciente</h1>
                    <div class="row">
                        <div class="col-xl-8 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name" name="name" placeholder=" " required minlength="4">
                                <label for="name" class="form-label">Nome completo</label>
                            </div>
                        </div>
                        <div class="col-xl-4 mb-3">
                            <div class="form-floating">
                                <select class="form-select" name="sex" id="sex" required>
                                    <option selected disabled value="">Selecione uma opção</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Feminino</option>
                                </select>
                                <label for="sex">Sexo</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 mb-3">
                            <div class="form-floating">
                                <input 
                                    type="email" class="form-control" id="email" name="email" placeholder=" " 
                                    required minlength="5" pattern="[a-z1-9A-Z.-_]@[a-z1-9A-Z.-_]\.[a-z1-9A-Z.-_]"
                                >
                                <label for="email" class="form-label">Email</label>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-floating">
                                <input 
                                    type="text" class="form-control" id="phone" name="phone"  placeholder="Ex: 34 9 9999-9999" 
                                    required minlength="10" pattern="[1-9]{2} [1-9]{1} [1-9]{4}-{1}[1-9]{4}"
                                >
                                <label for="phone" class="form-label">Telefone</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-floating">
                                <input 
                                    type="text" class="form-control" id="cep" name="cep" placeholder=" " 
                                    required pattern="[1-9]{5}-[1-9]{3}"
                                >
                                <label for="cep" class="form-label">CEP</label>
                            </div>
                        </div>
                        <div class="col-md-8 mb-3">
                            <div class="form-floating">
                                <input 
                                    type="text" class="form-control" id="address" name="address" placeholder=" "
                                    required minlength="3"
                                >
                                <label for="address" class="form-label">Logradouro</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <div class="form-floating">
                                <input 
                                    type="text" class="form-control" id="city" name="city" placeholder=" " 
                                    required minlength="3"
                                >
                                <label for="city" class="form-label">Cidade</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="state" name="state" placeholder=" "
                                    required minlength="2">
                                <label for="state" class="form-label">Estado</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="weight" name="weight" placeholder=" "
                                    required min="0">
                                <label for="weight" class="form-label">Peso</label>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-floating">
                                <input 
                                    type="number" class="form-control" id="height" name="height" placeholder=" "
                                    required min="0"
                                >
                                <label for="height" class="form-label">Altura</label>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-floating">
                                <input 
                                    type="text" class="form-control" id="blood" name="blood" placeholder=" "
                                    required minlength="2"
                                >
                                <label for="blood" class="form-label">Tipo sanguíneo</label>
                            </div>
                        </div>
                    </div>
                    <div class="col form-btns">
                        <button type="reset" class="btn btn-outline-dark me-3">
                            Limpar
                        </button>
                        <button type="submit" class="btn bg-darkblue">
                            Enviar
                        </button>
                    </div>
                    <div class="alert alert-success mt-3 result-message" id="registerSuccess" role="alert">
                        Paciente cadastrado com sucesso!
                    </div>
                    <div class="alert alert-danger mt-3 result-message" id="registerFail" role="alert">
                        Falha ao cadastrar paciente!
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="./js/patient_signup.js"></script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>
    
</body>

</html>