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
    <h1>Oque deseja Criar</h1>
    <ul>
        <li><a href="CriarEmpresa.php">Empresa</a></li><br>
        <li><a href="CriarEmpregado.php">Empregado</a></li><br>
        <li><a href="CriarProjeto.php">Projeto</a></li><br>
        <li><a href="CriarEspecializacao.php">Especializaçao</a></li><br>
        <li><a href="CriarFuncao.php">Funçao</a></li><br>
        <li><a href="CadastrarHoras.php">cadastrar as horas trabalhadas e a função de um empregado</a></li><br>
        <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
    </ul>
</body>
</html>
