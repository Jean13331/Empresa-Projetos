<?php
include("../conexao.php");

$sql_projetos = "SELECT projeto.*, empregado.Nome AS NomeEmpregado FROM projeto
LEFT JOIN Empregado_Projeto ON projeto.idProjeto = Empregado_Projeto.IdProjeto
LEFT JOIN empregado ON Empregado_Projeto.IdEmpregado = empregado.idEmpregado
ORDER BY projeto.DataInicio DESC";

$result_projetos = $mysqli->query($sql_projetos);

if ($result_projetos === false) {
    die("Erro na consulta SQL dos projetos: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Visualizar Todos os Projetos</title>
</head>
<body>
    <h1>Visualizar Todos os Projetos</h1>

    <?php
    if ($result_projetos->num_rows > 0) {
    ?>
    <table border="1">
    <tr>
        <th>ID do Projeto</th>
        <th>Data de Início</th>
        <th>Data de Término</th>
        <th>Valor</th>
        <th>Empregados</th>
    </tr>
    <?php
    while ($row = $result_projetos->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["idProjeto"] . "</td>";
        echo "<td>" . $row["DataInicio"] . "</td>";
        echo "<td>" . $row["DataTermino"] . "</td>";
        echo "<td>" . $row["valor"] . "</td>";
        echo "<td>" . $row["NomeEmpregado"] . "</td>";
        echo "</tr>";
    }
    ?>
</table>
    <?php
    } else {
        echo "Nenhum projeto encontrado.";
    }
    ?>

    <br><br>
    <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
</body>
</html>
