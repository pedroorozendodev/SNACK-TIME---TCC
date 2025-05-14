<?php
// Inicia a sessão para acessar as variáveis de sessão
session_start();

// Variável para armazenar mensagens de erro
$errorMsg = '';

// Verifica se a requisição é do tipo POST e se o botão 'send2' foi pressionado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send2'])) {
    // Obtém os valores dos campos de email e senha do formulário
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $senha = isset($_POST['password']) ? $_POST['password'] : '';

    // Conecta ao servidor MySQL
    $con = mysqli_connect("45.152.44.154", "u451416913_grupo05", "Grupo05@123", "u451416913_grupo05");

    // Verifica a conexão com o banco de dados
    if (mysqli_connect_errno()) {
        echo "Falha na conexão com o banco de dados: " . mysqli_connect_error();
        exit();
    }

    // Consulta para verificar se o email e a senha estão corretos na tabela "Usuarios"
    $query = "SELECT * FROM Usuarios WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $dbSenha = $row['senha'];

        if ($senha == $dbSenha) {
            // Senha correta, armazenar informações do usuário na sessão
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_nome'] = $row['nome'];
            $_SESSION['user_email'] = $row['email'];
            // Adicione outros campos se necessário

            // Redireciona para a página principal
            header("Location: index.php");
            exit;
        } else {
            // Senha incorreta, define a mensagem de erro
            $errorMsg = "Senha incorreta.";
        }
    } else {
        // A conta não existe, define a mensagem de erro
        $errorMsg = "Conta não existente";
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($con);
}
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
    <style>
        .error-message {
            color: black;
            margin-bottom: 10px;
            display: none;
        }
    </style>
</head>
<body style="display:flex; align-items:center; justify-content:center;">
<div class="login-page">
  <div class="form">
    <form class="login-form" method="post">
      <!-- Título do formulário de login -->
      <h2><i class="fas fa-lock"></i> Login</h2>

      <!-- Exibe mensagem de erro (se houver) -->
      <div class="error-message" id="error-message"><?php echo $errorMsg; ?></div>

      <!-- Campos de entrada para email e senha -->
      <input type="text" name="email" placeholder="E-mail" required />
      <input type="password" name="password" placeholder="Senha" required/>

      <!-- Botão de envio do formulário -->
      <button type="submit" name="send2">entrar</button>

      <!-- Mensagem de redirecionamento para criar uma conta -->
      <p class="message">Não registrado? <a href="contausuario.php">Criar uma conta</a></p>
    </form>
  </div>
</div>

<!-- Scripts jQuery e personalizado -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/js/main.js"></script>
<script>
    // Exibe a mensagem de erro por 3 segundos usando jQuery
    $(document).ready(function(){
        var errorMessage = $("#error-message");
        if(errorMessage.text() !== ''){
            errorMessage.show();
            setTimeout(function(){
                errorMessage.hide();
            }, 3000);
        }
    });
</script>
</body>
</html>
