<?php
include 'functions/conexao.php';
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/style_main.css">
    <link rel="stylesheet" href="css/header.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="functions/deletar_ajax_categoria.js"></script>
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
        <p> <a href="adicionar_produto_formulario.php"> Cadastro de produtos</a></p>
        <p><a href="main.php">Home</a></p>
        <p><a href="categoria.php">Produtos</a></p>
    </header>
    <main>
        <h2> Categorias</h2>
        <div id="buttons">
            <button ><a href='adicionar_categoria.html'>Nova categoria</a></button>
            
        </div>
        <table id="produtos-table">
            <tr><td>ID</td>
                <td>Categoria</td>
                <td></td>
            </tr>
            <?php
            $sql = "SELECT id, categorias_de_produtos FROM categorias";
            $resultado = mysqli_query($conexao, $sql);
            
            while ($row = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['categorias_de_produtos'] . "</td>";
                echo "<td id='edit'><a href='editar_categoria.php?id=" . $row['id'] . "'>editar</a>|<a href='#' class='deletar-link' data-id='" . $row['id'] . "' data-nome='" . $row['categorias_de_produtos'] . "'>deletar</a></td>
                ";
                echo "</tr>";
            }
            
            ?>
        </table>
    </main>
</body>

</html>
