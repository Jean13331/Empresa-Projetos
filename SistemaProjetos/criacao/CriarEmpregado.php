<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $num_identidade = $_POST["num_identidade"];
    $nome_especializacao = $_POST["nome_especializacao"];

    $sql_check_especializacao = "SELECT idEspecializacao FROM especializacao WHERE Nome = '$nome_especializacao'";
    $result = $mysqli->query($sql_check_especializacao);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $especializacao_id = $row["idEspecializacao"];
    } else {
        $sql_inserir_especializacao = "INSERT INTO especializacao (Nome) VALUES ('$nome_especializacao')";
        if ($mysqli->query($sql_inserir_especializacao) === TRUE) {
            $especializacao_id = $mysqli->insert_id;
        } else {
            echo "Erro ao criar a especialização: " . $mysqli->error;
        }
    }

    $sql_empregado = "INSERT INTO empregado (idEspecializacao, nome, NumIdentidade) VALUES ($especializacao_id, '$nome', '$num_identidade')";

    if ($mysqli->query($sql_empregado) === TRUE) {
        echo "Empregado criado com sucesso!";
    } else {
        echo "Erro ao criar o empregado: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Funcionário com Especialização</title>
</head>
<body>
    <h1>Criar Novo Funcionário</h1>

    <form method="POST" action="">
        <label for="nome">Nome do Funcionário:</label>
        <input type="text" name="nome" required><br>

        <label for="num_identidade">Número de Identidade:</label>
        <input type="text" name="num_identidade" required><br>

        <label for="nome_especializacao">Especialização:</label>
        <input type="text" name="nome_especializacao" required><br><br>

        <input type="submit" value="Criar Funcionário"><br><br>
        <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
    </form>
</body>
</html>
