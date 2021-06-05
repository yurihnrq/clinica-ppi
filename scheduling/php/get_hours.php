<?php

require_once "mysqlConnection.php";

$data = $crm = "";
if(isset($_GET["data"])) $data = $_GET["data"];
if(isset($_GET["crm"])) $crm = $_GET["crm"];

$pdo = mysqlConnect();

$sql = <<<SQL
    SELECT horario
    FROM agenda INNER JOIN medico ON agenda.codigo_medico = medico.codigo
    WHERE data = ? and crm = ?
SQL;

$stmt = $pdo->prepare($sql);
$stmt->execute([$data, $crm]);

echo json_encode($stmt->fetchAll(PDO::FETCH_COLUMN));

?>