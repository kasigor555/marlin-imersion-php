<?php

class Session
{

  /**
   * Записать в сессию
   */
  public static function put($name, $value)
  {
    return $_SESSION[$name] = $value;
  }

  /**
   * Проверить на наличе в сессии
   */
  public static function exists($name)
  {
    return (isset($_SESSION[$name])) ? true : false;
  }

  /**
   * Удалить сессию
   */
  public static function delete($name)
  {
    if (self::exists($name)) {
      unset($_SESSION[$name]);
    }
  }

  /**
   * Получить значение
   */
  public static function get($name)
  {
    return $_SESSION[$name];
  }

  /**
   * Вывод flash сообщения
   */
  public static function flash($name, $str = '')
  {
    if (self::exists($name) && self::get($name) != '') {
      $session = self::get($name);
      self::delete($name);
      return $session;
    } else {
      self::put($name, $str);
    }      
    
  }

}
