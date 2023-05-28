<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

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

// Função para baixar os itens em um arquivo Excel
function baixarItens($conexao) {
    $sql = "SELECT nome_categoria, nome_produto, descricao, preco FROM produtos";
    $resultado = mysqli_query($conexao, $sql);

    if (!$resultado) {
        die("Erro na consulta: " . mysqli_error($conexao));
    }

    // Cria um novo arquivo Excel
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Define o cabeçalho das colunas
    $colunas = array('Nome de categoria', 'Nome', 'Descrição', 'Preço');
    $colIndex = 1;
    foreach ($colunas as $coluna) {
        $sheet->setCellValueByColumnAndRow($colIndex, 1, $coluna);

        // Define o estilo da célula para a cor de fundo
        $cellStyle = $sheet->getStyleByColumnAndRow($colIndex, 1);
        $cellStyle->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('3075B6');

        // Define o tamanho da coluna
        $sheet->getColumnDimensionByColumn($colIndex)->setWidth(20);

        // Define o estilo da fonte
        $fontStyle = $sheet->getStyleByColumnAndRow($colIndex, 1)->getFont();
        $fontStyle->getColor()->setRGB('FFFFFF');

        // Centraliza o texto nas células
        $alignment = $sheet->getStyleByColumnAndRow($colIndex, 1)->getAlignment();
        $alignment->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $colIndex++;
    }

    // Preenche os dados
    $rowIndex = 2;
    while ($row = mysqli_fetch_assoc($resultado)) {
        $colIndex = 1;
        foreach ($row as $cellValue) {
            $sheet->setCellValueByColumnAndRow($colIndex, $rowIndex, $cellValue);
            $colIndex++;
        }
        $rowIndex++;
    }

    // Salva o arquivo Excel
    $writer = new Xlsx($spreadsheet);
    $nomeArquivo = "itens.xlsx";
    $writer->save($nomeArquivo);

    // Retorna o nome do arquivo
    return $nomeArquivo;
}

// Chama a função para baixar os itens
$nomeArquivo = baixarItens($conexao);

// Define o cabeçalho para fazer o download do arquivo
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment; filename=$nomeArquivo");
header("Content-Length: " . filesize($nomeArquivo));

// Envia o conteúdo do arquivo para o navegador
readfile($nomeArquivo);

// Exclui o arquivo Excel
unlink($nomeArquivo);
exit;
?>
