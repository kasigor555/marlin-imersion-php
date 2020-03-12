<?php
require_once 'config/db.php';
/**
 * Подключение к БД
 */

function connect()
{
  $servername = SERVERNAME; // локалхост
  $username = USERNAME; // имя пользователя
  $password = PASSWORD; // пароль если существует
  $dbname = DBNAME; // база данных

  try{
    $db = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Успешное подключение";
  } catch (PDOException $e) {
    die('Подключение не удалось: ' . $e->getMessage());
  }
  
  return $db;
}