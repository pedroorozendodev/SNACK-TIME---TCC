<?php
// Informações de conexão com o banco de dados
$servername = "45.152.44.154";
$username = "u451416913_grupo05";
$password = "Grupo05@123";
$dbname = "u451416913_grupo05";

// Cria uma nova conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die('Erro de Conexão (' . $conn->connect_errno . ') ' . $conn->connect_error);
}

// Recupera as credenciais do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

// Consulta SQL para verificar as credenciais
$sql = "SELECT * FROM Usuarios WHERE Nome = ? AND Email = ? AND Senha = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("sss", $nome, $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        // Login bem-sucedido, as credenciais coincidem.
        // Redirecione para a página "inicio.php".
        header("Location: index.php");
        exit; // Certifique-se de encerrar o script após o redirecionamento.
    } else {
        echo "Credenciais incorretas. Tente novamente.";
    }
    $stmt->close();
} else {
    echo "Erro na preparação da consulta: " . $conn->error;
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
