$(document).ready(function () {
    // Função para deletar um produto
    function deletarProduto(id, nome) {
        $.ajax({
            type: "GET",
            url: "deletar_produto.php",
            data: { id: id },
            success: function () {
                // Atualize a tabela após a exclusão bem-sucedida
                location.reload();
            },
            error: function () {
                alert("Erro ao deletar o produto.");
            }
        });
    }

    // Manipulador de evento para o link de deletar
    $("body").on("click", ".deletar-link", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var nomeProduto = $(this).data("nome");
        if (confirm("Deseja realmente deletar o produto '" + nomeProduto + "'?")) {
            deletarProduto(id, nomeProduto);
        }
    });
});
