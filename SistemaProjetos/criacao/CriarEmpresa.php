<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cnpj = $_POST["cnpj"];
    $nome = $_POST["nome"];
    $rua = $_POST["rua"];
    $numero = $_POST["numero"];
    $bairro = $_POST["bairro"];
    $cidade = $_POST["cidade"];

    $mysqli->begin_transaction();

    $sql_endereco = "INSERT INTO endereco (Rua, Numero, Bairro, Cidade) VALUES ('$rua', $numero, '$bairro', '$cidade')";

    if ($mysqli->query($sql_endereco) !== TRUE) {
        echo "Erro ao criar o endereço: " . $mysqli->error;
        $mysqli->rollback();
        $mysqli->close();
        exit();
    }

    $endereco_id = $mysqli->insert_id;

    $sql_empresa = "INSERT INTO empresa (CNPJ, Nome, idEndereco) VALUES ('$cnpj', '$nome', $endereco_id)";

    if ($mysqli->query($sql_empresa) === TRUE) {
        echo "Empresa e Endereço criados com sucesso!";
        $mysqli->commit();
    } else {
        echo "Erro ao criar a empresa: " . $mysqli->error;
        $mysqli->rollback();
    }

    $mysqli->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Empresa</title>
</head>
<body>
    <h1>Criar Nova Empresa e Endereço</h1>

    <form method="POST" action="">
        <h2>Informações da Empresa:</h2>
        <label for="cnpj">CNPJ:</label>
        <input type="text" name="cnpj" required><br>

        <label for="nome">Nome da Empresa:</label>
        <input type="text" name="nome" required><br>

        <h2>Informações do Endereço:</h2>
        <label for="rua">Rua:</label>
        <input type="text" name="rua" required><br>

        <label for="numero">Número:</label>
        <input type="number" name="numero" required><br>

        <label for="bairro">Bairro:</label>
        <input type="text" name="bairro" required><br>

        <label for="cidade">Cidade:</label>
        <input type="text" name="cidade" required><br><br>

        <input type="submit" value="Criar Empresa e Endereço"><br><br>
        <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
    </form>
</body>
</html>
