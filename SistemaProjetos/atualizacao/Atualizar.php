<?php
include('../conexao.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Projetos</title>
</head>
<body>
    <h1>Oque deseja Atualizar</h1>
    <ul>
        <li><a href="AtualizarEmpresa.php">Empresa</a></li><br>
        <li><a href="AtualizarEmpregado.php">Empregado</a></li><br>
        <li><a href="AtualizarProjeto.php">Projeto</a></li><br>
        <li><a href="AtualizarEspecializacao.php">Especializaçao</a></li><br>
        <li><a href="AtualizarFuncao.php">Funçao</a></li><br>
        <li><a href="AtualizarHorasFuncao.php">atualizar as horas trabalhadas e a função</a></li><br>
        <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
    </ul>
</body>
</html>
