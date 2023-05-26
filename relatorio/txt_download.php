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

// Função para baixar os itens em um arquivo TXT
function baixarItens($conexao) {
    $sql = "SELECT * FROM produtos";
    $resultado = mysqli_query($conexao, $sql);

    if (!$resultado) {
        die("Erro na consulta: " . mysqli_error($conexao));
    }

    // Cria um arquivo para salvar os dados
    $arquivo = fopen("itens.txt", "w");

    if (!$arquivo) {
        die("Falha ao criar o arquivo");
    }

    // Escreve os dados linha a linha no arquivo
    while ($row = mysqli_fetch_assoc($resultado)) {
        $linha = implode(",", $row) . PHP_EOL;
        fwrite($arquivo, $linha);
    }

    // Fecha o arquivo
    fclose($arquivo);

    // Retorna o nome do arquivo
    return "itens.txt";
}

// Chama a função para baixar os itens
$nomeArquivo = baixarItens($conexao);

// Define o cabeçalho para fazer o download do arquivo
header("Content-Type: text/plain");
header("Content-Disposition: attachment; filename=$nomeArquivo");
header("Content-Length: " . filesize($nomeArquivo));

// Envia o conteúdo do arquivo para o navegador
readfile($nomeArquivo);

// Remove o arquivo após o download
unlink($nomeArquivo);
exit;

?>
