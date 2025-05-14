<!DOCTYPE html>
<html>
<head>
    <title>Página de Pagamento</title>
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
            width: 100%; /* Largura total para torná-lo responsivo */
            max-width: 400px; /* Limita a largura máxima para evitar que fique muito largo */
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

        select {
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
    </style>
</head>
<body>
    <div class="payment-container">
        <h1>Escolha o método de pagamento</h1>
        <form id="payment-form">
            <label for="payment_method">Método de pagamento:</label>
            <select name="payment_method" id="payment_method">
                <option value="credit">Cartão de Crédito</option>
                <option value="debit">Cartão de Débito</option>
                <option value="pix">PIX</option>
            </select>
            <input type="submit" value="Continuar">
        </form>
    </div>

    <script>
        document.getElementById("payment-form").addEventListener("submit", function(event) {
            event.preventDefault();

            var paymentMethod = document.getElementById("payment_method").value;

            if (paymentMethod === "credit" || paymentMethod === "debit") {
                window.location.href = "pag.php";
            } else if (paymentMethod === "pix") {
                window.location.href = "pix.php";
            }
        });
    </script>
</body>
</html>
