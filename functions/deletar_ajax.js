$(document).ready(function () {

    function deletarProduto(id, nome) {
        $.ajax({
            type: "GET",
            url: "deletar_produto.php",
            data: { id: id },
            success: function () {

                location.reload();
            },
            error: function () {
                alert("Erro ao deletar o produto.");
            }
        });
    }


    $("body").on("click", ".deletar-link", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var nomeProduto = $(this).data("nome");
        if (confirm("Deseja realmente deletar o produto '" + nomeProduto + "'?")) {
            deletarProduto(id, nomeProduto);
        }
    });
});
