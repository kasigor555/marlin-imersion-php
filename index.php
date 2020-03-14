<?php

require_once 'app/controllers/Database.php';
require_once 'app/controllers/Config.php';

// $products = Database::getInstace()->query("SELECT * FROM products WHERE id IN (?, ?)", ['1', '2']);
$products = Database::getInstace()->get('products', ['id', '>=', "1"]);
// $products = Database::getInstace()->delete('products', ['id', '=', "5"]);
// Database::getInstace()->insert('products', [
//                                             'product_name' => 'Test Product - 2',
//                                             'product_desc' => 'Test Desc - 2',
//                                             'product_text' => 'Test Text Test Text Test Text ',
//                                             'product_img' => 'noimage.png',
//                                             'category_id' => '1',
//                                             'product_status' => '1'
//                                             ]);

// $id = 7;
// Database::getInstace()->update('products', $id, [
//                                             'product_name' => 'Test Product - UPDATE',
//                                             'product_desc' => 'Test Desc - UPDATE',
//                                             'product_text' => 'Test UPDATE Text UPDATE Test UPDATE Text UPDATE Test UPDATE Text UPDATE ',
//                                             'product_img' => 'noimage.png',
//                                             'category_id' => '1',
//                                             'product_status' => '1'
//                                             ]);

// echo $products->getFirst()->product_name;

if ($products->getError()) {
  echo "We have an error <br>";
} else {
  foreach ($products->getResult() as $product) {
    echo $product->product_name . '<br>';
  }
}

