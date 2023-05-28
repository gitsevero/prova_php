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
  <link rel="stylesheet" href="header.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="functions/deletar_ajax.js"></script>
  <title>Registros de Produtos</title>
</head>
<body>
  <header>
    <p> <a href="adicionar_produto_formulario.html"> Cadastro de produtos</a></p>
    <p> <a href="main.php">Home</a> </p>
    <p>produtos</p>
  </header>
  <main>
  <h2> Produtos</h2>
  <div>
    <button id="novo-produto"><a href="adicionar_produto_formulario.html">Novo produto</a></button>
    <button><a href='relatorio/txt_download.php'>TXT</a> </button>
    <button><a href='relatorio/excel_download.php'>EXCEL</a> </button>
    <button><a href='relatorio/pdf.php'>PDF</a></button>
  </div>
  <table id="produtos-table">
    <tr>
      <td>Categoria</td>
      <td>Nome</td>
      <td>Descrição</td>
      <td>Preço</td>
      <td></td>
    </tr>
    <?php
    // Consulta SQL para obter os registros da tabela
    $sql = "SELECT * FROM produtos";
    $resultado = mysqli_query($conexao, $sql);

    // Loop para exibir os registros na tabela
    while ($row = mysqli_fetch_assoc($resultado)) {
      echo "<tr>";
      echo "<td>" . $row['nome_categoria'] . "</td>";
      echo "<td>" . $row['nome_produto'] . "</td>";
      echo "<td>" . $row['descricao'] . "</td>";
      echo "<td>" . $row['preco'] . "</td>";
      echo "<td id='edit'><a href='#' class='deletar-link' data-id='" . $row['id'] . "' data-nome='" . $row['nome_produto'] . "'>deletar</a></td>";
      echo "</tr>";
}
    
    
    ?>
  </table>
  </main>
</body>

</html>
