<?session_start()?>
<!DOCTYPE html>
<html>
  <head>
    <title>Product List</title>
    <link rel="stylesheet" type="text/css" href="style1.css" />
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
        <li><a href="#">Home</a></li>
        <li><a href="#">Products</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Contact Us</a></li>
        <li><a href="cart.php">Cart</a></li>
      </ul>
    </nav>
  </div>
</header>

    <div class="container">
        <?php
        require_once 'product.php';
        $productManager = new ProductManager();
        $products = $productManager->readProductsFromCSV("Database.csv");

        foreach ($products as $product) {
            echo '<div class="product">';
            echo '<div class="product-image">';
            echo '<img src="' . $product->image . '">';
            echo '</div>';
            echo '<div class="product-details">';
            echo '<div class="product-name">' . $product->name . '</div>';
            echo '<div class="product-description">' . $product->description . '</div>';
            echo '<div class="product-price">$' . $product->price . '</div>';
            echo '<div class="product-quantity">In Stock: ' . $product->quantity . '</div>';
            echo '<div class="product-category">' . $product->category . '</div>';
            echo '<div class="product-company">' . $product->company . '</div>';
            echo '<div class="product-model">' . $product->model . '</div>';
            echo '<form action="add_to_cart.php" method="post">';
            echo '<input type="hidden" name="product_id" value="' . $product->id . '">';

            echo  '<input type="number" name="quantity" value="1" min="1">';
            echo  '<input type="submit" value="Add to cart">';
            echo ' </form>';
          
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
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