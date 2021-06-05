<?php

require_once "mysqlConnection.php";

class Doctor{
    public $nome;
    public $crm;

    function __construct($nome, $crm)
    {
        $this->nome = $nome;
        $this->crm = $crm;
    }
}

$especialidade = "";
if(isset($_GET["especialidade"])) $especialidade = $_GET["especialidade"]; 

$pdo = mysqlConnect();

$sql = <<<SQL
    SELECT nome, crm
    FROM pessoa INNER JOIN medico ON pessoa.codigo = medico.codigo
    WHERE especialidade = ?
SQL;

$stmt = $pdo->prepare($sql);
$stmt->execute([$especialidade]);

$doctors = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($doctors, new Doctor($row["nome"], $row["crm"]));
}

echo json_encode($doctors)

?>