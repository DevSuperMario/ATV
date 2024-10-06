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

    <!--
    <nav>
        <ul>
            <li><a href="index.php">Cadastrar Produto</a></li>
            <li><a href="#">Visualizar Produtos</a></li>
            <li><a href="#">Gerenciar Fornecedores</a></li>
        </ul>
    </nav>
-->
    <section>
        <h2>Cadastro de Produtos</h2>

        <form action="index.php" method="POST">
            <label for="nome_produto">Nome do Produto:</label>
            <input type="text" id="nome_produto" name="nome_produto" required>

            <label for="preco_compra">Preço de Compra:</label>
            <input type="number" step="0.01" id="preco_compra" name="preco_compra" required>

            <label for="preco_venda">Preço de Venda:</label>
            <input type="number" step="0.01" id="preco_venda" name="preco_venda" required>

            <label for="codigo_produto">Código do Produto:</label>
            <input type="text" id="codigo_produto" name="codigo_produto" required>

            <label for="nome_fornecedor">Nome do Fornecedor:</label>
            <input type="text" id="nome_fornecedor" name="nome_fornecedor" required>

            <input type="submit" value="Cadastrar Produto">
        </form>

        <?php

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "produtos";
           
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Conexão falhou: " . $conn->connect_error);
            }



           
            $nome_produto = $_GET['nome_produto'];
            $preco_compra = $_GET['preco_compra'];
            $preco_venda = $_GET['preco_venda'];
            $codigo_produto = $_GET['codigo_produto'];
            $nome_fornecedor = $_GET['nome_fornecedor'];

        



            $sql = "INSERT INTO produtos (nome_produto, preco_compra, preco_venda, codigo_produto, nome_fornecedor) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql); 
            $stmt->bind_param($nome_produto, $preco_compra, $preco_venda, $codigo_produto, $nome_fornecedor);

            if ($stmt->execute()) {
                echo "<p>Produto cadastrado com sucesso !</p>";
            } else {
                echo "<p>Erro ao cadastrar produto: " . $stmt->error . "</p>";
            }

            
            $stmt->close();
            $conn->close();
        

        ?>
    </section>

    <footer>
        <p>&copy; 2024 - Sistema de Cadastro de Produtos M.M</p>
    </footer>
</body>
</html>