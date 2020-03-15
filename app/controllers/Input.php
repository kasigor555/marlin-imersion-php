<?php

class Input
{
  /**
   * Проверка, отправлена ли форма
   */
  public static function exist($type = 'post')
  {
    switch ($type) {
      case 'post':
        return (!empty($_POST)) ? true : false;
        // break;
      case 'get';
        return (!empty($_GET)) ? true : false;
        // break;

      default:
        return false;
        break;
    }
  }

  /**
   * Получить значения из глобальных массивов $_POST  и $_GET
   */
  public static function get($item)
  {
    if (isset($_POST[$item])) {
      return $_POST[$item];
    } else if (isset($_GET[$item])) {
      return $_GET[$item];
    }

    return '';
  }
}
