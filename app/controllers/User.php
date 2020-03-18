<?php

class User
{
  private $db, $data, $session_name;

  /**
   * Созжание инкземпляра сояденения с БД
   */
  public function __construct()
  {
    $this->db = Database::getInstace();
    $this->session_name = Config::get('session.user_session');
  }

  /**
   * Запись пользователя в БД
   * 
   * @param array $fields данные из 
   */
  public function create($fields = [])
  {
    $this->db->insert('users', $fields);
  }

  /**
   * 
   */
  public function login($email = null, $password = null)
  {
    if ($email) { // если в форму введён email

      $user = $this->find($email);

      if ($user) {
        if (password_verify($password, $this->getData()->password)) {
          Session::put($this->session_name, $this->getData()->id);
          return true;
        }
      }
    }

    return false;
  }

  /**
   * 
   */
  public function find($email = null)
  {
    $this->data = $this->db->get('users', ['email', '=', $email])->getFirst(); // есть ли такой email в БД?

    return $this->data ? true : false;
  }

  /**
   * 
   */
  public function getData()
  {
    return $this->data;
  }
}
