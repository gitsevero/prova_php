<?php
require('vendor/tecnickcom/tcpdf/tcpdf.php');




function gerarPDF() {
    // Cria um novo objeto TCPDF
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

    // Define o título do documento
    $pdf->SetTitle('Registros de Produtos');

    // Adiciona uma página
    $pdf->AddPage();

    // Define o conteúdo da tabela
    $conteudo = '
    <table cellpadding="5">
        <tr>
            <th style="background-color:#3374b1;border:1px solid #000;text-align: center; color:#FFFFFF">ID</th>
            <th style="background-color:#3374b1;border:1px solid #000;text-align: center; color:#FFFFFF">Categoria</th>
            <th style="background-color:#3374b1;border:1px solid #000;text-align: center;color:#FFFFFF">Nome</th>
            <th style="background-color:#3374b1;border:1px solid #000;text-align: center; color:#FFFFFF">Descrição</th>
            <th style="background-color:#3374b1;border:1px solid #000;text-align: center; color:#FFFFFF">Preço</th>
        </tr>';

// ...



    // Consulta SQL para obter os registros da tabela
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

    $sql = "SELECT * FROM produtos";
    $resultado = mysqli_query($conexao, $sql);

    // Loop para adicionar os registros à tabela no PDF
    while ($row = mysqli_fetch_assoc($resultado)) {
        $conteudo .= '
            <tr>
                <td style="border: .5px solid #000; text-align: center; padding: 5px;">' . $row['id'] . '</td>
                <td style="border: .5px solid #000; text-align: center; padding: 5px;">' . $row['nome_categoria'] . '</td>
                <td style="border: .5px solid #000; text-align: center; padding: 5px;">' . $row['nome_produto'] . '</td>
                <td style="border: .5px solid #000; text-align: center; padding: 5px; word-break: break-all;">' . $row['descricao'] . '</td>
                <td style="border: .5px solid #000; text-align: center; padding: 5px;">' . $row['preco'] . '</td>
            </tr>';
    }
    
    $conteudo .= '</table>';

    // Define o conteúdo no PDF
    $pdf->writeHTML($conteudo, true, false, true, false, '');

    // Gera o arquivo PDF
    $pdf->Output('registros_produtos.pdf', 'D');
}

// Chama a função para gerar o PDF
gerarPDF();
?>
