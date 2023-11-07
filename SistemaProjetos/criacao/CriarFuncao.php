<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_funcao = $_POST["nome_funcao"];

    $sql_funcao = "INSERT INTO funcao (Nome) VALUES ('$nome_funcao')";

    if ($mysqli->query($sql_funcao) === TRUE) {
        echo "Função criada com sucesso!";
    } else {
        echo "Erro ao criar a função: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Função</title>
</head>
<body>
    <h1>Criar Nova Função</h1>

    <form method="POST" action="">
        <label for="nome_funcao">Nome da Função:</label>
        <input type="text" name="nome_funcao" required><br><br>

        <input type="submit" value="Criar Função"><br><br>
        <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
    </form>
</body>
</html>
