<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_empregado = $_POST["id_empregado"];

    $sql_nome_empregado = "SELECT Nome FROM empregado WHERE idEmpregado = $id_empregado";
    $result_nome_empregado = $mysqli->query($sql_nome_empregado);

    if ($result_nome_empregado->num_rows > 0) {
        $row = $result_nome_empregado->fetch_assoc();
        $nome_empregado = $row["Nome"];

        $sql_projetos_empregado = "SELECT ep.IdProjeto FROM Empregado_Projeto ep WHERE ep.idEmpregado = $id_empregado";
        $result_projetos_empregado = $mysqli->query($sql_projetos_empregado);

        if ($result_projetos_empregado->num_rows > 0) {
            echo "Projetos associados ao empregado $nome_empregado (ID $id_empregado):<br><br>";

            echo "<table border='1'>";
            echo "<tr><th>ID Projeto</th></tr>";

            while ($row_projeto = $result_projetos_empregado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row_projeto["IdProjeto"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "O empregado $nome_empregado (ID $id_empregado) não está associado a nenhum projeto.";
        }
    } else {
        echo "Empregado não encontrado.";
    }
}

$sql_empregados = "SELECT idEmpregado, Nome FROM empregado";
$result_empregados = $mysqli->query($sql_empregados);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Projetos de Empregado</title>
</head>
<body>
    <h1>Visualizar Projetos de Empregado</h1>

    <form method="POST" action="">
        <label for="id_empregado">Selecione o Empregado:</label>
        <select name="id_empregado" required>
            <?php
            while ($row = $result_empregados->fetch_assoc()) {
                echo "<option value='" . $row["idEmpregado"] . "'>" . $row["Nome"] . "</option>";
            }
            ?>
        </select><br>

        <input type="submit" value="Visualizar Projetos">
    </form>

    <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
</body>
</html>
