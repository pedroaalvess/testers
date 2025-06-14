<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rifa iPhone 16 Pro Max</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            color: #fff;
            text-align: center;
        }
        .container {
            margin: 50px auto;
            max-width: 500px;
            background-color: #111;
            padding: 30px;
            border-radius: 10px;
        }
        input, button {
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            border: none;
        }
        button {
            background-color: #00ff99;
            cursor: pointer;
        }
        button:hover {
            background-color: #00cc77;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Rifa iPhone 16 Pro Max</h1>
    <p>Valor da cota: <strong>R$ 0,20</strong></p>
    <label>Quantidade de Cotas:</label><br>
    <input type="number" id="quantidade" min="1" value="1"><br>
    <p>Total: <strong id="total">R$ 0,20</strong></p>

    <button onclick="gerarPix()">Gerar PIX</button>

    <div id="pixArea" style="display:none;">
        <h3>Faça o PIX:</h3>
        <img id="qrcode" src="" alt="QR Code PIX"><br>
        <p id="pixCode"></p>
    </div>
</div>

<script>
    const valorCota = 0.20;

    const quantidadeInput = document.getElementById('quantidade');
    const totalLabel = document.getElementById('total');

    quantidadeInput.addEventListener('input', () => {
        const quantidade = parseInt(quantidadeInput.value) || 1;
        const total = (quantidade * valorCota).toFixed(2);
        totalLabel.innerText = `R$ ${total}`;
    });

    function gerarPix() {
        const quantidade = parseInt(quantidadeInput.value) || 1;
        const total = (quantidade * valorCota).toFixed(2);

        fetch(`gerar_pix.php?valor=${total}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('qrcode').src = data.qr_code;
                document.getElementById('pixCode').innerText = data.copia_cola;
                document.getElementById('pixArea').style.display = 'block';
            });
    }
</script>

</body>
</html>
