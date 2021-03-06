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

    <link rel="stylesheet" href="./css/list.css">

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
                        <a class="nav-link" href="./patient.php">
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
                        <a class="nav-link" href="#">
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
                        <a href="./patient.php" class="nav-link">
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
                        <a href="#" class="nav-link active">
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
                <?php
                    $email = $_SESSION["email"];
                    echo "<h1>Agendamentos de $email</h1>"
                ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Data</th>
                            <th scope="col">Horário</th>
                            <th scope="col">Paciente</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                            $email = $_SESSION['email'];
                            $sql = <<<SQL
                                SELECT data, horario, agenda.nome as nome_paciente, agenda.sexo, agenda.email
                                FROM agenda INNER JOIN medico ON agenda.codigo_medico = medico.codigo
                                INNER JOIN pessoa ON medico.codigo = pessoa.codigo
                                WHERE pessoa.email = ?
                                ORDER BY data
                            SQL;

                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([$email]);
                            $counter = 1;
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $data = htmlspecialchars($row["data"]);
                                $data = date_format(date_create($data), 'd/m/Y');
                                $horario = htmlspecialchars($row["horario"]);
                                $nome_paciente = htmlspecialchars($row["nome_paciente"]);
                                $sexo = htmlspecialchars($row["sexo"]);
                                $email = htmlspecialchars($row["email"]);

                                echo '<tr>';
                                echo "<th scope=\"row\">{$counter}</th>";
                                echo "<td>{$data}</td>";
                                echo "<td>{$horario}h00</td>";
                                echo '<td>';
                                echo "{$nome_paciente}";
                                echo '<div class="dropdown dropdown-menu-end d-inline ms-2">';
                                echo '<button class="dropdown-toggle" type="button" data-bs-toggle="dropdown">📃</button>';
                                echo '<ul class="dropdown-menu">';
                                echo "<li class=\"dropdown-item\">Sexo: {$sexo}</li>";
                                echo "<li class=\"dropdown-item\">Email: {$email}</li>";
                                echo '</ul>';
                                echo '</div>';
                                echo '</td>';
                                echo '</tr>';
                
                                $counter = $counter + 1;
                            }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>


    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>
</body>

</html>