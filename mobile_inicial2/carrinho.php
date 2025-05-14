<?php
session_start();

// Verificar se o ID do produto foi passado pela URL
if (isset($_GET['id'])) {
    // Conexão com o banco de dados
    $conn = new mysqli("45.152.44.154", "u451416913_grupo05", "Grupo05@123", "u451416913_grupo05");

    // Verificar se a conexão foi estabelecida corretamente
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    // Utilizando prepared statement para evitar SQL injection
    $id = $_GET['id'];
    $query = "SELECT * FROM Produtos WHERE idProd = ?";

    // Preparar e executar a consulta
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Obter o resultado da consulta
    $result = $stmt->get_result();

    // Verificar se a consulta retornou resultados
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Adicionar o produto ao carrinho
        $_SESSION['carrinho'][] = $row;
    }

    // Fechar a conexão e o statement
    $stmt->close();
    $conn->close();
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['voltar'])) {
        // Código para voltar e salvar o pedido
        $mensagemPedido = "Pedido salvo com sucesso!";
        // Redirecionar para a página anterior ou outra página desejada
        header("Location: index.php");
        exit();
    } elseif (isset($_POST['prosseguir'])) {
        // Redirecionar para a página de pagamento
        header("Location:index.php");
        exit();
    } elseif (isset($_POST['excluir']) && isset($_POST['item_index'])) {
        $index = $_POST['item_index'];
        if (isset($_SESSION['carrinho'][$index])) {
            unset($_SESSION['carrinho'][$index]);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="carrinho.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras - Minha Loja</title>
</head>
<body>

    <!-- CABEÇALHO -->
    <header>
        <h1>Snacktime</h1>
    </header>
    <!-- FECHAMENTO -->

    <!-- SIDEMENU -->
    <div class="sidemenu">
        <a href="index.php">
            <i class="fas fa-home"></i>
            Início
        </a>
        <a href="carrinho.php">
            <i class="fas fa-credit-card"></i>
            Pagamento
        </a>
        <a href="perfil.php"> 
            <i class="fas fa-user"></i>
            Perfil
        </a>
    </div>

    <!-- FECHAMENTO -->


    <!-- ABERTURA DO PHP -->
    <?php
    if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
        echo "<h2>Itens no Carrinho:</h2>";
        echo "<table>";
        echo "<tr><th>Alimento</th><th>Preço</th><th>Ação</th></tr>";

        $total = 0;

        foreach ($_SESSION['carrinho'] as $index => $item) {
            echo "<tr>";
            echo "<td>{$item['nomeAlimento']}</td>";
            echo "<td>R$ {$item['preço_cliente']}</td>";
            echo "<td><form method='post' action=''>";
            echo "<input type='hidden' name='item_index' value='$index'>";
            echo "<input type='submit' name='excluir' class='excluir-btn' value='Excluir'>";
            echo "</form></td>";
            echo "</tr>";

            // Adicionar o preço do item à soma total
            $total += $item['preço_cliente'];
        }

        // Exibir a linha com a soma total
        echo "<tr><td colspan='2'>Total</td><td>R$ $total</td></tr>";

        echo "</table>";
    } else {
        echo "<p>Carrinho vazio.</p>";
    }
    ?>

<form method="post" action="">
    <br> 
    <input type="submit" name="voltar" class="voltar-btn" value="Voltar e Salvar Pedido">
    <input type="submit" name="prosseguir" class="prosseguir-btn" value="Pagamento Realizado!">
    <p>Chave Pix: snacktime@gmail.com<p>
</form>
<br><br><br><br><br>
    

<?php
    if (isset($mensagemPedido)) {
        echo "<p>{$mensagemPedido}</p>";
    }
    ?>
  <!-- FECHAMENTO DO PHP-->

</body>
</html>
