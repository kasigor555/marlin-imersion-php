<?php

class Cookie
{
  /**
   * ПРоверка на существование куки
   */
  public static function exists($name)
  {
    return (isset($_COOKIE[$name])) ? true : false;
  }

  /**
   * Получить куки
   */
  public static function get($name)
  {
    return $_COOKIE[$name];
  }

  /**
   * Записать куки
   * @param string $name Имя куки
   * @param string $value Значение куки
   * @param integer $expiry Время жизни куки
   * @return bool
   */
  public static function put($name, $value, $expiry)
  {
    if (setcookie($name, $value, time() + $expiry, '/')) {
      return true;
    }

    return false;
  }

  /**
   * Удалить куки
   */
  public static function delete($name)
  {
    self::put($name, '', time() - 1);
  }
}
