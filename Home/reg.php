<?php
// Inicia a sessão para acessar as variáveis de sessão
session_start();

// Variável para armazenar mensagens de erro
$errorMsg = '';

// Conecta ao servidor MySQL
$con = mysqli_connect("45.152.44.154", "u451416913_grupo05", "Grupo05@123", "u451416913_grupo05");

// Verifica a conexão com o banco de dados
if (!$con) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

// Verifica se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o botão 'sub' foi pressionado
    if (isset($_POST['sub'])) {
        // Obtém os valores dos campos do formulário
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $senha = isset($_POST['senha']) ? $_POST['senha'] : '';

        // Verifica se o email já está em uso
        $checkEmailQuery = "SELECT * FROM Cantinas WHERE email = '$email'";
        $checkEmailResult = mysqli_query($con, $checkEmailQuery);

        if ($checkEmailResult && mysqli_num_rows($checkEmailResult) > 0) {
            $errorMsg = "O email já está em uso. <a href='contausuario.php'>Coloque uma conta não cadastrada</a>";
        } else {
            // Insere uma nova cantina no banco de dados
            $insertQuery = "INSERT INTO Cantinas (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
            $insertResult = mysqli_query($con, $insertQuery);

            if ($insertResult) {
                // Conta criada com sucesso, redireciona para a página de login ou para onde desejar
                header("Location: login.php");
                exit;
            } else {
                $errorMsg = "Erro ao criar a conta.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="LoginStylee.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .header {
            background-color: #f2f2f200;
            padding: 10px;
            text-align: center;
            position: relative;
        }

        .snacktime {
            font-size: 70px;
            font-weight: 700;
            color: rgb(255, 255, 255);
            position: absolute;
            top: -1500%;
            left: 1150%;
            transform: translate(-50%, -50%);
        }

        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
        }

        .wrapper {
            margin-top: 40px;
        }

        /* Adicionando estilo para o link "Voltar ao login" */
        a {
            display: inline-block;
            text-align: center;
            margin-top: 10px; /* Ajuste a margem conforme necessário */
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1 class="snacktime">SNACKTIME</h1>
    </div>

    <div class="wrapper">
        <form action="#" method="POST">
            <h2>Crie sua conta</h2>
            <div class="input-box">
                <input type="text" id="nome" name="nome"  placeholder="Digite seu nome" required>
                <i class='bx bxs-envelope'></i>
            </div>

            <div class="input-box">
                <input type="email" id="email" name="email" placeholder="Digite seu email" required>
                <i class='bx bxs-envelope'></i>
            </div>

            <div class="input-box">
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                <i class='bx bxs-lock'></i>
            </div>

            <button type="submit" class="btn" name="sub">Criar</button>
            
            <div class="register-link">
                <p><a href="login.php">Voltar login</a></p>
            </div>
        </form>
    </div>
</body>
</html>