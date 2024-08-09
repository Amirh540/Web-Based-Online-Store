<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="style0.css">
</head>
<body>

<header>
  <div class="header-container">
    <div class="logo">Group13 Shop</div>
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
    <h1>Checkout</h1>
    <form action="verify.php" method="post">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br><br>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" required><br><br><br>

        <button type="submit">Pay Now</button>
    </form>
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