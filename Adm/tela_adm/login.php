<?php
session_start();

if (isset($_POST['email'])) { // Verifica se o botão foi pressionado

    $email = $_POST['email'];
    $senha = $_POST['password'];

    // Conectar ao servidor MySQL
    $con = mysqli_connect("localhost", "u451416913_grupo05", "Grupo05@123", "u451416913_grupo05");

    // Verificar a conexão
    if (mysqli_connect_errno()) {
        echo "Falha na conexão com o banco de dados: " . mysqli_connect_error();
        exit();
    }

    // Consulta para verificar se o email e a senha estão corretos
    $query = "SELECT * FROM Cantinas WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $dbSenha = $row['senha'];

        if ($senha == $dbSenha) {
            // Senha correta, armazene o email na sessão e redirecione para a página principal
            $_SESSION['email'] = $email;
            header("Location: http://projetomed.com.br/TECTI/grupo05/Adm/tela_adm/estoque.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt--br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="LoginStyle.css">
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

        .wrapper {
            margin-top: 40px;
        }

        .error-message {
            visibility: hidden;
            color: red;
            margin-bottom: 10px;
            position: absolute;
            top: -30px;
            left: 0;
            transition: visibility 0s linear 5s;
        }

        .input-box {
            position: relative;
        }

        .input-box.error .error-message {
            visibility: visible;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: linear-gradient(#1D3557, #457B9D); /* Substitua as cores pelo seu degradê desejado */
        }
    </style>
</head>

<body>
    <div class="header">
        <h1 class="snacktime">SNACKTIME</h1>
    </div>

    <div class="wrapper">
        <form action="login.php" method="POST" onsubmit="return validateForm()">
            <h2>Login</h2>
            <div class="input-box">
                <input type="email" name="email" placeholder="Digite seu email" required>
                <i class='bx bxs-envelope'></i>
                <div class="error-message">Preencha o campo de email!</div>
            </div>

            <div class="input-box">
                <input type="password" name="password" placeholder="Digite sua senha" required>
                <i class='bx bxs-lock'></i>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox" name="remember">
                    Lembre de mim</label>
                <a href="#">Esqueceu sua senha?</a>
            </div>

            <button type="submit" class="btn" name="sub">Login</button>

            <div class="register-link">
                <p>Não tem uma conta? <a href="reg.php">Registre-se</a></p>
            </div>
        </form>
    </div>
</body>
</html>