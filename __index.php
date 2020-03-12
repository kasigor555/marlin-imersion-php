<?php

use App\controllers\MainController;

require 'vendor/autoload.php';
$db = new MainController;

$prodacts = $db->index();

?>

<?php foreach ($prodacts as $prodact) : ?>

  <div>
    <div>
      <img src="images/<?= $prodact['product_img']; ?>" alt="<?= $prodact['product_name']; ?>" width="100">
    </div>
    <div>
      <h1><?= $prodact['product_name']; ?></h1>
      <p><?= $prodact['product_desc']; ?></p>
    </div>
  </div>

<?php endforeach; ?>