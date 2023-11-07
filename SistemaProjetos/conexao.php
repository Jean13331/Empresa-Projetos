<?php
$host = "localhost";
$banco = "mydb";
$user = "root";
$pass = "1234";

$mysqli = new mysqli($host, $user, $pass, $banco);

if ($mysqli->connect_errno) {
    die("Falha ao conectar: " . $mysqli->connect_error);
}
?>
