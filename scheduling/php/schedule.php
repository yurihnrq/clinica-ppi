<?php

require_once "mysqlConnection.php";

$nome = $email = $sexo = "";
$especialidade = $crmDoMedico = $data = "";
$horario = "";

if(isset($_POST["name"])) $nome = $_POST["name"];
if(isset($_POST["email"])) $email = $_POST["email"];
if(isset($_POST["sex"])) $sexo = $_POST["sex"];
if(isset($_POST["specialty"])) $especialidade = $_POST["specialty"];
if(isset($_POST["doctor"])) $crmDoMedico = $_POST["doctor"];
if(isset($_POST["date"])) $data = $_POST["date"];
if(isset($_POST["hour"])) $horario = $_POST["hour"];

$pdo = mysqlConnect();

$sqlPegarCodigo = <<<SQL
    SELECT codigo
    FROM medico
    WHERE crm = ?
SQL;

$stmt = $pdo->prepare($sqlPegarCodigo);
$stmt->execute([$crmDoMedico]);

$codigo = $stmt->fetchColumn();

$sqlAgendamento = <<<SQL
    INSERT INTO agenda(data, horario, nome, sexo, email, codigo_medico)
    VALUES (?, ?, ?, ?, ?, ?)
SQL;

$stmt = $pdo->prepare($sqlAgendamento);
if(!$stmt->execute([$data, $horario, $nome, $sexo, $email, $codigo])) {
    echo "Falha ao inserir dados na tabela pessoa";
} else {
    echo "success";
}

?>