<?
/**
 * Класс работы с БД
 */
class Database
{
  public $db;

  /**
   * Подключение к БД
   */
  function __construct()
  {
    try{
      $this->db = new PDO('mysql:host=localhost; dbname=comments', 'root', '');
    } catch (PDOException $e) {
      throw new Exception($e->getMessage());
    }
    
  }

  /**
   * получить все записи из таблицы
   */
  function getAll($table)
  {
    $sql = "SELECT * FROME $table";
    $stm = $this->db->query($sql);
    $stm->execute();

    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * получить одну запись из таблицы по id
   */
  function getOne($table, $id)
  {
    $sql = "SELECT * FTROME $table WHERE id=:id"; // запрос
    $stm = $this->db->prepare($sql);  // подготовить запрос
    $stm->bindParam(':id', $id); // сопоставить параметры
    $stm->execute(); // выполнить запрас

    return $stm->fetch(PDO::FETCH_ASSOC); // получить результат
  }

  /**
   * записать данные в таблицу
   * TODO: прояснить вопрос с безопастностью обработки $data
   */
  function insert($table, $data)
  {
    // получить ключи из массива $_GET или $_POST
    $dataKeys = array_keys($data);
    // склеить ключи в строку (список полей таблицы)
    $tableFeilds = implode(', ', $dataKeys);
    // склеять ключи в строку вида ":key1, :key2",
    $tablePlaceHolders = ':' . implode(', :', $dataKeys);

    // убрать ", " в конце строки
    // $dataFields = '';
    // foreach ($data as $k => $v) {
    //   $dataFields .= ":" . $k . ", ";
    // }
    // $dataFields = rtrim($dataFields, ', ');

    $sql = "INSERT INTO $table ($tableFeilds) VALUES ($tablePlaceHolders)";
    $stm = $this->db->prepare($sql);
    $stm->execute($data); // в параметрах значение массива $_GET или $_POST
  }

  /**
   * обновить данные записи в таблице по id
   */
  function update($table, $data, $id)
  {
    $tableFeilds = '';
    // foreach ($data as $k => $v) {
    //   $tableFeilds .= $k . "=:" . $k . ", ";
    // }
    // $tableFeilds = rtrim($tableFeilds, ', ');

    $sql = "UPDATE $table SET $tableFeilds WHERE id=:id";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(':id', $id);
    // не понятно, как сделать bindParam для остальных полей
    // foreach ($data as $key => &$val) {
    //   $stm->bindParam($key, $val);
    // }

    $stm->execute();
  }

  /**
   * удалить запись из таблицы по id
   */
  function delete($table, $id)
  {
    $sql = "DELETE FROM $table WHERE id=:id";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(':id', $id);
    $stm->execute();
  }
}
