<?php
include 'functions/conexao.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Adicionar Produto</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header.css">
</head>

<body>
    <header>
        <p> <a href="adicionar_produto_formulario.php"> Cadastro de produtos</a></p>
        <p><a href="main.php">Home</a></p>
        <p><a href="categoria.php">Produtos</a></p>
    </header>
    <h1>Adicionar Produto</h1>
    <main>
        <form method="POST" action="functions/adicionar_produto.php">
            <label for="categoria">Nome da categoria:</label>
            <select name="categoria" required>
                <option value="" disabled selected>Selecione a categoria</option>
             <?php
             $sql = "SELECT categorias_de_produtos FROM categorias";
             $resultado = mysqli_query($conexao, $sql);

              while ($row = mysqli_fetch_assoc($resultado)) {
                 $categoria = $row['categorias_de_produtos'];
                      echo "<option value='$categoria'>$categoria</option>";
            }
              ?>
            </select>

            <label for="nome">Nome do produto:</label>
            <input type="text" name="nome_produto" minlength="3"><br>

            <label for="descricao">Descrição:</label>
            <textarea name="descricao" required minlength="8"></textarea><br>
            <label for="preco">Preço:</label>
            <div id="valor">
                <select name="moeda" required>
                    <option id="selectUM" value="" disabled selected>selecione a moeda</option>
                    <option value="USD">Dólar Americano (USD)</option>
                    <option value="EUR">Euro (EUR)</option>
                    <option value="JPY">Iene Japonês (JPY)</option>
                    <option value="R$">Real (R$)</option>
                </select>
                <input type="text" name="preco" required pattern="[0-9]+" title="Somente números são permitidos">
            </div>

            <input type="submit" value="Adicionar Produto">
        </form>
    </main>

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
            alert('Produto adicionado com sucesso!');
            removeURLParams();
        }
    </script>
</body>

</html>