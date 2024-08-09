<?php session_start()?>
<!DOCTYPE html>
<html>
  <head>
    <title>Product List</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
<body>
<header>
  <div class="header-container">
    <div class="logo">Group13 Shop</div>
    <div class="search-bar">
      <form action="product_view.php" method="get">
      <input type="text" name="search" placeholder="Search...">
      <button type="submit">Search</button>
      <input type="hidden" name="min-price" value="<?php echo isset($_GET['min-price']) ? $_GET['min-price'] : 0 ?>">
      <input type="hidden" name="max-price" value="<?php echo isset($_GET['max-price']) ? $_GET['max-price'] : 1000 ?>">
      </form>
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
<header>
  <div class="price-range">
      <h4>Price Range</h4>
      <form action="product_view.php" method="get">
      <label for="min-price">Min price:</label>
      <input type="number" name="min-price" id="min-price" value="<?php echo isset($_GET['min-price']) ? $_GET['min-price'] : 0 ?>" min="0">
      <label for="max-price">Max price:</label>
      <input type="number" name="max-price" id="max-price" value="<?php echo isset($_GET['max-price']) ? $_GET['max-price'] : 1000 ?>" max="1000">
      <input type="hidden" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
      <button type="submit">Adjust</button>
      </form>
    </div>
</header>
<header>
  <div class="sort-bar">
    <h4>Price Sort</h4>
      <form action="product_view.php" method="get">
        <input type="hidden" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
        <input type="hidden" name="min-price" value="<?php echo isset($_GET['min-price']) ? $_GET['min-price'] : 0 ?>">
        <input type="hidden" name="max-price" value="<?php echo isset($_GET['max-price']) ? $_GET['max-price'] : 1000 ?>">
        <button type="submit" name="sort" value="price-desc">Sort by Price (High to Low)</button>
        <button type="submit" name="sort" value="price-asc">Sort by Price (Low to High)</button>
      </form>
    </div>
</header>
<div class="container">
    <?php
    // (chat GPT)
    require_once 'product.php';
    $productManager = new ProductManager();
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $min_price = isset($_GET['min-price']) ? $_GET['min-price'] : 0;
    $max_price = isset($_GET['max-price']) ? $_GET['max-price'] : 1000;
    if (!empty($search) || ($min_price !== 0 || $max_price !== 1000)) {
      $products = $productManager->searchProducts($search, $min_price, $max_price,'price-asc');
    } else {
      $products = $productManager->readProductsFromCSV("Database.csv");
    }
    if(isset($_GET['sort'])) {
      $sort = $_GET['sort'];
      if($sort == 'price-desc') {
        usort($products, function($a, $b) {
          return $b->getPriceAfterDiscount() - $a->getPriceAfterDiscount();
        });
      } else if($sort == 'price-asc') {
        usort($products, function($a, $b) {
          return $a->getPriceAfterDiscount() - $b->getPriceAfterDiscount();
        });
      }
    }
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