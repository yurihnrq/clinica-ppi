<?php

require_once "mysqlConnection.php";

$pdo = mysqlConnect();

$sql = <<<SQL
    SELECT DISTINCT especialidade
    FROM medico
SQL;

$stmt = $pdo->query($sql);
$specialties = $stmt->fetchAll(PDO::FETCH_COLUMN);


echo json_encode($specialties);

?>