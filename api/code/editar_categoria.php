<?php
include 'functions/conexao.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $categoria_id = $_GET['id'];
    if (isset($_POST['nome_categoria'])) {
        $nome_categoria = $_POST['nome_categoria'];
        $sql = "UPDATE categorias SET categorias_de_produtos = '$nome_categoria' WHERE id = $categoria_id";


        if ($conexao->query($sql) === TRUE) {
            header("Location: categoria.php?success=true");
            exit;
        } else {
            echo "Erro ao editar categoria: " . $conexao->error;
        }
    }

    $sql = "SELECT * FROM categorias WHERE id = $categoria_id";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nome_categoria = $row['categorias_de_produtos'];
    } else {
        echo "Categoria não encontrada.";
    }

    $conexao->close();
} else {
    echo "ID da categoria inválido.";
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Editar Categoria</title>
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
    <h1>Editar Categoria</h1>
    <main>
        <form method="POST" action="editar_categoria.php?id=<?php echo $categoria_id; ?>">

            <label for="nome">Nome da categoria:</label>
            <input type="text" name="nome_categoria" value="<?php echo $nome_categoria; ?>" required><br>

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
