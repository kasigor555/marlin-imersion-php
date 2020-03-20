<?php
session_start();

require_once 'app/controllers/Database.php';
require_once 'app/controllers/Config.php';
require_once 'config/db-connect.php';
require_once 'app/controllers/Input.php';
require_once 'app/controllers/Validate.php';
require_once 'app/controllers/Session.php';
require_once 'app/controllers/Token.php';
require_once 'app/controllers/User.php';
require_once 'app/controllers/Redirect.php';
require_once 'app/controllers/Cookie.php';


// $products = Database::getInstace()->query("SELECT * FROM products WHERE id IN (?, ?)", ['1', '2']);
// $products = Database::getInstace()->get('products', ['id', '>=', "1"]);
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

//  echo $products->getFirst()->product_name;

// if ($products->getError()) {
//   echo "We have an error <br>";
// } else {
//   foreach ($products->getResult() as $product) {
//     echo $product->product_name . '<br>';
//   }
// }

//  echo Config::get('mysql.dbname');


if (Cookie::exists(Config::get('cookie.cookie_name')) && !Session::exists(Config::get('session.user_session'))) {
  $hash = Cookie::get(Config::get('cookie.cookie_name'));
  $hashCheck = Database::getInstace()->get('user_sessions', ['hash', '=', $hash]);

  if ($hashCheck->getCount()) {
    $user = new User($hashCheck->getFirst()->user_id);
    $user->login();
  }
}
