<?php
require_once 'init.php';

// var_dump(Session::get('user'));
// echo "<pre>";
// print_r(Session::get(Config::get('session.user_session')));
// echo "<hr>";
// print_r($_SESSION);
// echo "</pre>";
// exit;

echo Session::flash("success") . "<br>";

$user = new User;

// echo $user->getData()->username;
// echo "<br>";
// echo $anotherrUser->getData()->username;
// echo "<hr>";


if ($user->isLoggedIn()) {
  echo "Hi {$user->getData()->username}!";
  echo "<br>";
  echo "<a href='logout.php'>Logout</a><br>";
  echo "<a href='update.php'>Update profile</a><br>";
  echo "<a href='changepassword.php'>Change password</a>";
} else {
  echo "<a href='login.php'>Login</a> or <a href='register.php'>Registration</a>";
}
