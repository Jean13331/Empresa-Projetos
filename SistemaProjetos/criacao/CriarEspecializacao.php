<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_especializacao = $_POST["nome_especializacao"];

    $sql_especializacao = "INSERT INTO especializacao (Nome) VALUES ('$nome_especializacao')";

    if ($mysqli->query($sql_especializacao) === TRUE) {
        echo "Especialização criada com sucesso!";
    } else {
        echo "Erro ao criar a especialização: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Especialização</title>
</head>
<body>
    <h1>Criar Nova Especialização</h1>

    <form method="POST" action="">
        <label for="nome_especializacao">Nome da Especialização:</label>
        <input type="text" name="nome_especializacao" required><br><br>

        <input type="submit" value="Criar Especialização"><br><br>
        <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
    </form>
</body>
</html>
