<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_especializacao = $_POST["id_especializacao"];
    $nome = $_POST["nome"];

    $sql_nome_antigo = "SELECT Nome FROM especializacao WHERE idEspecializacao = $id_especializacao";
    $result_nome_antigo = $mysqli->query($sql_nome_antigo);

    if ($result_nome_antigo->num_rows > 0) {
        $row = $result_nome_antigo->fetch_assoc();
        $nome_antigo = $row["Nome"];
    }

    $sql_atualizar_especializacao = "UPDATE especializacao SET Nome = '$nome' WHERE idEspecializacao = $id_especializacao";

    if ($mysqli->query($sql_atualizar_especializacao) === TRUE) {
        echo "Especialização atualizada com sucesso! Nome alterado de $nome_antigo para $nome.";
    } else {
        echo "Erro ao atualizar a especialização: " . $mysqli->error;
    }
}

$sql_especializacoes = "SELECT idEspecializacao, Nome FROM especializacao";
$result_especializacoes = $mysqli->query($sql_especializacoes);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Especialização</title>
</head>
<body>
    <h1>Atualizar Especialização</h1>

    <form method="POST" action="">
        <label for="id_especializacao">Selecione a Especialização a ser Atualizada:</label>
        <select name="id_especializacao" required>
            <?php
            while ($row = $result_especializacoes->fetch_assoc()) {
                echo "<option value='" . $row["idEspecializacao"] . "'>" . $row["Nome"] . "</option>";
            }
            ?>
        </select><br>

        <label for="nome">Novo Nome da Especialização:</label>
        <input type="text" name="nome" required><br>

        <input type="submit" value="Atualizar Especialização"><br><br>
        <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
    </form>
</body>
</html>
