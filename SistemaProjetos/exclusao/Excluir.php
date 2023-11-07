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
    <h1>Oque deseja Excluir</h1>
    <ul>
        <li><a href="ExcluirEmpresa.php">Empresa</a></li><br>
        <li><a href="ExcluirEmpregado.php">Empregado</a></li><br>
        <li><a href="ExcluirEspecializacao.php">Especializaçao</a></li><br>
        <li><a href="ExcluirFuncao.php">Funçao</a></li><br>
        <li><a href="ExcluirProjeto.php">Projeto</a></li><br>
        <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
    </ul>
</body>
</html>
