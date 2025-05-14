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

// Redirecionar de volta para a página principal
header("Location: index.php");
?>
