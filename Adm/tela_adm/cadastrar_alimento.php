<?php
// Conexão com o banco de dados
$servername = "45.152.44.154";
$username = "u451416913_grupo05";
$password = "Grupo05@123";
$dbname = "u451416913_grupo05";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Processa o envio do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se foram enviados os campos necessários
    if (
        isset($_POST["idCant"]) &&
        isset($_FILES["imagem"]) &&
        isset($_POST["tipoAlimento"]) &&
        isset($_POST["nomeAlimento"]) &&
        isset($_POST["preço_lote"]) &&
        isset($_POST["preço_cliente"]) &&
        isset($_POST["quantidade"]) &&
        isset($_POST["validade"])
    ) {
        // Recupera os valores dos campos
        $idCant = $_POST["idCant"];
        $tipoAlimento = $_POST["tipoAlimento"];
        $nomeAlimento = $_POST["nomeAlimento"];
        $preço_lote = floatval(preg_replace("/[^-0-9\.]/","",$_POST["preço_lote"]));
        $preço_cliente = floatval(preg_replace("/[^-0-9\.]/","",$_POST["preço_cliente"]));
        $quantidade = $_POST["quantidade"];
        $validade = $_POST["validade"];

        // Recupera o conteúdo da imagem
        $imagem = $_FILES["imagem"]["tmp_name"];
        $imgContent = addslashes(file_get_contents($imagem));

        // Insere os dados no banco de dados
        $sql = "INSERT INTO Produtos (idCant, imagem, tipoAlimento, nomeAlimento, preço_lote, preço_cliente, quantidade, validade)
        VALUES ('$idCant', '$imgContent', '$tipoAlimento', '$nomeAlimento', '$preço_lote', '$preço_cliente', '$quantidade', '$validade')";

if ($conn->query($sql) === TRUE) {
    // Redireciona o usuário para food.php
    header("Location: food.php");
    exit();
} else {
    echo "Erro ao enviar os dados e a imagem: " . $conn->error;
}
    } else {
        echo "Por favor, preencha todos os campos necessários.";
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>