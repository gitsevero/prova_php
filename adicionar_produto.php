<?php
$servername = "localhost";
$username = "root";
$password = "9jnE[NGWw!zXHLqX";
$database = "product_crud";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

$nome_categoria = $_POST['nome_categoria'];
$nome_produto = $_POST['nome_produto'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];

$sql = "INSERT INTO produtos (nome_categoria, nome_produto, descricao, preco) VALUES ('$nome_categoria', '$nome_produto', '$descricao', '$preco')";

if ($conn->query($sql) === TRUE) {
    // Redireciona para a página de formulário com o parâmetro de sucesso
    header("Location: adicionar_produto_formulario.html?success=true");
    exit;
} else {
    echo "Erro ao adicionar o produto: " . $conn->error;
}

$conn->close();
?>
