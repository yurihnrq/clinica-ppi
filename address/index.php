<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require "./db/mysqlConnection.php";
    $pdo = mysqlConnect();

    $cep = $address = $city = $state = "";

    if(isset($_POST["cep"])) $cep = $_POST["cep"];
    if(isset($_POST["address"])) $address = $_POST["address"];
    if(isset($_POST["city"])) $city = $_POST["city"];
    if(isset($_POST["state"])) $state = $_POST["state"];

    $sql = <<<SQL
        INSERT INTO base_de_enderecos_ajax (cep, logradouro, cidade, estado)
        VALUES (?, ?, ?, ?)
    SQL;

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cep, $address, $city, $state]);
    }
    catch (Exception $e) {
        exit('Falha inesperada: ' . $e->getMessage());
    }
}

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

    <link rel="stylesheet" href="address.css">
    <style>
        .result-message {
            display: none;
        }
    </style>

    <title>Clínica</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-darkblue">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Clínica Blu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="../">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../scheduling/">Agendamento</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link" aria-current="page" href="../gallery">Galeria</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link active" aria-current="page" href=".">Endereço</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#login-modal">
                            Entrar
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                                <path fill-rule="evenodd"
                                    d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container mt-4">
        <h1>Adicionar endereço</h1>
        <p>Realize aqui a adição do seu endereço. 🗺</p>
        <div class="row">
            <div class="col d-flex align-items-center">
                <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> class="w-100" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="cep" name="cep" placeholder=" "
                                    pattern="\d{5}\-\d{3}\" required>
                                <label for="cep" class="form-label">CEP</label>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="address" name="address" placeholder=" " required>
                                <label for="address" class="form-label">Endereço</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="city" name="city" placeholder=" " required>
                                <label for="city" class="form-label">Cidade</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="state" name="state" placeholder=" " required>
                                <label for="state" class="form-label">Estado</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col form-btns">
                            <button type="reset" class="btn btn-outline-dark me-3">
                                Limpar
                            </button>
                            <button type="submit" class="btn bg-darkblue">
                                Enviar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col d-none d-lg-block">
                <img src="../svg/undraw_My_location.svg" alt="Location svg" class="img-fluid">
            </div>
        </div>
    </main>

    <!-- Login Modal -->
<div class="modal fade" id="login-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input id="email" type="email" name="email" class="form-control" placeholder="seuemail@mail.com"
                                required>
                        </div>
                        <div>
                            <label for="password" class="form-label">Senha:</label>
                            <input id="password" type="password" name="password" class="form-control" placeholder="********"
                                required>
                        </div>
                    </div>
                    <div class="alert alert-danger result-message mt-3" id="loginFail" role="alert">
                        Senha ou e-mail incorretos!
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Fechar</button>
                    <button id="btn-login" data-backdrop="static" class="btn bg-darkblue">Entrar</button>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
    crossorigin="anonymous"></script>
    
    <script src="./js/login.js"></script>
</body>

</html>