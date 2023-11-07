<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome_empregado = $_POST["nome_empregado"];
    $sql_id_empregado = "SELECT idEmpregado FROM empregado WHERE nome = '$nome_empregado'";
    $result_id_empregado = $mysqli->query($sql_id_empregado);

    if ($result_id_empregado->num_rows > 0) {
        $row = $result_id_empregado->fetch_assoc();
        $id_empregado = $row["idEmpregado"];
        $sql_nome_empregado = "SELECT nome FROM empregado WHERE idEmpregado = $id_empregado";
        $result_nome_empregado = $mysqli->query($sql_nome_empregado);

        if ($result_nome_empregado->num_rows > 0) {
            $row = $result_nome_empregado->fetch_assoc();
            $nome_empregado = $row["nome"];
            $mysqli->begin_transaction();
            $sql_excluir_projetos = "DELETE FROM projeto WHERE idEmpregado = $id_empregado";
            $mysqli->query($sql_excluir_projetos);
            $sql_excluir_empregado = "DELETE FROM empregado WHERE idEmpregado = $id_empregado";
            $mysqli->query($sql_excluir_empregado);

            if ($mysqli->commit()) {
                echo "Empregado \"$nome_empregado\" e projetos relacionados foram excluídos com sucesso!";
            } else {
                echo "Erro ao excluir o empregado: " . $mysqli->error;
                $mysqli->rollback();
            }
        } else {
            echo "Empregado não encontrado.";
        }
    } else {
        echo "Empregado não encontrado.";
    }
}

$sql_empregados = "SELECT idEmpregado, nome FROM empregado";
$result_empregados = $mysqli->query($sql_empregados);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Empregado em Cascata</title>
</head>
<body>
    <h1>Excluir Empregado e Projetos em Cascata</h1>

    <form method="POST" action="">
        <label for="nome_empregado">Selecione o Empregado a ser Excluído:</label>
        <select name="nome_empregado" required>
            <?php
            while ($row = $result_empregados->fetch_assoc()) {
                echo "<option value='" . $row["nome"] . "'>" . $row["nome"] . "</option>";
            }
            ?>
        </select>
        <br>
        <input type="submit" value="Excluir Empregado e Projetos"><br>
    </form>

    <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
</body>
</html>
