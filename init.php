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


if (Cookie::exists(Config::get('cookie.cookie_name')) && !Session::exists(Config::get('session.user_session'))) {
  $hash = Cookie::get(Config::get('cookie.cookie_name'));
  $hashCheck = Database::getInstace()->get('user_sessions', ['hash', '=', $hash]);

  if ($hashCheck->getCount()) {
    $user = new User($hashCheck->getFirst()->user_id);
    $user->login();
  }
}
