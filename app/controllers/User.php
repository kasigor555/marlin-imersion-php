<?php

class User
{
  private $db, $data, $session_name, $isLoggedIn;

  /**
   * Созжание инкземпляра сояденения с БД
   */
  public function __construct($user = null)
  {
    $this->db = Database::getInstace();
    $this->session_name = Config::get('session.user_session');

    if (!$user) {

      if (Session::exists($this->session_name)) {
        $user = Session::get($this->session_name);

        if ($this->find($user)) {
          $this->isLoggedIn = true;
        } else {
          //
        }        
      }
    } else {
      $this->find($user);
    }
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
  public function logout()
  {
    return Session::delete($this->session_name);
  }

  /**
   * 
   */
  public function find($value = null)
  {
    if (is_numeric(($value))) {
      $this->data = $this->db->get('users', ['id', '=', $value])->getFirst(); // есть ли такой id в БД?
    } else {
      $this->data = $this->db->get('users', ['email', '=', $value])->getFirst(); // есть ли такой email в БД?
    }
    

    return $this->data ? true : false;
  }

  /**
   * 
   */
  public function getData()
  {
    return $this->data;
  }

  /**
   * 
   */
  public function isLoggedIn()
  {
    return $this->isLoggedIn;
  }
}
