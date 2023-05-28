<?php
include 'conexao.php'; 

$nome_categoria = $_POST['nome_categoria'];
$nome_produto = $_POST['nome_produto'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
$sql = "INSERT INTO produtos (nome_categoria, nome_produto, descricao, preco, data_criacao, data_atualizacao) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("sssd", $nome_categoria, $nome_produto, $descricao, $preco);
if ($stmt->execute()) {
    header("Location: adicionar_produto_formulario.html?success=true");
    exit;
} else {
    echo "Erro ao adicionar o produto: " . $stmt->error;
}
$stmt->close();
$conexao->close();
?>
