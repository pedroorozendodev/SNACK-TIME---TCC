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
    // Verifica se o botão 'send2' foi pressionado
    if (isset($_POST['send2'])) {
        // Obtém os valores dos campos do formulário
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $senha = isset($_POST['password']) ? $_POST['password'] : '';
        $uni_escolar = isset($_POST['uni_escolar']) ? $_POST['uni_escolar'] : '';

        // Verifica se o email já está em uso
        $checkEmailQuery = "SELECT * FROM Usuarios WHERE email = '$email'";
        $checkEmailResult = mysqli_query($con, $checkEmailQuery);

        if ($checkEmailResult && mysqli_num_rows($checkEmailResult) > 0) {
            $errorMsg = "O email já está em uso. <a href='contausuario.php'>Coloque uma conta não cadastrada</a>";
        } else {
            // Insere um novo usuário no banco de dados
            $insertQuery = "INSERT INTO Usuarios (nome, email, senha, uni_escolar) VALUES ('$nome', '$email', '$senha', '$uni_escolar')";
            $insertResult = mysqli_query($con, $insertQuery);

            if ($insertResult) {
                // Conta criada com sucesso, redireciona para a página de login ou para onde desejar
                header("Location: loginusuario.php");
                exit;
            } else {
                $errorMsg = "Erro ao criar a conta.";
            }
        }
    }
}

// Fecha a conexão com o banco de dados
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webleb</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="Usuario.css">
</head>
<style>
    .error-message {
        color: black;
        margin-bottom: 10px;
    }
</style>
</head>
<body style="display:flex; align-items:center; justify-content:center;">
    <div class="login-page">
        <div class="form">
            <form class="login-form" method="post">
                <!-- Título do formulário de criação de conta -->
                <h2><i class=""></i> Criar conta</h2>

                <!-- Exibe mensagem de erro (se houver) -->
                <?php if ($errorMsg) : ?>
                    <div class="error-message" id="error-message"><?php echo $errorMsg; ?></div>
                    <script>
                        // Oculta a mensagem de erro após 3 segundos usando JavaScript
                        setTimeout(function () {
                            var errorMessage = document.getElementById('error-message');
                            errorMessage.style.display = 'none';
                        }, 3000);
                    </script>
                <?php endif; ?>

                <!-- Campos de entrada para nome, email, senha e unidade escolar -->
                <input type="text" name="nome" placeholder="Nome Completo" required />
                <input type="text" name="email" placeholder="E-mail" required />
                <input type="password" name="password" placeholder="Senha" required/>
                <div class="form-group-unidade mt-2">
                    <input class="form-style-unidade" placeholder="Unidade escolar" name="uni_escolar">
                    <i class="input-icon uil uil-lock-alt input-icon-unidade"></i>
                </div>

                <!-- Botão de envio do formulário -->
                <button type="submit" name="send2">Cadastrar</button>

                <!-- Mensagem de redirecionamento para a página de login -->
                <p class="message">Se já possui uma conta entre aqui <a href="loginusuario.php">Login</a></p>
            </form>
        </div>
    </div>
</body>
</html>
