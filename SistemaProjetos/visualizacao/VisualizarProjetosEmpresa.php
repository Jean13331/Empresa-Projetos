<?php
include("../conexao.php");

$sql_empresas = "SELECT idEmpresa, Nome FROM empresa";
$result_empresas = $mysqli->query($sql_empresas);

if ($result_empresas === false) {
    die("Erro na consulta SQL das empresas: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Visualizar Projetos da Empresa</title>
</head>
<body>
    <h1>Visualizar Projetos da Empresa</h1>

    <form method="POST" action="">
        <label for="empresa">Selecione a Empresa:</label>
        <select name="empresa" required>
            <?php
            while ($row = $result_empresas->fetch_assoc()) {
                echo "<option value='" . $row["idEmpresa"] . "'>" . $row["Nome"] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Visualizar Projetos">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $empresa_id = $_POST["empresa"];

        $sql = "SELECT * FROM projeto WHERE idEmpresa = $empresa_id";
        $result = $mysqli->query($sql);

        if ($result === false) {
            die("Erro na consulta SQL dos projetos: " . $mysqli->error);
        }

        if ($result->num_rows > 0) {
            echo "<h2>Projetos da Empresa:</h2>";
            echo "<table border='1'>";
            echo "<tr>";
            echo "<th>ID do Projeto</th>";
            echo "<th>Data de Início</th>";
            echo "<th>Data de Término</th>";
            echo "</tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["idProjeto"] . "</td>";
                echo "<td>" . $row["DataInicio"] . "</td>";
                echo "<td>" . $row["DataTermino"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Nenhum projeto encontrado para esta empresa.";
        }
    }
    ?>
    <br><br>
    <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
</body>
</html>
