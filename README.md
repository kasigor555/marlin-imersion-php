# Тестовый проект куса PHP-Погружение

Это дипломный проект по разработке на PHP. На этой странице список наших пользователей.

## Структура проекта

```
/
├── README.md
├──	.gitignore
├──	changepassword.php // изменение пароля
├──	profile.php // изменение полей профиля
├──	index.php // точка входа. вывод списка пользователей    
├──	login.php // авторизация
├──	logout.php // выход из профиля
├──	update.php // выход из профиля
├──	register.php // регистрация нового пользователя
├──	init.php // точка сбора всех компонентов
├──	user_profile.php // страница с описанием полей пользователя по id
│
├── DB_DUMP/
│   └── product_catalog.sql // дамп дазы данных
│
├── admin/
│   ├── edit.php // редактирование пользователей
│   ├── delete.php // удаление пользователя
│   ├── changerole.php // изменение роли
│   └── index.php // вывод списка пользователей для администрирования
│   
├── app/
│   └── controllers
│       ├── Config.php
│       ├── Cookie.php
│       ├── Database.php
│       ├── Input.php
│       ├── Redirect.php
│       ├── Session.php
│       ├── Token.php
│       ├── User.php
│       └── Validate.php
│   
├──config/
│   └── db-connect.php // Массив с настройками конфигураций
│   
├──css/
│   └── style.css
│   
├──images/
│   ├── ***.jpg
│   └── ***.png
│   
├──includes/
│   ├──errors/
│   │   └── 404.php
│   └── layouts/
│       ├── footer.php
│       ├── header.php
│       └── top-nav.php
│   
└───vandor/ /* подключаемые библиотеки */
    ├── conposer/
    │   ├── ***.php
    │   └── ***.php
    ├──******/
    │   ├── ***.php
    │   └── ***.php
    │   
    ├──	********/
    │   ├── ***
    │   └── ***
    │   
    └───******/
        ├──  ***.php
        ├── ***.php
        └── ***.php
```

