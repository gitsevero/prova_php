<?php
require_once 'vendor/autoload.php';

use Mpdf\Mpdf;

// Ler o conteúdo do arquivo adicionar_produto_formulario.html
$html = file_get_contents('adicionar_produto_formulario.html');

// Criar uma instância do mPDF
$mpdf = new Mpdf();

// Converter o HTML para PDF
$mpdf->WriteHTML($html);

// Nome do arquivo PDF de saída
$nomeArquivo = 'adicionar_produto_formulario.pdf';

// Salvar o arquivo PDF
$mpdf->Output($nomeArquivo, 'D');
