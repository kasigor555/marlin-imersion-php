<?php
require_once 'init.php';

// var_dump(Session::get('user'));
// echo "<pre>";
// print_r(Session::get(Config::get('session.user_session')));
// echo "<hr>";
// print_r($_SESSION);
// echo "</pre>";
// exit;

$user = new User;
$anotherrUser = new User(23);

// echo $user->getData()->username;
// echo "<br>";
// echo $anotherrUser->getData()->username;
// echo "<hr>";

if ($user->isLoggedIn()) {
  echo "Hi {$user->getData()->username}!";
  echo "<br>";
  echo "<a href='logout.php'>Logout</a>";
} else {
  echo "<a href='login.php'>Login</a> or <a href='register.php'>Registration</a>";
}
