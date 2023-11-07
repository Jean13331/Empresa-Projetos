<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_funcao = $_POST["id_funcao"];
    $sql_verificar_funcao = "SELECT Nome FROM funcao WHERE idFuncao = $id_funcao";
    $result_verificar_funcao = $mysqli->query($sql_verificar_funcao);

    if ($result_verificar_funcao->num_rows > 0) {
        $row = $result_verificar_funcao->fetch_assoc();
        $nome_funcao = $row["Nome"];
        $sql_excluir_funcao = "DELETE FROM funcao WHERE idFuncao = $id_funcao";

        if ($mysqli->query($sql_excluir_funcao) === TRUE) {
            echo "Função \"$nome_funcao\" foi excluída com sucesso!";
        } else {
            echo "Erro ao excluir a função: " . $mysqli->error;
        }
    } else {
        echo "Função não encontrada.";
    }
}

$sql_funcoes = "SELECT idFuncao, Nome FROM funcao";
$result_funcoes = $mysqli->query($sql_funcoes);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Função</title>
</head>
<body>
    <h1>Excluir Função</h1>

    <form method="POST" action="">
        <label for="id_funcao">Selecione a Função a ser Excluída (ID):</label>
        <select name="id_funcao" required>
            <?php
            while ($row = $result_funcoes->fetch_assoc()) {
                echo "<option value='" . $row["idFuncao"] . "'>" . $row["idFuncao"] . " - " . $row["Nome"] . "</option>";
            }
            ?>
        </select>
        <br>
        <input type="submit" value="Excluir Função"><br>
    </form>

    <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
</body>
</html>
