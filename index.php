<?php
require_once 'init.php';

// $db = new Database();

$users = Database::getInstace()->get('users', ['id', '>=', '1'])->getResult();


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Profile</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">User Management</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= $_SERVER['REQUEST_URI']; ?>">Главная</a>
        </li>
      </ul>

      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="login.php" class="nav-link">Войти</a>
        </li>
        <li class="nav-item">
          <a href="register.php" class="nav-link">Регистрация</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="jumbotron">
          <h1 class="display-4">Привет, мир!</h1>
          <p class="lead">Это дипломный проект по разработке на PHP. На этой странице список наших пользователей.</p>
          <hr class="my-4">
          <p>Чтобы стать частью нашего проекта вы можете пройти регистрацию.</p>
          <a class="btn btn-primary btn-lg" href="register.php" role="button">Зарегистрироваться</a>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <h1>Пользователи</h1>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Имя</th>
              <th>Email</th>
              <th>Дата</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($users as $user) : ?>
              <tr>
                <td><?= $user->id; ?></td>
                <td><a href="user_profile.php?id=<?= $user->id; ?>"><?= $user->username; ?></a></td>
                <td><?= $user->email; ?></td>
                <td><?= $user->created; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>