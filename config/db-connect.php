<?php

/**
 * Параметры подключение к БД
 */
$GLOBALS['config'] = [
  'mysql' => [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'dbname' => 'product_catalog'
  ],
  'session' => [
    'token_name' => 'token',
    'user_session' => 'user',
  ],
  'cookie' => [
    'cookie_name' => 'hash',
    'cookie_expiry' => 604800,
  ],
];
