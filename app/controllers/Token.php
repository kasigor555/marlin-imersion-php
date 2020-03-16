<?php

class Token
{

  /**
   * Создание токена
   */
  public static function generate()
  {
    // записать в сессию по ключу 'session.token_name' уникальное значение md5...
    return Session::put(Config::get('session.token_name'), md5(uniqid()));
  }

  /**
   * Проверка токена
   */
  public static function check($token)
  {
    // получить значение в сессии по ключу
    $tokenName = Config::get('session.token_name');

    // если значение существует и совпадает 
    if (Session::exists($tokenName) && $token == Session::get($tokenName)) {
      Session::delete($tokenName); // удалить значение сессии по ключу
      return true;
    }

    return false;
  }
}
