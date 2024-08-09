<?php
session_start();
require_once 'product.php';
$productManager = new ProductManager();
$products = $productManager->readProductsFromCSV("Database.csv");
$productNames = array();
$productSales = array();
foreach ($products as $product) {
    array_push($productNames, $product->name);
    array_push($productSales, rand(1, 10));
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style1.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <li><a href="#">Products</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Contact Us</a></li>
        <li><a href="cart.php">Cart</a></li>
      </ul>
    </nav>
  </div>
</header>

<div class="container">
    <div class="chart-container">
        <canvas id="productSalesChart"></canvas>
    </div>
    <div class="chart-container">
        <canvas id="productSalesChart2"></canvas>
    </div>
</div>

<script>
    var ctx = document.getElementById('productSalesChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'polarArea',
        data: {
            labels: <?php echo json_encode($productNames); ?>,
            datasets: [{
                label: 'Number of Sales',
                data: <?php echo json_encode($productSales); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                borderRadius: 10
            }]
        },
        options: {
            plugins: {
                centeredLabel: true,
                datalabels: {
                    color: '#fff',
                    font: {
                        weight: 'bold',
                        size: 16
                    },
                    formatter: function(value, context) {
                        return context.chart.data.labels[context.dataIndex] + ': ' + value;
                    }
                }
            }
        }
    });

    var ctx2 = document.getElementById('productSalesChart2').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($productNames); ?>,
            datasets: [{
                label: 'Product Sales',
                data: <?php echo json_encode($productSales); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                borderRadius: 10
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            plugins: {
                datalabels: {
                    color: '#fff',
                    font: {
                        weight: 'bold',
                        size: 16
                    }
                }
            }
        }
    });
</script>

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