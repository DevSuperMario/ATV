<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <img src="./img/Wallpaperphp.png" alt="Cabeçalho">
        <h1>Sistema de Cadastro de Produtos</h1>
    </header>

    <div>
        <h2 class="title">Cadastro de Produtos</h2>

        <section class="form_table">
            <form action="index.php" method="POST">
                <label for="nome_produto">Nome do Produto:</label>
                <input type="text" id="nome_produto" name="nome_produto" required>

                <label for="preco_compra">Preço de Compra:</label>
                <input type="number" step="0.01" id="preco_compra" name="preco_compra" required>

                <label for="preco_venda">Preço de Venda:</label>
                <input type="number" step="0.01" id="preco_venda" name="preco_venda" required>

                <label for="codigo_produto">Código do Produto:</label>
                <input type="text" id="codigo_produto" name="codigo_produto" required>

                <label for="codigo_fornecedor">Nome do Fornecedor:</label>
                <select name="codigo_fornecedor" id="codigo_fornecedor">
                    <?php
                    require 'config.php';

                    $fornecedores = $conn->query("select * from fornecedores");

                    if ($fornecedores->num_rows > 0) {

                        $fornecedores_array = $fornecedores->fetch_all(MYSQLI_ASSOC);

                        foreach ($fornecedores_array as $fornecedor) {
                            echo "<option value='" . $fornecedor['codigo_fornecedor'] . "'>" . $fornecedor['nome_fornecedor'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Nenhum fornecedor encontrado</option>";
                    }

                    $conn->close();
                    ?>
                </select>

                <input type="submit" value="Cadastrar Produto">
            </form>

            <div class="div_table">
                <table>
                    <thead>
                        <th>Código</th>
                        <th>Nome/Descrição</th>
                        <th>Preço de compra</th>
                        <th>Preço de venda</th>
                        <th>Fornecedor</th>
                    </thead>

                    <tbody>
                        <?php
                        require 'config.php';

                        $produtos = $conn->query("select p.*, f.nome_fornecedor from produtos p inner join fornecedores f on (p.codigo_fornecedor = f.codigo_fornecedor)");

                        if ($produtos->num_rows > 0) {

                            $produtos_array = $produtos->fetch_all(MYSQLI_ASSOC);

                            foreach ($produtos as $produto) {
                                echo "
                                            <tr>
                                                <td>" . $produto['codigo_produto'] . "</td>
                                                <td>" . $produto['nome_produto'] . "</td>
                                                <td>" . $produto['preco_compra'] . "</td>
                                                <td>" . $produto['preco_venda'] . "</td>
                                                <td>" . $produto['nome_fornecedor'] . "</td>
                                            </tr>
                                        ";
                            }
                        } else {
                            echo "
                                        <tr>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                    ";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <footer>
        <p>&copy; 2024 - Sistema de Cadastro de Produtos M.M</p>
    </footer>
</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
}
require 'config.php';

$nome_produto = $_POST['nome_produto'];
$preco_compra = $_POST['preco_compra'];
$preco_venda = $_POST['preco_venda'];
$codigo_produto = $_POST['codigo_produto'];
$codigo_fornecedor = $_POST['codigo_fornecedor'];

$gravar_produto = $conn->query("insert into produtos (codigo_produto, nome_produto, preco_compra, preco_venda, codigo_fornecedor) values (" . $codigo_produto . ", '" . $nome_produto . "', " . $preco_compra . ", " . $preco_venda . ", " . $codigo_fornecedor . ")");

if ($gravar_produto) {
    echo "<p>Produto cadastrado com sucesso!</p>";
} else {
    echo "<p>Erro ao cadastrar o produto! [" . $conn->error . "]</p>";
}

$conn->close();

?>