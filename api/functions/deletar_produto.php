<?php
include 'conexao.php'; 
if (!isset($_GET['id'])) {
  exit;
}
$id = $_GET['id'];
$sql = "DELETE FROM produtos WHERE id = $id";
$resultado = mysqli_query($conexao, $sql);
mysqli_close($conexao);
?>
