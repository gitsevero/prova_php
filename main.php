<?php  include 'func_php/conexao.php';?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/style_main.css">
    <link rel="stylesheet" href="css/header.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="functions/deletar_ajax.js"></script>
    <title>Registros de Produtos</title>
    <script>
       
        function removeURLParams() {
            if (history.replaceState) {
                var cleanURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
                history.replaceState(null, null, cleanURL);
            }
        }

       
        const urlParams = new URLSearchParams(window.location.search);
        const successParam = urlParams.get('success');

     
        if (successParam === 'true') {
            alert('Alterações foram salvas com sucesso!');
            removeURLParams();
        }
    </script>
</head>

<body>
    <header>
        <p> <a href="adicionar_produto_formulario.html"> Cadastro de produtos</a></p>
        <p> <a href="main.php">Home</a> </p>
        <p>produtos</p>
    </header>
    <main>
        <h2> Produtos</h2>
        <div id="buttons">
          
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
            
            $sql = "SELECT * FROM produtos";
            $resultado = mysqli_query($conexao, $sql);

            while ($row = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $row['nome_categoria'] . "</td>";
                echo "<td>" . $row['nome_produto'] . "</td>";
                echo "<td>" . $row['descricao'] . "</td>";
                echo "<td>" . $row['preco'] . "</td>";
                
                echo "<td id='edit'><a href='editar_produto.php?id=" . $row['id'] . "'>editar</a>|<a href='detalhes_produto.php?id=" . $row['id'] . "'>detalhes</a>|<a href='#' class='deletar-link' data-id='" . $row['id'] . "' data-nome='" . $row['nome_produto'] . "'>deletar</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </main>
</body>

</html>
