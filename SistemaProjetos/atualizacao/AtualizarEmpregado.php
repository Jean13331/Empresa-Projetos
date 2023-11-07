<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_empregado = $_POST["id_empregado"];
    $nome = $_POST["nome"];
    $num_identidade = $_POST["num_identidade"];
    $id_especializacao = $_POST["id_especializacao"];

    $sql_dados_atuais = "SELECT nome, NumIdentidade FROM empregado WHERE idEmpregado = $id_empregado";
    $result_dados_atuais = $mysqli->query($sql_dados_atuais);

    if ($result_dados_atuais->num_rows > 0) {
        $row = $result_dados_atuais->fetch_assoc();
        $nome_antigo = $row["nome"];
        $num_identidade_antigo = $row["NumIdentidade"];
    }

    $sql_atualizar_empregado = "UPDATE empregado SET nome = '$nome', NumIdentidade = '$num_identidade', idEspecializacao = $id_empregado WHERE idEmpregado = $id_empregado";

    if ($mysqli->query($sql_atualizar_empregado) === TRUE) {
        echo "Empregado atualizado com sucesso! Nome alterado de $nome_antigo para $nome, Número de Identidade alterado de $num_identidade_antigo para $num_identidade.";
    } else {
        echo "Erro ao atualizar o empregado: " . $mysqli->error;
    }
}

$sql_empregados = "SELECT idEmpregado, nome FROM empregado";
$result_empregados = $mysqli->query($sql_empregados);

$sql_especializacoes = "SELECT idEspecializacao, Nome FROM especializacao";
$result_especializacoes = $mysqli->query($sql_especializacoes);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Empregado</title>
</head>
<body>
    <h1>Atualizar Empregado</h1>

    <form method="POST" action="">
        <label for="id_empregado">Selecione o Empregado:</label>
        <select name="id_empregado" required>
            <?php
            while ($row = $result_empregados->fetch_assoc()) {
                echo "<option value='" . $row["idEmpregado"] . "'>" . $row["nome"] . "</option>";
            }
            ?>
        </select><br>

        <label for="nome">Novo Nome do Empregado:</label>
        <input type="text" name="nome" required><br>

        <label for="num_identidade">Novo Número de Identidade:</label>
        <input type="text" name="num_identidade" required><br>

        <label for="id_especializacao">Nova Especialização:</label>
        <select name="id_especializacao" required>
            <?php
            while ($row = $result_especializacoes->fetch_assoc()) {
                echo "<option value='" . $row["idEspecializacao"] . "'>" . $row["Nome"] . "</option>";
            }
            ?>
        </select><br>

        <input type="submit" value="Atualizar Empregado"><br><br>
        <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
    </form>
</body>
</html>
