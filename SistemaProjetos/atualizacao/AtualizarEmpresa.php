<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_empresa = $_POST["id_empresa"];
    $nome = $_POST["nome"];
    $cnpj = $_POST["cnpj"];
    $novo_endereco_rua = $_POST["novo_endereco_rua"];
    $novo_endereco_numero = $_POST["novo_endereco_numero"];
    $novo_endereco_bairro = $_POST["novo_endereco_bairro"];
    $novo_endereco_cidade = $_POST["novo_endereco_cidade"];

    $sql_dados_atuais = "SELECT nome, CNPJ, idEndereco FROM empresa WHERE idEmpresa = $id_empresa";
    $result_dados_atuais = $mysqli->query($sql_dados_atuais);

    if ($result_dados_atuais->num_rows > 0) {
        $row = $result_dados_atuais->fetch_assoc();
        $nome_antigo = $row["nome"];
        $cnpj_antigo = $row["CNPJ"];
        $id_endereco_antigo = $row["idEndereco"];
    }

    $sql_atualizar_empresa = "UPDATE empresa SET nome = '$nome', CNPJ = '$cnpj'";

    if (!empty($novo_endereco_rua) && !empty($novo_endereco_numero) && !empty($novo_endereco_bairro) && !empty($novo_endereco_cidade)) {
        $sql_novo_endereco = "INSERT INTO endereco (Rua, Numero, Bairro, Cidade) VALUES ('$novo_endereco_rua', $novo_endereco_numero, '$novo_endereco_bairro', '$novo_endereco_cidade')";

        if ($mysqli->query($sql_novo_endereco) === TRUE) {
            $novo_endereco_id = $mysqli->insert_id;
            $sql_atualizar_empresa .= ", idEndereco = $novo_endereco_id";
        } else {
            echo "Erro ao criar o novo endereço: " . $mysqli->error;
        }
    }

    $sql_atualizar_empresa .= " WHERE idEmpresa = $id_empresa";

    if ($mysqli->query($sql_atualizar_empresa) === TRUE) {
        $mensagem = "Empresa atualizada com sucesso! Nome alterado de $nome_antigo para $nome, CNPJ alterado de $cnpj_antigo para $cnpj.";

        if (!empty($novo_endereco_rua) && !empty($novo_endereco_numero) && !empty($novo_endereco_bairro) && !empty($novo_endereco_cidade)) {
            $mensagem .= " Endereço atualizado.";
        }

        echo $mensagem;
    } else {
        echo "Erro ao atualizar a empresa: " . $mysqli->error;
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
    <title>Atualizar Empresa</title>
</head>
<body>
    <h1>Atualizar Empresa</h1>

    <form method="POST" action="">
        <label for="id_empresa">Selecione a Empresa:</label>
        <select name="id_empresa" required>
            <?php
            while ($row = $result_empresas->fetch_assoc()) {
                echo "<option value='" . $row["idEmpresa"] . "'>" . $row["Nome"] . "</option>";
            }
            ?>
        </select><br>

        <label for="nome">Novo Nome da Empresa:</label>
        <input type="text" name="nome" required><br>

        <label for="cnpj">Novo CNPJ da Empresa:</label>
        <input type="text" name="cnpj" required><br>

        <label for="novo_endereco_rua">Novo Endereço (Rua):</label>
        <input type="text" name="novo_endereco_rua"><br>

        <label for="novo_endereco_numero">Novo Endereço (Número):</label>
        <input type="number" name="novo_endereco_numero"><br>

        <label for="novo_endereco_bairro">Novo Endereço (Bairro):</label>
        <input type="text" name="novo_endereco_bairro"><br>

        <label for="novo_endereco_cidade">Novo Endereço (Cidade):</label>
        <input type="text" name="novo_endereco_cidade"><br>

        <input type="submit" value="Atualizar Empresa"><br><br>
        <button onclick="window.location.href='../index.php'">Voltar para a Página Inicial</button>
    </form>
</body>
</html>
