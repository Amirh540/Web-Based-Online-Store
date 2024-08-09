<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style0.css">
</head>
<body>

<header>

  <div class="header-container">
    <div class="logo">Group13 Shop</div>
    <div class="search-bar">
      <input type="text" placeholder="Search...">
      <button>Search</button>
    </div>
    <nav>
      <ul>
        <li><a href="product_view.php">Home</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Contact Us</a></li>
        <li><a href="cart.php">Cart</a></li>
      </ul>
    </nav>
  </div>

</header>

<main>
    <h1>Shopping Cart</h1>

    <?php if (empty($_SESSION['cart'])) : ?>
    <p>Your cart is empty!</p>
    <?php else : ?> 
    <table>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    <?php
    $grandTotal = 0;
    foreach ($_SESSION['cart'] as $item) : 
        $price = floatval($item['price']);
        $quantity = intval($item['quantity']);
        $total = $price * $quantity;
        $grandTotal += $total;
    ?>
        <tr>
            <td>
                <img src="<?= $item['image_url'] ?>" alt="<?= $item['name'] ?>" width="100">
                <?= $item['name'] ?>
            </td>
            <td><?= $item['quantity'] ?></td>
            <td><?= $item['price'] ?></td>
            <td><?= $total ?></td>
            <td>
                <form action="delete_from_cart.php" method="post">
                    <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
        <tr>
            <td colspan="3">Grand Total</td>
            <td><?= $grandTotal ?></td>
            <td></td>
        </tr>
    </table><br><br>

    <p><a href="checkout.php">Checkout</a></p>
    <?php endif; ?>
</main>
<footer>
  <div class="footer">
    <p>© 2023 Group13 Shop</p>
    <ul>
      <li><a href="#">About Us</a></li>
      <li><a href="#">Contact Us</a></li>
      <li><a href="#">Privacy Policy</a></li>
      <li><a href="#">Terms of Use</a></li>
    </ul>
  </div>
</footer>
</body>
</html>