<?php

namespace App\controllers;

use PDO;

class MainController
{

  const SERVERNAME = 'localhost';
  const USERNAME = 'root';
  const PASSWORD = '';
  const DBNAME = 'product_catalog';

  public $db;

  function __construct()
  {
    $this->db = new PDO("mysql:host=localhost; dbname=product_catalog", 'root', '');
  }

  function index()
  {
    $sql = "SELECT * FROM products LIMIT 9";
    $stm = $this->db->query($sql);
    $stm->execute();
    $res = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $res;
  }
}
