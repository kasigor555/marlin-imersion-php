<?php
require_once 'init.php';

// var_dump(Session::get('user'));
echo "<pre>";
print_r(Session::get(Config::get('session.user_session')));
echo "<hr>";
print_r($_SESSION);
echo "</pre>";
exit;
