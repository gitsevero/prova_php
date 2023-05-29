<?php
$servername = "localhost";
$username = "root";
$password = "9jnE[NGWw!zXHLqX";
$database = "product_crud";
$conexao = mysqli_connect($servername, $username, $password, $database);
if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}
?>
