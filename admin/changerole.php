<?php
require_once '../init.php';

$id = $_GET['id'];

$editUser = new User($_GET['id']);
$userField = $editUser->getData();

echo "<pre>";
var_dump($userField);
echo "</pre>";

if ($editUser->hasPermissions('admin')) {
  // echo '<p class="card-text"><small class="text-muted">You are Admin.</small></p>';
  $editUser->update(['group_id' => 1], $id);
  Redirect::to('index.php');
} else {
  // echo '<p class="card-text"><small class="text-muted">You are not Admin.</small></p>';
  $editUser->update(['group_id' => 2], $id);
  Redirect::to('index.php');
}