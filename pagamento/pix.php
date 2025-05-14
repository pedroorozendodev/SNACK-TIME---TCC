<!DOCTYPE html>
<html>
<head>
    <title>Pagamento PIX</title>
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
            max-width: 400px; /* Limita a largura máxima */
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            color: #1D3557;
        }

        img {
            max-width: 100%;
        }

        p {
            font-size: 18px;
            margin-top: 20px;
        }

        .copy-button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }

    </style>
</head>
<body>
    <div class="payment-container">
        <h1>Pagamento PIX</h1>
        <p>Copie o código PIX abaixo e cole no seu aplicativo bancário:</p>
        <b id="pix-code">539206718693AHTLMI20758910</b>
        <button class="copy-button" onclick="copyPixCode()">Copiar</button>
        <p>Tempo estimado para pagamento: 10 minutos</p>
        <p>Aguardando o pagamento!</p>
    </div>

    <script>
        function copyPixCode() {
            var pixCode = document.getElementById('pix-code');
            var range = document.createRange();
            range.selectNode(pixCode);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand('copy');
            window.getSelection().removeAllRanges();
        }
    </script>
</body>
</html>