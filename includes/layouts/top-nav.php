<?php
$user = new User;


?>

<?php if ($user->isLoggedIn()) { ?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Главная</a>
        </li>
        <?php if ($user->hasPermissions('admin')) { ?>
          <li class="nav-item">
            <a class="nav-link" href="admin/index.php">Управление пользователями</a>
          </li>
        <?php } ?>
      </ul>

      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="profile.php" class="nav-link">Профиль</a>
        </li>
        <li class="nav-item">
          <a href="logout.php" class="nav-link">Выйти</a>
        </li>
      </ul>
    </div>
  </nav>
<?php } else { ?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Главная</a>
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
<?php } ?>