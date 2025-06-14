<?php
$valor = $_GET['valor'];

// Seu Secret Key da API PIX
$secret_key = "SEU_SECRET_KEY_AQUI";

// Dados para a requisição
$payload = json_encode([
    "valor" => floatval($valor),
    "descricao" => "Pagamento da Rifa iPhone",
    "cpf" => "00000000000", // opcional
    "nome" => "Cliente Rifa"
]);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://srv.darkpagamentos.com/v1/balanced');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'x-secret-key: avivhub_qkaHqudtfzglXTHOnWdfdAiLfnPDiXol4iViv45HpViWCoR'
]);

$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

// Enviar dados para o front
echo json_encode([
    "qr_code" => $result['qrcode']['base64'], // se a API retorna imagem
    "copia_cola" => $result['qrcode']['emv'] // código copia e cola
]);
?>
