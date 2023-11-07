<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome_empresa = $_POST["nome_empresa"];
    $sql_id_empresa = "SELECT idEmpresa FROM empresa WHERE Nome = '$nome_empresa'";
    $result_id_empresa = $mysqli->query($sql_id_empresa);

    if ($result_id_empresa->num_rows > 0) {
        $row = $result_id_empresa->fetch_assoc();
        $id_empresa = $row["idEmpresa"];
        $sql_excluir_empresa = "DELETE FROM empresa WHERE idEmpresa = $id_empresa";

        if ($mysqli->query($sql_excluir_empresa) === TRUE) {
            echo "Empresa \"$nome_empresa\" foi excluída com sucesso!";
        } else {
            echo "Erro ao excluir a empresa: " . $mysqli->error;
        }
    } else {
        echo "Empresa não encontrada.";
    }
}

$sql_empresas = "SELECT idEmpresa, Nome FROM empresa";
$result_empresas = $mysqli->query($sql_empresas);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Empresa</title>
</head>
<body>
    <h1>Excluir Empresa</h1>

    <form method="POST" action="">
        <label for="nome_empresa">Selecione a Empresa a ser Excluída:</label>
        <select name="nome_empresa" required>
            <?php
            while ($row = $result_empresas->fetch_assoc()) {
                echo "<option value='" . $row["Nome"] . "'>" . $row["Nome"] . "</option>";
            }
            ?>
        </select>
        <br>
        <input type="submit" value="Excluir Empresa"><br>
    </form>

    <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
</body>
</html>
