<?php
// Inicia a sessão para acessar as variáveis de sessão
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_email'])) {
    // Redireciona para a página de login se o usuário não estiver logado
    header("Location: index.php");
    exit;
}

// Conecta ao servidor MySQL
$con = mysqli_connect("45.152.44.154", "u451416913_grupo05", "Grupo05@123", "u451416913_grupo05");

// Verifica a conexão com o banco de dados
if (mysqli_connect_errno()) {
    // Exibe mensagem de erro se a conexão falhar
    echo "Falha na conexão com o banco de dados: " . mysqli_connect_error();
    exit();
}

// Recupera informações do usuário do banco de dados
$user_id = $_SESSION['user_id'];
$query = "SELECT id, nome, email, senha, uni_escolar FROM Usuarios WHERE id = '$user_id'";
$result = mysqli_query($con, $query);

// Verifica se a consulta foi bem-sucedida e se há resultados
if ($result && mysqli_num_rows($result) > 0) {
    // Obtém os dados do usuário
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];
    $nome = $row['nome'];
    $email = $row['email'];
    $senha = $row['senha'];
    $uni_escolar = $row['uni_escolar'];
} else {
    // Exibe mensagem de erro se a recuperação de informações falhar
    echo "Erro ao recuperar informações do usuário.";
}

// Fecha a conexão com o banco de dados
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="perfil.css">
    <style>
        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .show-password {
            cursor: pointer;
            margin-left: 10px;
        }

        .profile-container h2 {
            color: #007BFF; /* Define a cor azul para o texto */
            margin-left: 25%; /* Ajuste o valor conforme necessário */
        }
    </style>
</head>

<body>
    <div class="profile-container">
        <!-- Título do perfil do usuário -->
        <h2>Perfil do Usuário</h2>

        <!-- Exibição das informações do usuário -->
        <p>ID: <?php echo $id; ?></p>
        <p>Nome: <?php echo $nome; ?></p>
        <p>E-mail: <?php echo $email; ?></p>
        
        <!-- Exibição da senha com a opção de mostrar/ocultar -->
        <div class="password-wrapper">
            <p>Senha: <span id="senha"><?php echo str_repeat('*', strlen($senha)); ?></span>
                <span class="show-password" onclick="togglePassword()">
                    <i class="fas fa-eye"></i>
                </span>
            </p>
        </div>

        <!-- Exibição da unidade escolar -->
        <p>Unidade escolar: <?php echo $uni_escolar; ?></p>
    </div>

    <!-- Menu lateral (SIDEMENU) -->
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

    <!-- Script para mostrar/ocultar a senha -->
    <script>
        function togglePassword() {
            var senhaElement = document.getElementById("senha");

            if (senhaElement.innerHTML === '<?php echo str_repeat('*', strlen($senha)); ?>') {
                senhaElement.innerHTML = '<?php echo $senha; ?>';
            } else {
                senhaElement.innerHTML = '<?php echo str_repeat('*', strlen($senha)); ?>';
            }
        }
    </script>
</body>

</html>
