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
   * Авторизайия пользователя
   */
  public function login($email = null, $password = null, $remember = false)
  {
    if (!$email && !$password) { // проверка, если нет имайла и пароля, но пользователь существует, (удалена проверка $this->exists();)
      Session::put($this->session_name, $this->getData()->id);
    } else {

      $user = $this->find($email); // найти пользователя по имэйлу

      if ($user) {
        if (password_verify($password, $this->getData()->password)) { // проверка пароля
          Session::put($this->session_name, $this->getData()->id);

          if ($remember) { // если активет чекбокс 
            $hash = hash('sha256', uniqid()); // создать уникальный хэш
            $hashCheck = $this->db->get('user_sessions', ['user_id', '=', $this->getData()->id]); // проверить, еслть ли хэш в БД

            if (!$hashCheck->getCount()) { // если в БД нет хеша, записать
              $this->db->insert('user_sessions', [
                'user_id' => $this->getData()->id,
                'hash' => $hash,
              ]);
            } else {
              $hash = $hashCheck->getFirst()->hash; // если есть, извлечь хэш
            }

            Cookie::put(Config::get('cookie.cookie_name'), $hash, Config::get('cookie.cookie_expiry')); // и записать хэш в куки
          }

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
