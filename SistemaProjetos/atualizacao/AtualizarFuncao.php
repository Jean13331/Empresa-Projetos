<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_funcao = $_POST["id_funcao"];
    $nome = $_POST["nome"];

    $sql_nome_antigo = "SELECT Nome FROM funcao WHERE IdFuncao = $id_funcao";
    $result_nome_antigo = $mysqli->query($sql_nome_antigo);

    if ($result_nome_antigo->num_rows > 0) {
        $row = $result_nome_antigo->fetch_assoc();
        $nome_antigo = $row["Nome"];
    }

    $sql_atualizar_funcao = "UPDATE funcao SET Nome = '$nome' WHERE IdFuncao = $id_funcao";

    if ($mysqli->query($sql_atualizar_funcao) === TRUE) {
        echo "Função atualizada com sucesso! Nome alterado de $nome_antigo para $nome.";
    } else {
        echo "Erro ao atualizar a função: " . $mysqli->error;
    }
}

$sql_funcoes = "SELECT IdFuncao, Nome FROM funcao";
$result_funcoes = $mysqli->query($sql_funcoes);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Função</title>
</head>
<body>
    <h1>Atualizar Função</h1>

    <form method="POST" action="">
        <label for="id_funcao">Selecione a Função a ser Atualizada:</label>
        <select name="id_funcao" required>
            <?php
            while ($row = $result_funcoes->fetch_assoc()) {
                echo "<option value='" . $row["IdFuncao"] . "'>" . $row["Nome"] . "</option>";
            }
            ?>
        </select><br>

        <label for="nome">Novo Nome da Função:</label>
        <input type="text" name="nome" required><br>

        <input type="submit" value="Atualizar Função"><br><br>
        <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
    </form>
</body>
</html>
