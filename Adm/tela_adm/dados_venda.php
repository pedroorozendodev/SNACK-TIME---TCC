<?php
// Conecte-se ao banco de dados (substitua com suas informações de conexão)
$servername = "45.152.44.154";
$username = "u451416913_grupo05";
$password = "Grupo05@123";
$dbname = "u451416913_grupo05";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifique a conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta SQL para obter as vendas por mês
$sql = "SELECT MONTH(data_venda) AS mes, SUM(quantidade) AS total_vendas FROM Vendas GROUP BY mes";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mes = $row["mes"];
        $totalVendas = $row["total_vendas"];
        $data[] = array("mes" => $mes, "totalVendas" => $totalVendas);
    }
}

// Feche a conexão com o banco de dados
$conn->close();

// Converte o array em JSON e imprime
header('Content-Type: application/json');
echo json_encode($data);
?>
