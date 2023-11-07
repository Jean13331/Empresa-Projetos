<?php
include("../conexao.php");

$sql_empregados = "SELECT empregado.idEmpregado, especializacao.Nome AS Especializacao, empregado.nome, empregado.NumIdentidade FROM empregado JOIN especializacao ON empregado.idEspecializacao = especializacao.idEspecializacao";
$result_empregados = $mysqli->query($sql_empregados);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Empregados</title>
</head>
<body>
    <h1>Empregados Cadastrados</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Especialização</th>
            <th>Nome do Empregado</th>
            <th>Número de Identidade</th>
        </tr>

        <?php
        while ($row = $result_empregados->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["idEmpregado"] . "</td>";
            echo "<td>" . $row["Especializacao"] . "</td>";
            echo "<td>" . $row["nome"] . "</td>";
            echo "<td>" . $row["NumIdentidade"] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <br>
    <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
</body>
</html>
