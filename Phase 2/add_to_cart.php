<?php
require_once 'product.php';
session_start();

if (isset($_POST['product_id'], $_POST['quantity'])) {
    
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Create a ProductManager instance
    $productManager = new ProductManager();

    // Get product info from database
    $product = $productManager->getProductById($product_id); 
    
    // Check if the product is in stock
    if ($product->quantity< $quantity) {
        $_SESSION['error'] = 'Sorry, this product is out of stock!';
        header('Location: product_view.php');
        exit();
    }
    
    // Check if the product is already in the cart
    $itemExists = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $product_id) {
            $item['quantity'] += $quantity;
            $itemExists = true;
            break;
        }
    }

    // If the product is not in the cart, add it
    if (!$itemExists) {
        $_SESSION['cart'][] = [
            'product_id' => $product_id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $quantity,
            'image_url' => $product->image
        ];
    }
    
}

header('Location: product_view.php');
exit();
?>