<?php
include("../conexao.php");

$sql_empresas = "SELECT empresa.idEmpresa, empresa.CNPJ, empresa.Nome, endereco.Rua, endereco.Bairro, endereco.Numero, endereco.Cidade FROM empresa JOIN endereco ON empresa.idEndereco = endereco.idEndereco";
$result_empresas = $mysqli->query($sql_empresas);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Empresas</title>
</head>
<body>
    <h1>Empresas Cadastradas</h1>

    <table border="1">
    <tr>
            <th>ID</th>
            <th>CNPJ</th>
            <th>Nome da Empresa</th>
            <th>Rua</th>
            <th>Número</th>
            <th>Bairro</th>
            <th>Cidade</th>
        </tr>

        <?php
        while ($row = $result_empresas->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["idEmpresa"] . "</td>";
            echo "<td>" . $row["CNPJ"] . "</td>";
            echo "<td>" . $row["Nome"] . "</td>";
            echo "<td>" . $row["Rua"] . "</td>";
            echo "<td>" . $row["Numero"] . "</td>";
            echo "<td>" . $row["Bairro"] . "</td>";
            echo "<td>" . $row["Cidade"] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <br>
    <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
</body>
</html>
