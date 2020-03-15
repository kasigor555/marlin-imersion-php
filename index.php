<?php

require_once 'app/controllers/Database.php';
require_once 'app/controllers/Config.php';
require_once 'config/db-connect.php';
require_once 'app/controllers/Input.php';
require_once 'app/controllers/Validate.php';


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


if (Input::exist()) {
  $validate = new Validate();

  $validation = $validate->check($_POST, [
    'username' => [
      'required' => true,
      'min' => 2,
      'max' => 15,
      'unique' => 'users'
    ],
    'password' => [
      'required' => true,
      'min' => 3
    ],
    'password_again' => [
      'required' => true,
      'matches' => 'password'
    ]
  ]);

  if ($validation->passed()) {
    echo 'passed';
  } else {
    foreach ($validation->errors() as $error) {
      echo $error . "<br>";
    }
  }
}
?>

<h3>Test Form</h3>
<form action="" method="post">
  <div class="field">
    <label for="username">Username</label>
    <input type="text" name="username" value="<?php echo Input::get('username') ?>">
  </div>

  <div class="field">
    <label for="">Password</label>
    <input type="password" name="password">
  </div>

  <div class="field">
    <label for="">Repeat password</label>
    <input type="password" name="password_again">
  </div>

  <div class="field">
    <button type="submit">Submit</button>
  </div>
</form>