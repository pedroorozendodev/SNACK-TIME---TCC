<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="teste.css">
</head>
<body>
     

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
<!-- ENCERRAMENTO DO SIDEMENU-->



  
  <!-- ABERTURA CODIGO PHP PARA CARRINHO ass: pedroorozendo  -->
   <?php
    session_start();
    $quantidadeCarrinho = isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0;
    ?>
    <a href="carrinho.php">
        <i class="fas fa-shopping-cart cart-icon"></i> Carrinho (<?= $quantidadeCarrinho ?>)<br>
    </a><br>

    <?php
    // Conexão com o banco de dados
    $conn = new mysqli("45.152.44.154", "u451416913_grupo05", "Grupo05@123", "u451416913_grupo05");
    // Consulta para obter os produtos
    $query = "SELECT * FROM Produtos";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo '<div class="product-container">';
        while ($row = $result->fetch_assoc()) {
            echo '<div class="card">';
            echo "<div class='product'>";
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row["imagem"]) . '" alt="' . $row["nomeAlimento"] . '">';
            echo "<p>{$row['nomeAlimento']} - R$ {$row['preço_cliente']}</p>";
            echo "<a href='adicionar_carrinho.php?id={$row['idProd']}' style='
            display: inline-block;
            padding: 8px 15px;
            font-size: 14px;
            text-align: center;
            text-decoration: none;
            background-color: #0056b3;
            color: #ffffff;
            border-radius: 4px;
            border: 1px solid #0056b3;
        '>Adicionar</a>";
        
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p class="no-products">Nenhum produto disponível.</p>';
    }

    $conn->close();
    ?>
    <br>
    <br>
    <BR>
    <!-- FECHAMENTO DO CODIGO PHP ass: pedroorozendo -->
</body>
</html>
