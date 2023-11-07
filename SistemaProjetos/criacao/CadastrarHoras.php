<?php
include("../conexao.php");

$sql_projetos = "SELECT idProjeto FROM projeto";
$result_projetos = $mysqli->query($sql_projetos);

$sql_empregados = "SELECT idEmpregado, Nome FROM empregado";
$result_empregados = $mysqli->query($sql_empregados);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_projeto = $_POST["id_projeto"];
    $id_empregado = $_POST["id_empregado"];
    $horas_trabalhadas = $_POST["horas_trabalhadas"];
    $funcao = $_POST["funcao"];

    $sql_cadastrar_horas_funcao = "INSERT INTO Empregado_Projeto (IdProjeto, IdEmpregado, IdFuncao, Horas_trabalhadas) VALUES ($id_projeto, $id_empregado, $funcao, '$horas_trabalhadas')";

    if ($mysqli->query($sql_cadastrar_horas_funcao) === TRUE) {
        echo "Horas trabalhadas e função cadastradas com sucesso!";
    } else {
        echo "Erro ao cadastrar as horas trabalhadas e função: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Horas e Função em Projeto</title>
</head>
<body>
    <h1>Cadastrar Horas e Função em Projeto</h1>

    <form method="POST" action="">
        <label for="id_projeto">Selecione o Projeto:</label>
        <select name="id_projeto" required>
            <?php
            while ($row = $result_projetos->fetch_assoc()) {
                echo "<option value='" . $row["idProjeto"] . "'>" . $row["idProjeto"] . "</option>";
            }
            ?>
        </select><br>

        <label for "id_empregado">Selecione o Empregado:</label>
        <select name="id_empregado" required>
            <?php
            while ($row = $result_empregados->fetch_assoc()) {
                echo "<option value='" . $row["idEmpregado"] . "'>" . $row["Nome"] . "</option>";
            }
            ?>
        </select><br>

        <label for="horas_trabalhadas">Horas Trabalhadas:</label>
        <input type="text" name="horas_trabalhadas" required><br>

        <label for="funcao">Função:</label>
        <select name="funcao" required>
            <?php
            $sql_funcoes = "SELECT idFuncao, Nome FROM funcao";
            $result_funcoes = $mysqli->query($sql_funcoes);

            if ($result_funcoes->num_rows > 0) {
                while ($row = $result_funcoes->fetch_assoc()) {
                    echo "<option value='" . $row["idFuncao"] . "'>" . $row["Nome"] . "</option>";
                }
            }
            ?>
        </select><br>

        <input type="submit" value="Cadastrar Horas e Função">
    </form>

    <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
</body>
</html>
