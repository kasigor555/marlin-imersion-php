<?php
require_once 'init.php';

$users = Database::getInstace()->get('users', ['id', '>=', '1'])->getResult();

require_once 'includes/layouts/header.php';
require_once 'includes/layouts/top-nav.php';

?>

<section>
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
              <th>Дата регистранции</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($users as $user) : ?>
              <tr>
                <td><?= $user->id; ?></td>
                <td><a href="user_profile.php?id=<?= $user->id; ?>"><?= $user->username; ?></a></td>
                <td><?= $user->email; ?></td>
                <td><?= date('d/m/Y', strtotime($user->created)); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<?php
require_once 'includes/layouts/footer.php';
?>