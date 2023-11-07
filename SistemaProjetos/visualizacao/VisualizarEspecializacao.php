<?php
include("../conexao.php");

$sql_especializacoes = "SELECT idEspecializacao, Nome FROM especializacao";
$result_especializacoes = $mysqli->query($sql_especializacoes);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Especializações</title>
</head>
<body>
    <h1>Especializações Cadastradas</h1>

    <table border="1">
        <tr>
            <th>ID da Especialização</th>
            <th>Nome da Especialização</th>
        </tr>

        <?php
        while ($row = $result_especializacoes->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["idEspecializacao"] . "</td>";
            echo "<td>" . $row["Nome"] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <br>
    <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
</body>
</html>
