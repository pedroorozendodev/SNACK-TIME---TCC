<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico de Vendas Mensais</title>
    <!-- Inclua a biblioteca Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="sidemenu.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9; /* Cor de fundo do corpo */
        }   
        #myChart {
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
            background: linear-gradient(180deg, rgba(75, 192, 192, 0.2), rgba(255, 255, 255, 0)); /* Gradiente de fundo */
            border-radius: 10px; /* Cantos arredondados do gráfico */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra do gráfico */
        }
        #chart-container {
            text-align: center;
        }
        h1 {
            font-size: 32px;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1); /* Sombra do texto */
        }
    </style>
</head>
<body>
    <!-- Código do sidemenu -->
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

        <div id="chart-container">
            <h1>Gráfico de Vendas Mensais</h1>
            <canvas id="myChart"></canvas>
        </div>

        <script>
            // Obtém a referência do elemento canvas
            const ctx = document.getElementById('myChart').getContext('2d');

            // Função para buscar os dados do PHP e criar o gráfico
            async function buscarDadosEPlotarGrafico() {
                try {
                    const response = await fetch('dados_venda.php');
                    const data = await response.json();

                    // Extrai os dados do JSON
                    const meses = data.map(item => {
                        const mes = item.mes;
                        switch (mes) {
                            case 1:
                                return 'Janeiro';
                            case 2:
                                return 'Fevereiro';
                            case 3:
                                return 'Março';
                            case 4:
                                return 'Abril';
                            case 5:
                                return 'Maio';
                            case 6:
                                return 'Junho';
                            default:
                                return '';
                        }
                    });
                    const vendas = data.map(item => item.totalVendas);

                    // Cria o gráfico de linhas com os dados
                    const myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: meses,
                            datasets: [{
                                label: 'Vendas Mensais',
                                data: vendas,
                                borderColor: 'rgba(75, 192, 192, 1)', // Cor da linha
                                borderWidth: 3,
                                pointBackgroundColor: 'rgba(75, 192, 192, 1)', // Cor dos pontos
                                pointRadius: 6,
                                pointBorderWidth: 2, // Largura da borda dos pontos
                                pointBorderColor: 'rgba(255, 255, 255, 1)', // Cor da borda dos pontos
                                backgroundColor: 'rgba(75, 192, 192, 0.3)', // Área abaixo da linha
                                fill: {
                                    target: 'origin', // Preencher da linha para cima
                                    above: 'rgba(75, 192, 192, 0.2)' // Cor do preenchimento gradiente
                                    
                                }
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Vendas Mensais', // Título do gráfico
                                    font: {
                                        size: 24 // Tamanho do título
                                    },
                                    color: '#333' // Cor do título
                                }
                            },
                            elements: {
                                line: {
                                    tension: 0.4 // Curva de tensão da linha (suavidade)
                                }
                            }
                        }
                    });
                } catch (error) {
                    console.error('Erro ao buscar dados:', error);
                }
            }

            // Chama a função para buscar os dados e criar o gráfico
            buscarDadosEPlotarGrafico();
        </script>
          <script src="script1.js"></script>
    </div>
</body>
</html>
