<!-- arquivo pra criar a pagina de fornecedores, futuramente instanciar no index-->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <header>
        <img src="./img/Wallpaperphp.png" alt="Cabeçalho">
        <h1>Sistema de Cadastro de Forncecedores</h1>
    </header>

    <div>
        <h2 class="title">Cadastro de Forncecedores</h2>

        <section class="form_table">
            <form action="index.php" method="POST">
                <label for="nome_fornecedor">Nome do Fornecedor:</label>
                <input type="text" id="nome_produto" name="nome_produto" required>

                <label for="cnpj_fornecedor">cnpj do Fornecedor:</label>
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