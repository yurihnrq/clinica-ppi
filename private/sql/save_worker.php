<?php

require_once "mysqlConnection.php";

$cep = $cidade = $email = $estado = $logradouro = "";
$nome = $sexo = $telefone = $data_contrato = $salario = $senha = "";

if(isset($_POST["cep"])) $cep = $_POST["cep"];
if(isset($_POST["city"])) $cidade = $_POST["city"];
if(isset($_POST["email"])) $email = $_POST["email"];
if(isset($_POST["state"])) $estado = $_POST["state"];
if(isset($_POST["address"])) $logradouro = $_POST["address"];
if(isset($_POST["name"])) $nome = $_POST["name"];
if(isset($_POST["sex"])) $sexo = $_POST["sex"];
if(isset($_POST["phone"])) $telefone = $_POST["phone"];
if(isset($_POST["starting-date"])) $data_contrato = $_POST["starting-date"];
if(isset($_POST["salary"])) $salario = $_POST["salary"];
if(isset($_POST["password"])) $senha = $_POST["password"];

$pdo = mysqlConnect();

$sqlPessoa = <<<SQL
    INSERT INTO pessoa(cep, cidade, email, estado, logradouro, nome, sexo, telefone)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
SQL;

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);
$sqlWorker = <<<SQL
    INSERT INTO funcionario(codigo, data_contrato, salario, senha_hash)
    VALUES (?, ?, ?, ?)
SQL;

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare($sqlPessoa);
    if(!$stmt->execute([$cep, $cidade, $email, $estado, $logradouro, $nome, $sexo, $telefone])) {
        throw new Exception("Falha ao inserir dados na tabela pessoa");
    }

    $codigo = $pdo->lastInsertId();

    $stmt = $pdo->prepare($sqlWorker);
    if(!$stmt->execute([$codigo, $data_contrato, $salario, $senha_hash])) {
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