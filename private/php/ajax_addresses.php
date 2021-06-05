<?php

require "mysqlConnection.php";

class Endereco
{
  public $logradouro;
  public $cidade;
  public $estado;

  function __construct($logradouro, $cidade, $estado)
  {
    $this->logradouro = $logradouro;
    $this->cidade = $cidade; 
    $this->estado = $estado;
  }
}

$cep = "";
if(isset($_GET["cep"])) $cep = $_GET["cep"];

$sql = <<<SQL
    SELECT logradouro, cidade, estado
    FROM base_de_enderecos_ajax
    WHERE cep = ?
SQL;

$pdo = mysqlConnect();

$stmt = $pdo->prepare($sql);
$stmt->execute([$cep]);

if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo json_encode(new Endereco($row["logradouro"], $row["cidade"], $row["estado"]));
}