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

if (isset($_GET['download_pdf'])) {
  // Inclua o arquivo de classe do mPDF
  require_once 'vendor/autoload.php';

  // Crie uma instância do mPDF
  $mpdf = new \Mpdf\Mpdf();

  // Renderize o HTML atual no mPDF
  $html = ob_get_clean();
  $mpdf->WriteHTML($html);

  // Gere o nome do arquivo PDF com base na data e hora atual
  $filename = 'relatorio_' . date('YmdHis') . '.pdf';

  // Envie o PDF para o navegador para download
  $mpdf->Output($filename, 'D');
  exit();}

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style_main.css">
  <title>Registros de Produtos</title>
</head>
<body>
<button><a href="?download_pdf=true">PDF</a></button>
  <main>
  <h2> Produtos</h2>
  <div>
    <button id="novo-produto"><a href="adicionar_produto_formulario.html">Novo produto</a></button>
    <button><a href='/prova_php/relatorio/txt_download.php'>TXT</a> </button>
    
    <button><a href='/prova_php/relatorio/excel_download.php'>EXCEL</a> </button>
    <button>PDF</button>
  </div>
  <table id="produtos-table">
    <tr>
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
