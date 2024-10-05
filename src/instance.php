<?php
// URL del servicio de metadatos de EC2 para obtener el token y el ID de la instancia
$token_url = "http://169.254.169.254/latest/api/token";
$instance_id_url = "http://169.254.169.254/latest/meta-data/instance-id";

// Paso 1: Obtener el token de IMDSv2
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $token_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "X-aws-ec2-metadata-token-ttl-seconds: 21600"
));
$token = curl_exec($ch);

if (curl_errno($ch)) {
    // Devolver el error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(["error" => "Error al obtener el token: " . curl_error($ch)]);
    curl_close($ch);
    exit;
}

curl_close($ch);

// Paso 2: Usar el token para obtener el ID de la instancia
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $instance_id_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "X-aws-ec2-metadata-token: $token"
));
$instance_id = curl_exec($ch);

if (curl_errno($ch)) {
    // Devolver el error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(["error" => "Error al obtener el ID de la instancia: " . curl_error($ch)]);
} else {
    // Devolver el ID de la instancia en formato JSON
    header('Content-Type: application/json');
    echo json_encode(["instance_id" => $instance_id]);
}

curl_close($ch);
?>