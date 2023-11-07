<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_projeto = $_POST["id_projeto"];
    $data_inicio = $_POST["data_inicio"];
    $data_termino = $_POST["data_termino"];
    $id_empresa = $_POST["id_empresa"];
    $valor = $_POST["valor"];

    $sql_atualizar_projeto = "UPDATE projeto SET DataInicio = '$data_inicio', DataTermino = '$data_termino', idEmpresa = $id_empresa, Valor = $valor WHERE idProjeto = $id_projeto";

    if ($mysqli->query($sql_atualizar_projeto) === TRUE) {
        echo "Projeto atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o projeto: " . $mysqli->error;
    }
}

$sql_projetos = "SELECT idProjeto, DataInicio, DataTermino, idEmpresa, Valor FROM projeto";
$result_projetos = $mysqli->query($sql_projetos);

$sql_empresas = "SELECT idEmpresa, Nome FROM empresa";
$result_empresas = $mysqli->query($sql_empresas);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Projeto</title>
</head>
<body>
    <h1>Atualizar Projeto</h1>

    <form method="POST" action="">
        <label for="id_projeto">Selecione o Projeto a ser Atualizado:</label>
        <select name="id_projeto" required>
            <?php
            while ($row = $result_projetos->fetch_assoc()) {
                echo "<option value='" . $row["idProjeto"] . "'>Projeto ID: " . $row["idProjeto"] . "</option>";
            }
            ?>
        </select><br>

        <label for="data_inicio">Nova Data de Início:</label>
        <input type="date" name="data_inicio" required><br>

        <label for="data_termino">Nova Data de Término:</label>
        <input type="date" name="data_termino"><br>

        <label for="id_empresa">Nova Empresa:</label>
        <select name="id_empresa" required>
            <?php
            while ($row = $result_empresas->fetch_assoc()) {
                echo "<option value='" . $row["idEmpresa"] . "'>" . $row["Nome"] . "</option>";
            }
            ?>
        </select><br>

        <label for="valor">Novo Valor do Projeto:</label>
        <input type="number" step="0.01" name="valor" required><br>

        <input type="submit" value="Atualizar Projeto"><br><br>
        <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
    </form>
</body>
</html>
