<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_especializacao = $_POST["id_especializacao"];
    $sql_verificar_especializacao = "SELECT Nome FROM especializacao WHERE idEspecializacao = $id_especializacao";
    $result_verificar_especializacao = $mysqli->query($sql_verificar_especializacao);

    if ($result_verificar_especializacao->num_rows > 0) {
        $row = $result_verificar_especializacao->fetch_assoc();
        $nome_especializacao = $row["Nome"];
        $sql_excluir_especializacao = "DELETE FROM especializacao WHERE idEspecializacao = $id_especializacao";

        if ($mysqli->query($sql_excluir_especializacao) === TRUE) {
            echo "Especialização \"$nome_especializacao\" foi excluída com sucesso!";
        } else {
            echo "Erro ao excluir a especialização: " . $mysqli->error;
        }
    } else {
        echo "Especialização não encontrada.";
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
    <title>Excluir Especialização</title>
</head>
<body>
    <h1>Excluir Especialização</h1>

    <form method="POST" action="">
        <label for="id_especializacao">Selecione a Especialização a ser Excluída (ID):</label>
        <select name="id_especializacao" required>
            <?php
            while ($row = $result_especializacoes->fetch_assoc()) {
                echo "<option value='" . $row["idEspecializacao"] . "'>" . $row["idEspecializacao"] . " - " . $row["Nome"] . "</option>";
            }
            ?>
        </select>
        <br>
        <input type="submit" value="Excluir Especialização"><br>
    </form>

    <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
</body>
</html>
