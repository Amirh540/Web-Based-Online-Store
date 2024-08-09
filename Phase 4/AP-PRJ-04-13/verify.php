<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

session_start();

if (!isset($_SESSION['cart'])) {
    header('Location: product_view.php');
    exit();
}

$amount = 0;
foreach ($_SESSION['cart'] as $item) {
    $amount += $item['price'] * $item['quantity'];
}

$ref_id = uniqid(); 
$order_id = 'Pay_' . $ref_id;  
// Retrieve the required information from the form submission
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$phone = $_POST['phone'];


// Set up the request parameters
$api_key = "c74bc501-648a-436d-a5ad-867a70ebdc64"; // Replace with your NextPay.org API Key

// Make a request to NextPay.org API to initiate the payment
$url = "https://nextpay.org/nx/gateway/token"; // API endpoint
$data = array(
    'api_key' => $api_key,
    'amount' => $amount,
    'order_id' => $order_id,
    'callback_uri' => "http://localhost/phase%203/AP-PRJ-02-13/callback.php",
    'currency' => "IRT",
    'customer_phone' =>$phone,
    'payer_name'=> $name



   
);

$options = array(
    'http' => array(
        'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);

$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$result = json_decode($response, true);

// Redirect the user to NextPay.org for payment
if (isset($result['code']) && $result['code'] === -1 && isset($result['trans_id'])) {
    if ($result['code'] === -1) {
        $trans_id = $result['trans_id'];
        // Store $trans_id, $amount, and $order_id in your database for future reference
        $payment_url = "https://nextpay.org/nx/gateway/payment/" . $trans_id;
        header("Location: $payment_url");
        exit();
    } else {
        // Handle other error codes, if necessary
        echo "Payment initiation failed. Error code: " . $result['code'];
    }
} else {
    // Handle payment initiation error
    echo "Payment initiation failed.";
    var_dump($response);
}

?>
