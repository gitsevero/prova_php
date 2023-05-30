<?php
include 'functions/conexao.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_POST['nome_produto']) && isset($_POST['descricao'])&& isset($_POST['categoria']) && isset($_POST['preco'])) {
        $nome_produto = $_POST['nome_produto'];
        $nome_categoria = $_POST['categoria'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $sql = "UPDATE produtos SET nome_categoria='$nome_categoria', nome_produto = '$nome_produto', descricao = '$descricao', preco = '$preco', data_atualizacao = CURRENT_TIMESTAMP WHERE id = $id";

        if ($conexao->query($sql) === TRUE) {
            header("Location: main.php?id=$id&success=true");
            exit;
        } else {
            echo "Erro ao editar o produto: " . $conexao->error;
        }
    }

    $sql = "SELECT * FROM produtos WHERE id = $id";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nome_produto = $row['nome_produto'];
        $descricao = $row['descricao'];
        $preco = $row['preco'];
    } else {
        echo "Produto não encontrado.";
    }

    $conexao->close();
} else {
    echo "ID do produto inválido.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Editar Produto</title>
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
    <h1>Editar Produto</h1>
    <main>
        <form method="POST" action="editar_produto.php?id=<?php echo $id; ?>">
            <label for="nome">Nome do produto:</label>
            <input type="text" name="nome_produto" value="<?php echo $nome_produto; ?>" required><br>
            <select name="categoria" required>
            <option value="" disabled selected>Selecione a categoria</option>
            <?php
            include 'functions/conexao.php';
            $sql2 = "SELECT categorias_de_produtos FROM categorias";
            $resultado2 = mysqli_query($conexao, $sql2);
            
            while ($row = mysqli_fetch_assoc($resultado2)) {
                
                echo "<option>" . $row['categorias_de_produtos'] . "</option>";
              
            }
            
            ?>

         

            </select>
            <label for="descricao">Descrição:</label>
            <textarea name="descricao" required><?php echo $descricao; ?></textarea><br>

            <label for="preco">Preço:</label>
            <input type="text" name="preco" value="<?php echo $preco; ?>" required><br>

            <input type="submit" value="Salvar Alterações">
        </form>
    </main>

    <script>
       
        const urlParams = new URLSearchParams(window.location.search);
        const successParam = urlParams.get('success');

       
        if (successParam === 'true') {
            alert('Alterações foram salvas com sucesso!');
        }
    </script>
</body>

</html>
