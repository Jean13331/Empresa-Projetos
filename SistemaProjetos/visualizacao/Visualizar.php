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
    <h1>Oque deseja Visualizar</h1>
    <ul>
        <li><a href="VisualizarEmpresa.php">Empresa</a></li><br>
        <li><a href="VisualizarEmpregado.php">Empregado</a></li><br>
        <li><a href="VisualizarProjeto.php">Projeto</a></li><br>
        <li><a href="VisualizarEspecializacao.php">Especializaçao</a></li><br>
        <li><a href="VisualizarFuncao.php">Funçao</a></li><br>
        <li><a href="VisualizarProjetosEmpregado.php">Visualizar Projetos Empregado</a></li><br>
        <li><a href="VisualizarProjetosEmpresa.php">Visualizar projetos da Empresa</a></li><br>
        <li><a href="VisualizarProjetosDados.php">Visualizar projetos e Dados</a></li><br>
        <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
    </ul>
</body>
</html>
