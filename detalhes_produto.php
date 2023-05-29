<?php
include 'functions/conexao.php';


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM produtos WHERE id = $id";
    $result = $conexao->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nome_categoria = $row['nome_categoria'];
        $nome_produto = $row['nome_produto'];
        $descricao = $row['descricao'];
        $preco = $row['preco'];
        $data_criacao = $row['data_criacao'];
        $data_atualizacao = $row['data_atualizacao'];
    } else {
        echo "Produto não encontrado.";
    }

    $conexao->close();
} else {
    echo "ID do produto inválido.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Detalhes do Produto</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header.css">
</head>

<body>
    <header>
        <p> <a href="adicionar_produto_formulario.html">Cadastro de produtos</a> </p>
        <p> <a href="main.php">Home</a> </p>
        <p>produtos</p>
    </header>
    <h1>Detalhes do Produto</h1>
    <main>
        <table>
            <tr>
                <td>ID:</td>
                <td><?php echo $id; ?></td>
            </tr>
            <tr>
                <td>Categoria:</td>
                <td><?php echo $nome_categoria; ?></td>
            </tr>
            <tr>
                <td>Nome do Produto:</td>
                <td><?php echo $nome_produto; ?></td>
            </tr>
            <tr>
                <td>Descrição:</td>
                <td><?php echo $descricao; ?></td>
            </tr>
            <tr>
                <td>Preço:</td>
                <td><?php echo $preco; ?></td>
            </tr>
            <tr>
                <td>Data de Criação:</td>
                <td><?php echo $data_criacao; ?></td>
            </tr>
            <tr>
                <td>Data de Atualização:</td>
                <td><?php echo $data_atualizacao; ?></td>
            </tr>
        </table>
    </main>
</body>

</html>
