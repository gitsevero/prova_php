<?php
include 'conexao.php';

$nome_categoria = $_POST['nome_categoria'];

$sql = "INSERT INTO categorias (categorias_de_produtos) VALUES (?)";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("s", $nome_categoria);

if ($stmt->execute()) {
    header("Location: ../adicionar_categoria.html?success=true");
    exit;
} else {
    echo "Erro ao adicionar a categoria: " . $stmt->error;
}

$stmt->close();
$conexao->close();
?>
