<?php

require_once "mysqlConnection.php";
require "authentication.php";
session_start();
$pdo = mysqlConnect();

$email = $senha = "";
if(isset($_POST["email"])) $email = $_POST["email"];
if(isset($_POST["password"])) $senha = $_POST["password"];

$senhaHash = checkPassword($pdo, $email, $senha);

if($senhaHash == false) {
    exit();
}
$_SESSION["email"] = $email;
$_SESSION["loginString"] = hash('sha512', $senhaHash . $_SERVER['HTTP_USER_AGENT']);

echo "success"
?>