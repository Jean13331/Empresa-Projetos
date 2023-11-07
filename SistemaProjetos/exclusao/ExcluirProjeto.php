<?php
include("../conexao.php");

$sql_projetos = "SELECT idProjeto FROM projeto";
$result_projetos = $mysqli->query($sql_projetos);

if ($result_projetos === false) {
    die("Erro na consulta SQL dos projetos: " . $mysqli->error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["projeto_id"])) {
    $projeto_id = $_POST["projeto_id"];
    
    $sql_excluir_empregados_projeto = "DELETE FROM Empregado_Projeto WHERE IdProjeto = $projeto_id";
    
    if ($mysqli->query($sql_excluir_empregados_projeto) === TRUE) {
        $sql_excluir_projeto = "DELETE FROM projeto WHERE idProjeto = $projeto_id";
    
        if ($mysqli->query($sql_excluir_projeto) === TRUE) {
            echo "Projeto com ID $projeto_id excluído com sucesso!";
        } else {
            echo "Erro ao excluir o projeto: " . $mysqli->error;
        }
    } else {
        echo "Erro ao excluir os registros relacionados na tabela Empregado_Projeto: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Excluir Projeto</title>
</head>
<body>
    <h1>Excluir Projeto</h1>
    <form method="POST" action="">
        <label for="projeto_id">Selecione o Projeto que deseja excluir:</label>
        <select name="projeto_id" required>
            <?php
            while ($row = $result_projetos->fetch_assoc()) {
                echo "<option value='" . $row["idProjeto"] . "'>" . $row["idProjeto"] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Excluir Projeto">
    </form>

    <br><br>
    <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
</body>
</html>
