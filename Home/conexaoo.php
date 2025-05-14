<?php
session_start();

// Conectar ao servidor MySQL
// $con = mysqli_connect("localhost","root", "","lanches");
// Criando sessão
$con=mysqli_connect("localhost","u451416913_grupo05","Grupo05@123","u451416913_grupo05");
// Verificar a conexão
if (mysqli_connect_errno()) {
    echo "Falha na conexão com o banco de dados: " . mysqli_connect_error();
    exit();
}
?>
