<?php
class Product {
  // Public attributes
  public $id;
  public $name;
  public $description;
  public $price;
  public $quantity;
  public $category;
  public $companyName;
  public $deviceModel;
  public $imageUrl;
  
  // Private attributes
  private $discount;

  // Constructor function
  public function __construct($id, $name, $description, $price, $quantity, $category, $companyName, $deviceModel, $imageUrl) {
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
    $this->price = $price;
    $this->quantity = $quantity;
    $this->category = $category;
    $this->companyName = $companyName;
    $this->deviceModel = $deviceModel;
    $this->imageUrl = $imageUrl;
    $this->discount = 0;
  }

  // Public operations
  public function setDiscount($discount) {
    $this->discount = $discount;
  }

  public function getPriceAfterDiscount() {
    return $this->price * (1 - $this->discount);
  }

  public function getQuantityInStock() {
    return $this->quantity;
  }

  public function isAvailable() {
    return $this->quantity > 0;
  }

  public function addToCart($quantity) {
    if ($quantity > 0 && $quantity <= $this->quantity) {
      $this->quantity -= $quantity;
    }
  }

  // Private operations
  private function getDiscount() {
    return $this->discount;
  }

  private function setQuantityInStock($quantity) {
    $this->quantity = $quantity;
  }
}



class ProductManager {
  private $products;

  public function __construct() {
    $this->products = array();
  }

  public function add($product) {
    array_push($this->products, $product);
  }

  public function delete($id) {
    foreach ($this->products as $index => $product) {
      if ($product->id == $id) {
        unset($this->products[$index]);
        break;
      }
    }}
    public function getProductById($product_id) {
      $file = fopen('Database.csv', 'r');
      while (($row = fgetcsv($file)) !== false) {
          if ($row[0] == $product_id) {
              $product = new Product($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);
              return $product;
          }
      }
      fclose($file);
      return null;
  }

  public function getProducts() {
    return $this->products;
  }
  public  function readProductsFromCSV($filename) {
    $products = array();
    $file = fopen($filename, "r");
    // Skip the first row (column headers)
    fgetcsv($file);
    while (($data = fgetcsv($file)) !== FALSE) {
        $product = new stdClass();
        $product->id = $data[0];
        $product->name = $data[1];
        $product->description = $data[2];
        $product->price = $data[3];
        $product->quantity = $data[4];
        $product->category = $data[5];
        $product->company = $data[6];
        $product->model = $data[7];
        $product->image = $data[8];

        $products[] = $product;
    }
    fclose($file);
    return $products;
}


  }

  














