<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_projeto = $_POST["id_projeto"];
    $id_empregado = $_POST["id_empregado"];
    $horas_trabalhadas = $_POST["horas_trabalhadas"];
    $funcao_nome = $_POST["funcao_nome"];
    $funcao_nova = $_POST["funcao_nova"];

    if (!empty($funcao_nova)) {
        $sql_inserir_funcao = "INSERT INTO funcao (Nome) VALUES ('$funcao_nova')";
        if ($mysqli->query($sql_inserir_funcao) === TRUE) {
            $id_funcao = $mysqli->insert_id;
        } else {
            echo "Erro ao inserir nova função: " . $mysqli->error;
        }
    } else {
        $sql_id_funcao = "SELECT idFuncao FROM funcao WHERE Nome = '$funcao_nome'";
        $result_id_funcao = $mysqli->query($sql_id_funcao);

        if ($result_id_funcao->num_rows > 0) {
            $row = $result_id_funcao->fetch_assoc();
            $id_funcao = $row["idFuncao"];
        } else {
            echo "Função não encontrada no banco de dados.";
        }
    }

    $sql_atualizar_horas_funcao = "UPDATE Empregado_Projeto SET Horas_trabalhadas = '$horas_trabalhadas', IdFuncao = $id_funcao WHERE IdProjeto = $id_projeto AND IdEmpregado = $id_empregado";

    if ($mysqli->query($sql_atualizar_horas_funcao) === TRUE) {
        echo "Horas trabalhadas e função atualizadas com sucesso!";
    } else {
        echo "Erro ao atualizar as horas trabalhadas e função: " . $mysqli->error;
    }
}

$sql_projetos = "SELECT idProjeto FROM projeto";
$result_projetos = $mysqli->query($sql_projetos);

$sql_empregados = "SELECT idEmpregado, Nome FROM empregado";
$result_empregados = $mysqli->query($sql_empregados);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Horas e Função em Projeto</title>
</head>
<body>
    <h1>Atualizar Horas e Função em Projeto</h1>
    <form method="POST" action="">

        <label for="id_projeto">Selecione o Projeto:</label>
        <select name="id_projeto" required>
            <?php
            while ($row = $result_projetos->fetch_assoc()) {
                echo "<option value='" . $row["idProjeto"] . "'>" . $row["idProjeto"] . "</option>";
            }
            ?>
        </select><br>

        <label for="id_empregado">Selecione o Empregado:</label>
        <select name="id_empregado" required>
            <?php
            while ($row = $result_empregados->fetch_assoc()) {
                echo "<option value='" . $row["idEmpregado"] . "'>" . $row["Nome"] . "</option>";
            }
            ?>
        </select><br>

        <label for="horas_trabalhadas">Horas Trabalhadas:</label>
        <input type="text" name="horas_trabalhadas" required><br>

        <label for="funcao_nome">Selecione ou insira o nome da Função:</label>
        <select name="funcao_nome" required>
            <option value="">Selecione uma Função</option>
            <?php
            $sql_funcoes = "SELECT Nome FROM funcao";
            $result_funcoes = $mysqli->query($sql_funcoes);
            while ($row = $result_funcoes->fetch_assoc()) {
                echo "<option value='" . $row["Nome"] . "'>" . $row["Nome"] . "</option>";
            }
            ?>
        </select>
        <input type="text" name="funcao_nova" placeholder="Nome da nova Função"><br>

        <input type="submit" value="Atualizar Horas e Função">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        echo "<h2>Resultados da Atualização:</h2>";
        echo "<p>Horas Trabalhadas atualizadas: " . $horas_trabalhadas . "</p>";
        echo "<p>Função atualizada: " . ($funcao_nova ? $funcao_nova : $funcao_nome) . "</p>";
        echo "<p>Projeto atualizado: " . $id_projeto . "</p>";
        echo "<p>Empregado atualizado: " . $id_empregado . "</p>";
    }
    
    ?>

    <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
</body>
</html>
