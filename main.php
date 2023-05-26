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
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style_main.css">
  <title>Registros de Produtos</title>
</head>
<body>
  <main>
  <h2> Produtos</h2>
  <table>
   
       
      <th>ID</th>
      <th>Categoria</th>
      <th>Nome</th>
      <th>Descrição</th>
      <th>Preço</th>
    </tr>
    <?php
    // Consulta SQL para obter os registros da tabela
    $sql = "SELECT * FROM produtos";
    $resultado = mysqli_query($conexao, $sql);

    // Loop para exibir os registros na tabela
    while ($row = mysqli_fetch_assoc($resultado)) {
      echo "<tr>";
      echo "<td>" . $row['id'] . "</td>";
      echo "<td>" . $row['nome_categoria'] . "</td>";
      echo "<td>" . $row['nome_produto'] . "</td>";
      echo "<td>" . $row['descricao'] . "</td>";
      echo "<td>" . $row['preco'] . "</td>";
      echo "</tr>";
    }
    ?>
  </table>
  </main>
</body>
</html>
