<?php

include '../functions/conexao.php'; 

function baixarItens($conexao) {
    $sql = "SELECT  nome_categoria, nome_produto, descricao, CONCAT(moeda, ' ',preco ) AS preco_com_moeda FROM produtos";
    $resultado = mysqli_query($conexao, $sql);

    if (!$resultado) {
        die("Erro na consulta: " . mysqli_error($conexao));
    }


    $arquivo = fopen("itens.txt", "w");

    if (!$arquivo) {
        die("Falha ao criar o arquivo");
    }

    while ($row = mysqli_fetch_assoc($resultado)) {
        $linha = implode(";", $row) . PHP_EOL;
        fwrite($arquivo, $linha);
    }

  
    fclose($arquivo);


    return "itens.txt";
}


$nomeArquivo = baixarItens($conexao);

header("Content-Type: text/plain");
header("Content-Disposition: attachment; filename=$nomeArquivo");
header("Content-Length: " . filesize($nomeArquivo));


readfile($nomeArquivo);


unlink($nomeArquivo);
exit;

?>
