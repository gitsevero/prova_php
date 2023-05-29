<?php
include '../functions/conexao.php'; 
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;



function baixarItens($conexao) {
    $sql = "SELECT id, nome_categoria, nome_produto, descricao, CONCAT(moeda, ' ',preco ) AS preco_com_moeda FROM produtos";
    $resultado = mysqli_query($conexao, $sql);

    if (!$resultado) {
        die("Erro na consulta: " . mysqli_error($conexao));
    }

  
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    
    $colunas = array('Nome de categoria', 'Nome', 'Descrição', 'preco_com_moeda');
    $colIndex = 1;
    foreach ($colunas as $coluna) {
        $sheet->setCellValueByColumnAndRow($colIndex, 1, $coluna);

   
        $cellStyle = $sheet->getStyleByColumnAndRow($colIndex, 1);
        $cellStyle->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('3075B6');

      
        $sheet->getColumnDimensionByColumn($colIndex)->setWidth(20);

        
        $fontStyle = $sheet->getStyleByColumnAndRow($colIndex, 1)->getFont();
        $fontStyle->getColor()->setRGB('FFFFFF');

       
        $alignment = $sheet->getStyleByColumnAndRow($colIndex, 1)->getAlignment();
        $alignment->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $colIndex++;
    }

    
    $rowIndex = 2;
    while ($row = mysqli_fetch_assoc($resultado)) {
        $colIndex = 1;
        foreach ($row as $cellValue) {
            $sheet->setCellValueByColumnAndRow($colIndex, $rowIndex, $cellValue);
            $colIndex++;
        }
        $rowIndex++;
    }

 
    $writer = new Xlsx($spreadsheet);
    $nomeArquivo = "itens.xlsx";
    $writer->save($nomeArquivo);

    
    return $nomeArquivo;
}


$nomeArquivo = baixarItens($conexao);


header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment; filename=$nomeArquivo");
header("Content-Length: " . filesize($nomeArquivo));


readfile($nomeArquivo);


unlink($nomeArquivo);
exit;
?>
