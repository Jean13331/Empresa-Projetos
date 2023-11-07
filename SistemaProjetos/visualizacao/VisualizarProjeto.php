<?php
include("../conexao.php");

$sql_projetos = "SELECT projeto.idProjeto, projeto.DataInicio, projeto.DataTermino, projeto.idEmpresa, projeto.Valor, empresa.Nome AS NomeEmpresa FROM projeto JOIN empresa ON projeto.idEmpresa = empresa.idEmpresa";
$result_projetos = $mysqli->query($sql_projetos);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Projetos</title>
</head>
<body>
    <h1>Projetos Cadastrados</h1>

    <table border="1">
        <tr>
            <th>ID do Projeto</th>
            <th>Data de Início</th>
            <th>Data de Término</th>
            <th>Nome da Empresa</th>
            <th>Valor</th>
        </tr>

        <?php
        while ($row = $result_projetos->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["idProjeto"] . "</td>";
            echo "<td>" . $row["DataInicio"] . "</td>";
            echo "<td>" . $row["DataTermino"] . "</td>";
            echo "<td>" . $row["NomeEmpresa"] . "</td>";
            echo "<td>" . $row["Valor"] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <br>
    <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
</body>
</html>
