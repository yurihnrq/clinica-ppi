<?php

require_once "mysqlConnection.php";

$nome = $sexo = $telefone = "";
$cep = $cidade = $email = $estado = $logradouro = "";
$peso = $altura = $tipoSanguineo = "";

if(isset($_POST["cep"])) $cep = $_POST["cep"];
if(isset($_POST["city"])) $cidade = $_POST["city"];
if(isset($_POST["email"])) $email = $_POST["email"];
if(isset($_POST["state"])) $estado = $_POST["state"];
if(isset($_POST["address"])) $logradouro = $_POST["address"];
if(isset($_POST["name"])) $nome = $_POST["name"];
if(isset($_POST["sex"])) $sexo = $_POST["sex"];
if(isset($_POST["phone"])) $telefone = $_POST["phone"];
if(isset($_POST["weight"])) $peso = $_POST["weight"];
if(isset($_POST["height"])) $altura = $_POST["height"];
if(isset($_POST["blood"])) $tipoSanguineo = $_POST["blood"];

$pdo = mysqlConnect();

$sqlPessoa = <<<SQL
    INSERT INTO pessoa(cep, cidade, email, estado, logradouro, nome, sexo, telefone)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
SQL;

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);
$sqlPatient = <<<SQL
    INSERT INTO paciente(codigo, peso, altura, tipo_sanguineo)
    VALUES (?, ?, ?, ?)
SQL;

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare($sqlPessoa);
    if(!$stmt->execute([$cep, $cidade, $email, $estado, $logradouro, $nome, $sexo, $telefone])) {
        throw new Exception("Falha ao inserir dados na tabela pessoa");
    }

    $codigo = $pdo->lastInsertId();

    $stmt = $pdo->prepare($sqlPatient);
    if(!$stmt->execute([$codigo, $peso, $altura, $tipoSanguineo])) {
        throw new Exception("Falha ao inserir dados na tabela funcionario");
    }

    $pdo->commit();
    echo "success";
}
catch (Exception $e) {
    $pdo->rollBack();
    exit($e->getMessage());
}

?>