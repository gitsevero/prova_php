<?php
$servername = "localhost"; // Nome do servidor do banco de dados
$username = "root"; // Nome de usuário do banco de dados
$password = "9jnE[NGWw!zXHLqX"; // Senha do banco de dados
$database = "product_crud"; // Nome do banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}
?>
