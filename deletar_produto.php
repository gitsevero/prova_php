<?php
$servername = "localhost";
$username = "root";
$password = "9jnE[NGWw!zXHLqX";
$database = "product_crud";

// Cria a conexão
$conexao = mysqli_connect($servername, $username, $password, $database);

// Verifica a conexão
if (!$conexao) {
  die("Falha na conexão: " . mysqli_connect_error());
}

// Verifica se o parâmetro 'id' foi fornecido
if (!isset($_GET['id'])) {
  exit;
}

// Obtém o ID do produto a ser excluído
$id = $_GET['id'];

// Lógica para excluir o produto do banco de dados
$sql = "DELETE FROM produtos WHERE id = $id";
$resultado = mysqli_query($conexao, $sql);

// Fecha a conexão com o banco de dados
mysqli_close($conexao);
?>
