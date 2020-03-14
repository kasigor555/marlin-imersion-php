<?php
require_once '../app/controllers/Database.php';
require_once '../app/controllers/Config.php';

/**
 * Параметры подключение к БД
 */
$GLOBALS['config'] = [
  'mysql' => [
    'hosts' => 'localhost',
    'username' => 'root',
    'password' => '',
    'dbname' => 'product_catalog'
  ]
];

echo Config::get('mysql.dbname');
