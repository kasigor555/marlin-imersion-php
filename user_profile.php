<?php
require_once 'init.php';

$user = new User($_GET['id']);
$userField = $user->getData();
// echo "<pre>";
// var_dump($userField->id);
// echo "</pre>";

require_once 'includes/layouts/header.php';
require_once 'includes/layouts/top-nav.php';
?>
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Данные пользователя</h1>
        <table class="table">
          <thead>
            <th>ID</th>
            <th>Имя</th>
            <th>Дата регистрации</th>
            <th>Статус</th>
          </thead>

          <tbody>

            <tr>
              <td><?= $userField->id; ?></td>
              <td><?= $userField->username; ?></td>
              <td><?= date('d/m/Y', strtotime($userField->created)); ?></td>
              <td><?= $userField->user_desc; ?></td>
            </tr>

          </tbody>
        </table>


      </div>
    </div>
  </div>
</section>

<?php
require_once 'includes/layouts/footer.php';
?>