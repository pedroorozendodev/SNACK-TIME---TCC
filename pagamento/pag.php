<!DOCTYPE html>
<html>
<head>
    <title>Pagamento com Cartão</title>
    <!-- Adicione o link para a biblioteca FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #3498db, #2c3e50);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .payment-container {
            width: 100%; /* Torna o contêiner responsivo */
            max-width: 400px; /* Define uma largura máxima para evitar que o conteúdo se estenda demais */
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .back-icon {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 20px;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <a href="reg.php" class="back-icon"><i class="fa fa-arrow-left"></i> Voltar</a>
        <h1>Pagamento com Cartão</h1>
        <form action="process_credit_card_payment.php" method="post">
            <label for="card_number">Número do Cartão:</label>
            <input type="text" name="card_number" id="card_number" placeholder="**** **** **** ****">
            
            <label for="card_holder">Nome no Cartão:</label>
            <input type="text" name="card_holder" id="card_holder" placeholder="Nome no Cartão">
            
            <label for="expiration_date">Data de Validade (MM/AA):</label>
            <input type="text" name="expiration_date" id="expiration_date" placeholder="MM/AA">
            
            <label for="cvv">CVV:</label>
            <input type="text" name="cvv" id="cvv" placeholder="CVV">
            
            <input type="submit" value="Pagar com Cartão">
        </form>
    </div>
</body>
</html>
