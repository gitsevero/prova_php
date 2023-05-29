<?php
include '../functions/conexao.php'; 
require('vendor/tecnickcom/tcpdf/tcpdf.php');




function gerarPDF() {
   
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

    
    $pdf->SetTitle('Registros de Produtos');

   
    $pdf->AddPage();


    $conteudo = '
    <table cellpadding="5">
        <tr>
            
            <th style="background-color:#3374b1;border:1px solid #000;text-align: center; color:#FFFFFF">Categoria</th>
            <th style="background-color:#3374b1;border:1px solid #000;text-align: center;color:#FFFFFF">Nome</th>
            <th style="background-color:#3374b1;border:1px solid #000;text-align: center; color:#FFFFFF">Descrição</th>
            <th style="background-color:#3374b1;border:1px solid #000;text-align: center; color:#FFFFFF">Preço</th>
        </tr>';





    
    $servername = "localhost";
    $username = "root";
    $password = "9jnE[NGWw!zXHLqX";
    $database = "product_crud";

  
    $conexao = mysqli_connect($servername, $username, $password, $database);

 
    if (!$conexao) {
        die("Falha na conexão: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM produtos";
    $resultado = mysqli_query($conexao, $sql);


    while ($row = mysqli_fetch_assoc($resultado)) {
        $conteudo .= '
            <tr>
                <td style="border: .5px solid #000; text-align: center; padding: 5px;">' . $row['nome_categoria'] . '</td>
                <td style="border: .5px solid #000; text-align: center; padding: 5px;">' . $row['nome_produto'] . '</td>
                <td style="border: .5px solid #000; text-align: center; padding: 5px; word-break: break-all;">' . $row['descricao'] . '</td>
                <td style="border: .5px solid #000; text-align: center; padding: 5px;">' . $row['preco'] . '</td>
            </tr>';
    }
    
    $conteudo .= '</table>';

   
    $pdf->writeHTML($conteudo, true, false, true, false, '');

 
    $pdf->Output('registros_produtos.pdf', 'D');
}


gerarPDF();
?>
