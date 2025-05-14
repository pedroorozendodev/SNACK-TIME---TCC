<!DOCTYPE html> 
<html lang="pt-br"> 
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro De Alimentos</title>
    <link rel="shortcut icon" href="food.ico" type="image/x-icon">
    <link rel="stylesheet" href="foods.css">
    <link rel="stylesheet" href="sidemenu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js"></script>
    
  </head>
    <body>  
    <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="principal.php">Dashboard</a>
            <a href="food.php">Cadastro de alimentos</a>
            <a href="estoque.php">Produtos em Estoque</a>
            <a href="Zerado.php">Produtos Zerados</a>
            <a href="pedidos.php">Pedidos</a>
        </div>
        <div id="main">
            <span class="openbtn" onclick="openNav()">&#9776;</span>
            <div id="cart-icon" onclick="openCartPage()">
            </div>
            
            
    <h2>Cadastro de produtos</h2>
    <form method="POST" action="cadastrar_alimento.php" enctype="multipart/form-data">
        <label for="tipoAlimento">
            <span class="label-text">Tipo de Produto:</span>
            <input type="text" id="tipoAlimento" name="tipoAlimento" placeholder="Digite o tipo de Produto" />
        </label>
        <br>

        <label for="nomeAlimento">
            <span class="label-text">Nome do Produto:</span>
            <input type="text" id="nomeAlimento" name="nomeAlimento" placeholder="Digite o nome do Produto" />
        </label>
        <br>

        <label for="preço_lote">
            <span class="label-text">Preço do Lote:</span>
            <input type="text" id="preço_lote" name="preço_lote" placeholder="R$" oninput="formatarPreco(this)" />
        </label>
        <br>

        <script>
            function formatarPreco(input) {
                // Remove caracteres não numéricos do valor
                let preco = input.value.replace(/\D/g, '');

                // Divide o valor por 100 para converter de centavos para reais
                preco = (parseFloat(preco) / 100).toFixed(2);

                // Formata o valor com casas decimais pulando à medida que digita
                preco = preco.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

                // Atualiza o valor no campo de entrada
                input.value = "R$ " + preco;
            }
        </script>

        <label for="preço_cliente">
            <span class="label-text">Preço Cliente:</span>
            <input type="text" id="preço_cliente" name="preço_cliente" placeholder="R$" oninput="formatar(this)" />
        </label>
        <br>

        <script>
            function formatar(input) {
                // Remove caracteres não numéricos do valor
                let preco = input.value.replace(/\D/g, '');

                // Divide o valor por 100 para converter de centavos para reais
                preco = (parseFloat(preco) / 100).toFixed(2);

                // Formata o valor com casas decimais pulando à medida que digita
                preco = preco.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

                // Atualiza o valor no campo de entrada
                input.value = "R$ " + preco;
            }
        </script>

        <!-- Adicione o campo de quantidade -->
        <label for="quantidade">
            <span class="label-text">Quantidade:</span>
            <input type="number" id="quantidade" name="quantidade" required>
        </label>
        <br>

        <!-- Adicione o campo de validade -->
        <label for="validade">
            <span class="label-text">Validade do Lote:</span>
            <input type="date" id="validade" name="validade" required>
        </label>
        <br>

        <!-- Adicione o campo de imagem -->
        <label for="imagem">
            <span class="label-text">Selecione uma imagem:</span>
            <input type="file" name="imagem" id="imagem" accept="image/*" required>
        </label>
        <br>

        <!-- Adicione o campo de ID da Cantina -->
        <label for="idCant">
            <span class="label-text">ID da Cantina:</span>
            <input type="text" id="idCant" name="idCant" placeholder="Digite o ID da cantina" />
        </label>
        <br>

        <button type="submit">Cadastrar</button>
    </form>



</form> 

<script src="script1.js"></script>

</body> 
</html>