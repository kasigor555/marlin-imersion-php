<?php
require_once '../init.php';

// $db = new Database();

$users = Database::getInstace()->get('users', ['id', '>=', '1'])->getResult();

require_once '../includes/layouts/header.php';
require_once '../includes/layouts/top-nav.php';

?>

<div class="container">
  <div class="col-md-12">
    <h1>Пользователи</h1>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Имя</th>
          <th>Email</th>
          <th>Действия</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($users as $user) : ?>
          <tr>
            <td><?= $user->id; ?></td>
            <td><?= $user->username; ?></td>
            <td><?= $user->email; ?></td>
            <td>
              <a href="#" class="btn btn-success">Назначить администратором</a>
              <a href="user_profile.php?id=<?= $user->id; ?>" class="btn btn-info">Посмотреть</a>
              <a href="#" class="btn btn-warning">Редактировать</a>
              <a href="#" class="btn btn-danger" onclick="return confirm('Вы уверены?');">Удалить</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php
require_once '../includes/layouts/footer.php';
?>