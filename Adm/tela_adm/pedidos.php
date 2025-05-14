<?php
// Configuração de conexão ao banco de dados
$host = '45.152.44.154';
$usuario = 'u451416913_grupo05';
$senha = 'Grupo05@123';
$bancoDeDados = 'u451416913_grupo05';

// Conectar ao banco de dados
$conexao = new mysqli($host, $usuario, $senha, $bancoDeDados);

// Verificar a conexão
if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

// Função para arquivar um pedido
function arquivarPedido($conexao, $pedidoId) {
    // Atualizar o status do pedido no banco de dados para arquivado
    $atualizarQuery = "UPDATE Pedidos SET arquivado = 1 WHERE idPed = $pedidoId";
    $conexao->query($atualizarQuery);

    // Verificar se a atualização foi bem-sucedida
    if ($conexao->affected_rows > 0) {
        return true; // Pedido arquivado com sucesso
    } else {
        return false; // Falha ao arquivar o pedido
    }
}

// Se houver uma solicitação para arquivar um pedido
if (isset($_GET['arquivar_pedido'])) {
    $pedidoId = $_GET['arquivar_pedido'];

    if (arquivarPedido($conexao, $pedidoId)) {
        // Pedido arquivado com sucesso, redirecionar para a mesma página
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        // Falha ao arquivar o pedido, tratamento necessário conforme a sua lógica
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_pedido.css">
    <link rel="stylesheet" href="sidemenu.css">
    <title>Adm Page</title>
</head>
<body>  
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="principal.php">Dashboard</a>
        <a href="food.php">Cadastro de alimentos</a>
        <a href="estoque.php">Produtos em Estoque</a>
        <a href="Zerado.php">Produtos Zerados</a>
        <a href="pedidos.php">Pedidos</a>
    </div>
    <div id="main">
        <span class="openbtn" onclick="openNav()">&#9776;</span>
        <div id="cart-icon" onclick="openCartPage()"></div>

        <div class="container">
            <h2>Lista de Pedidos</h2>

            <?php
            // Consulta SQL para obter pedidos NÃO arquivados do banco de dados
            $query = "SELECT Ped_Prod.idPed, Ped_Prod.idProd, Ped_Prod.quantidade, Pedidos.idusuario, Pedidos.data, Pedidos.idcantinas, Produtos.preço_cliente
                        FROM Ped_Prod
                        JOIN Pedidos ON Ped_Prod.idPed = Pedidos.idPed
                        JOIN Produtos ON Ped_Prod.idProd = Produtos.idProd
                        WHERE Pedidos.arquivado = 0"; // Adicionei essa condição

            $resultado = $conexao->query($query);

            while ($order = $resultado->fetch_assoc()) {
                echo '<div class="card" id="pedido_' . $order['idPed'] . '">';
                echo '<p><strong>ID do Pedido:</strong> ' . $order['idPed'] . '</p>';
                echo '<p><strong>ID do Produto:</strong> ' . $order['idProd'] . '</p>';
                echo '<p><strong>Quantidade:</strong> ' . $order['quantidade'] . '</p>';
                echo '<p><strong>Preço Unitário:</strong> $' . number_format($order['preço_cliente'], 2) . '</p>';

                // Calcular o preço total (preço unitário * quantidade)
                $precoTotal = $order['preço_cliente'] * $order['quantidade'];
                echo '<p><strong>Preço Total:</strong> $' . number_format($precoTotal, 2) . '</p>';
                
                echo '<p><strong>Data:</strong> ' . $order['data'] . '</p>';

                echo '<a href="?arquivar_pedido=' . $order['idPed'] . '" class="archive-btn">Arquivar Pedido</a>';
            }
            ?>
        </div>

        <div id="pedidos_arquivados">
            <h2>Pedidos Arquivados</h2>
            <!-- Aqui será exibida a lista de pedidos arquivados -->
            <?php
            // Consulta SQL para obter pedidos arquivados do banco de dados
            $queryArquivados = "SELECT Ped_Prod.idPed, Ped_Prod.idProd, Ped_Prod.quantidade, Pedidos.idusuario, Pedidos.data, Pedidos.idcantinas, Produtos.preço_cliente
                                FROM Ped_Prod
                                JOIN Pedidos ON Ped_Prod.idPed = Pedidos.idPed
                                JOIN Produtos ON Ped_Prod.idProd = Produtos.idProd
                                WHERE Pedidos.arquivado = 1"; // Adicionei essa condição

            $resultadoArquivados = $conexao->query($queryArquivados);

            while ($orderArquivado = $resultadoArquivados->fetch_assoc()) {
                echo '<div class="card" id="pedido_arquivado_' . $orderArquivado['idPed'] . '">';
                echo '<p><strong>ID do Pedido:</strong> ' . $orderArquivado['idPed'] . '</p>';
                echo '<p><strong>ID do Produto:</strong> ' . $orderArquivado['idProd'] . '</p>';
                echo '<p><strong>Quantidade:</strong> ' . $orderArquivado['quantidade'] . '</p>';
                echo '<p><strong>Preço Unitário:</strong> $' . number_format($orderArquivado['preço_cliente'], 2) . '</p>';
        
                // Calcular o preço total (preço unitário * quantidade)
                $precoTotalArquivado = $orderArquivado['preço_cliente'] * $orderArquivado['quantidade'];
                echo '<p><strong>Preço Total:</strong> $' . number_format($precoTotalArquivado, 2) . '</p>';
        
                echo '<p><strong>Data:</strong> ' . $orderArquivado['data'] . '</p>';
                echo '</div>';
            }
            ?>
        </div>

        <script src="script1.js"></script>
    </div>
</body>
</html>

<?php
// Fechar a conexão com o banco de dados
$conexao->close();
?>
