<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';

use Stripe\Stripe;

$stripe_secret_key = "sk_test_51PL1wLRpW5uwDL2GQQdUK9rgMMUPUdd7YCM3gYnP6412QZIEqVyhcjEIT6xkSadIJJ04L8mkmOIUrJrr2DxbKq4l00qIdmnQNm"; // your Stripe secret key

Stripe::setApiKey($stripe_secret_key);

// Handle CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$request_body = file_get_contents('php://input');

if (empty($request_body)) {
    http_response_code(400);
    echo json_encode(["error" => "Empty request body"]);
    exit;
}

$data = json_decode($request_body, true);

if ($data === null) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid JSON data received"]);
    exit;
}

if (!array_key_exists('lineItems', $data)) {
    http_response_code(400);
    echo json_encode(["error" => "Missing 'lineItems' key in the JSON data"]);
    exit;
}

$cart_items = $data['lineItems'];

if (!is_array($cart_items)) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid data format for 'lineItems'"]);
    exit;
}

$line_items = [];
foreach ($cart_items as $item) {
    if (!isset($item['price']) || !isset($item['name']) || !isset($item['quantity'])) {
        http_response_code(400);
        echo json_encode(["error" => "Missing required keys in 'lineItems'"]);
        exit;
    }

    $line_items[] = [
        'price_data' => [
            'currency' => 'usd',
            'unit_amount' => $item['price'] * 100,
            'product_data' => [
                'name' => $item['name']
            ]
        ],
        'quantity' => $item['quantity'],
    ];
}

if (empty($line_items)) {
    http_response_code(400);
    echo json_encode(["error" => "No line items provided"]);
    exit;
}

try {
    $checkout_session = \Stripe\Checkout\Session::create([
        'mode' => 'payment',
        'success_url' => 'http://localhost/Maleda_final/Maleda_Ecommerce_Website/stripe/success.php',
        
        'locale' => 'auto',
        'line_items' => $line_items
    ]);

    echo json_encode(["url" => $checkout_session->url]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>
