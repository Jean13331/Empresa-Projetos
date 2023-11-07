<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data_inicio = $_POST["data_inicio"];
    $data_termino = !empty($_POST["data_termino"]) ? $_POST["data_termino"] : null;
    $id_empresa = $_POST["id_empresa"];
    $valor = $_POST["valor"];

    if (empty($data_termino)) {
        $data_termino = "NULL";
    } else {
        $data_termino = "'" . $data_termino . "'";
    }

    $sql_projeto = "INSERT INTO projeto (DataInicio, DataTermino, idEmpresa, Valor) VALUES ('$data_inicio', $data_termino, $id_empresa, $valor)";

    if ($mysqli->query($sql_projeto) === TRUE) {
        echo "Projeto criado com sucesso!";
    } else {
        echo "Erro ao criar o projeto: " . $mysqli->error;
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
    <title>Criar Projeto</title>
</head>
<body>
    <h1>Criar Novo Projeto</h1>

    <form method="POST" action="">
        <label for="data_inicio">Data de Início:</label>
        <input type="date" name="data_inicio" required><br>

        <label for="data_termino">Data de Término (opcional):</label>
        <input type="date" name="data_termino"><br>

        <label for="id_empresa">Empresa:</label>
        <select name="id_empresa" required>
            <?php
            while ($row = $result_empresas->fetch_assoc()) {
                echo "<option value='" . $row["idEmpresa"] . "'>" . $row["Nome"] . "</option>";
            }
            ?>
        </select><br>

        <label for="valor">Valor:</label>
        <input type="number" name="valor" step="0.01" required><br><br>

        <input type="submit" value="Criar Projeto"><br><br>
        <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
    </form>
</body>
</html>
