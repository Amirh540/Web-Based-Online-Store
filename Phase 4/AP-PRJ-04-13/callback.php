<!DOCTYPE html>
<html>
<head>
    <title>Transaction Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        .success {
            color: #008000;
        }

        .error {
            color: #FF0000;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Transaction Verification</h1>

    <?php
    // Retrieve the response parameters from the payment gateway
    $trans_id = $_GET['trans_id'];
    $order_id = $_GET['order_id'];
    $amount = $_GET['amount'];

    // Set up the request parameters for transaction verification
    $api_key = "c74bc501-648a-436d-a5ad-867a70ebdc64"; // Replace with your NextPay.org API Key
    $url = "https://nextpay.org/nx/gateway/verify"; // API endpoint
    $data = array(
        'api_key' => $api_key,
        'trans_id' => $trans_id,
        'amount' => $amount,
        'currency' => "IRT"
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

    // Process the verification response
    if (isset($result['code']) && $result['code'] === 0) {
        // Transaction verification successful
       
        echo "<p class='success'>Transaction verification successful. Thank you for your purchase!</p>";

        // Display the response parameters in a table
        echo "<h2>Transaction Details:</h2>";
        echo "<table>";
        echo "<tr><th>Parameter</th><th>Title</th><th>Payment Data</th></tr>";
        
        echo "<tr><td>amount</td><td>Amount (tomans)</td><td>" . $result['amount'] . "</td></tr>";
        echo "<tr><td>order_id</td><td>Order number</td><td>" . $result['order_id'] . "</td></tr>";
        echo "<tr><td>card_holder</td><td>Payment card</td><td>" . $result['card_holder'] . "</td></tr>";
        echo "<tr><td>customer_phone</td><td>Mobile payer</td><td>" . $result['customer_phone'] . "</td></tr>";
        echo "<tr><td>Shaparak_Ref_Id</td><td>Shaparak tracking code</td><td>" . $result['Shaparak_Ref_Id'] . "</td></tr>";
       
        echo "<tr><td>created_at</td><td>Solar date and time of transaction</td><td>" . $result['created_at'] . "</td></tr>";
        echo "</table>";
    } else {
        // Transaction verification failed
        // Handle the failed verification
        echo "<p class='error'>Transaction  failed. Please contact customer support.</p>";
    }
    ?>
    
    <p><a href="product_view.php">Home</a></p>
</body>
</html>
