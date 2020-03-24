<?php

class Database
{
  private static $instace = null;
  private $pdo, $query, $error = false, $result, $count;

  /**
   * Подключение к БД
   */
  private function __construct()
  {
    try {
      $this->pdo = new PDO(
        'mysql:host=' . Config::get('mysql.host') . ';dbname=' . Config::get('mysql.dbname'),
        Config::get('mysql.username'),
        Config::get('mysql.password')
      );
      // $this->pdo = new PDO("mysql:host=localhost; dbname=product_catalog", 'root', '' );
    } catch (PDOException $e) {
      throw new Exception($e->getMessage());
    }
  }

  /**
   * Создание эеземпляра подключения
   * 
   * @return object
   */
  public static function getInstace()
  {
    if (!isset(self::$instace)) {
      self::$instace = new Database();
    }

    return self::$instace;
  }

  /**
   * Выполнение запроса
   * 
   * @return this
   */
  public function query($sql, $params = [])
  {
    $this->error = false;
    $this->query = $this->pdo->prepare($sql);

    if (count($params)) {

      $i = 1;
      foreach ($params as $param) {
        $this->query->bindValue($i, $param);
        $i++;
      }
    }

    if (!$this->query->execute()) {
      $this->error = true;
    } else {
      $this->result = $this->query->fetchAll(PDO::FETCH_OBJ);
      $this->count = $this->query->rowCount();
    }

    return $this;
  }

  /**
   * Вывод ошибок
   * 
   * @return array $error
   */
  public function getError()
  {
    return $this->error;
  }

  /**
   * Вывод результата запроса
   */
  public function getResult()
  {
    return $this->result;
  }

  /**
   * Подсчёт кол-ва выбранных записей
   */
  public function getCount()
  {
    return $this->count;
  }


  /**
   * Получение записей с условием
   * 
   * @param string $table table name
   * @param array $where conditons
   * @return string query
   */
  public function get($table, $where = [])
  {
    return $this->action('SELECT *', $table, $where);
  }

  /**
   * Получение всех записей
   */
  public function getAll($table)
  {
    $sql = "SELECT * FROM {$table}";

    if (!$this->query($sql)->getError()) {
      return $this;
    }

    return false;
  }

  /**
   * Удаление записей
   */
  public function delete($table, $where = [])
  {
    return $this->action('DELETE', $table, $where);
  }

  /**
   * Метод генерации даействия в таблице
   */
  public function action($action, $table, $where = [])
  {
    if (count($where) === 3) {

      $operators = ['=', '>', '<', '>=', '<='];

      $field = $where[0];
      $operator = $where[1];
      $value = $where[2];

      if (in_array($operator, $operators)) {
        $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

        if (!$this->query($sql, [$value])->getError()) {
          return $this;
        }
      }
    }

    return false;
  }

  /**
   * Метод записи в БД
   */
  public function insert($table, $fields = [])
  {
    $val = '';
    foreach ($fields as $field) {
      $val .= '?, ';
    }
    $val = rtrim($val, ', ');

    $sql = "INSERT INTO {$table} (" . '`' . implode('`, `', array_keys($fields)) . '`' . ") VALUES ({$val})";

    if (!$this->query($sql, $fields)->getError()) {
      return true;
    }

    return false;
  }

  /**
   * Метод обновления записей
   */
  public function update($table, $id, $fields = [])
  {
    $set = '';
    foreach ($fields as $key => $field) {
      $set .= "{$key} = ?, ";
    }
    $set = rtrim($set, ', ');

    $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

    if (!$this->query($sql, $fields)->getError()) {
      return true;
    }

    return false;
  }

  /**
   * Получить первую запись из выбранных
   */
  public function getFirst()
  {
    return $this->getResult()[0];
  }
}
