<?php

require_once "mysqlConnection.php";
require "authentication.php";
session_start();
$pdo = mysqlConnect();

$email = $senha = "";
if(isset($_POST["email"])) $email = $_POST["email"];
if(isset($_POST["password"])) $senha = $_POST["password"];

$user = checkPassword($pdo, $email, $senha);

if($user == false) {
    exit();
}
$_SESSION["email"] = $user->email;
$_SESSION["nome"] = $user->nome;
$_SESSION["telefone"] = $user->telefone;
$_SESSION["loginString"] = hash('sha512', $user->hash . $_SERVER['HTTP_USER_AGENT']);

echo "success"
?>