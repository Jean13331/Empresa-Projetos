<?php
include("../conexao.php");

$sql_funcoes = "SELECT idFuncao, Nome FROM funcao";
$result_funcoes = $mysqli->query($sql_funcoes);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Funções</title>

</head>
<body>
    <h1>Funções Cadastradas</h1>

    <table border = 1>
        <tr>
            <th>ID da Função</th>
            <th>Nome da Função</th>
        </tr>

        <?php
        while ($row = $result_funcoes->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["idFuncao"] . "</td>";
            echo "<td>" . $row["Nome"] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <br>
    <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
</body>
</html>
