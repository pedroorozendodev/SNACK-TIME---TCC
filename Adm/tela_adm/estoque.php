<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque</title>
    <link rel="stylesheet" type="text/css" href="styleprodutos.css">
    <link rel="stylesheet" type="text/css" href="sidemenu.css">
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
            <div id="cart-icon" onclick="openCartPage()">
            </div>

        <table>
            <tr>
                <th>id Produto</th>
                <th>Tipo de Alimento</th>
                <th>Nome do Alimento</th>
                <th>Preço Por Lote</th>
                <th>Preço Cliente</th>
                <th>Quantidade</th>
                <th>Validade</th>
                <th>Cantina</th>
            </tr>

            <?php
            // Configurações de conexão com o banco de dados
            $servername = "45.152.44.154"; // substitua pelo nome do seu servidor MySQL
            $username = "u451416913_grupo05"; // substitua pelo nome de usuário do seu servidor MySQL
            $password = "Grupo05@123"; // substitua pela senha do seu servidor MySQL
            $dbname = "u451416913_grupo05"; // substitua pelo nome do banco de dados

            // Cria a conexão com o banco de dados
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verifica se a conexão foi estabelecida corretamente
            if ($conn->connect_error) {
                die("Erro na conexão com o banco de dados: " . $conn->connect_error);
            }

            // Consulta para recuperar os dados da tabela
            $sql = "SELECT idProd, tipoAlimento, nomeAlimento, preço_lote, preço_cliente, quantidade, validade, idCant FROM Produtos";
            $result = $conn->query($sql);

            // Exibir os dados na tabela
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["idProd"] . "</td>";
                    echo "<td>" . $row["tipoAlimento"] . "</td>";
                    echo "<td>" . $row["nomeAlimento"] . "</td>";
                    echo "<td>" . $row["preço_lote"] . "</td>";
                    echo "<td>" . $row["preço_cliente"] . "</td>";
                    echo "<td>" . $row["quantidade"] . "</td>";
                    echo "<td>" . $row["validade"] . "</td>";
                    echo "<td>" . $row["idCant"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nenhum registro encontrado.</td></tr>";
            }

            // Fecha a conexão com o banco de dados
            $conn->close();
            ?>
        </table>

    <script src="script1.js"></script>

</body>
</html>