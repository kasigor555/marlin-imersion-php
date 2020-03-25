<?php
require_once '../init.php';

$errors = null;

$currentUser = new User($_GET['id']);
$userField = $currentUser->getData();

// echo "<pre>";
// var_dump($currentUser);
// echo "</pre>";

if (Input::exist()) {
  if (Token::check(Input::get('token'))) {

    $validation = new Validate();

    $validation->check($_POST, [
      'username' => [
        'required' => true,
        'min' => 2,
      ]
    ]);

    if ($validation->passed()) {
      Session::flash('success', 'Профиль обновлён');

      $currentUser->update([
        'username' => Input::get('username'),
        'user_desc' => Input::get('user_desc'),
      ], $_GET['id']);

      Redirect::to('index.php');
    } else {
      $errors = $validation->errors();
    }
  }
}

require_once '../includes/layouts/header.php';
require_once '../includes/layouts/top-nav.php';

?>

<div class="container">
  <div class="row">
    <div class="col-md-8">
      <h1>Профиль пользователя - <?php echo $userField->username; ?></h1>
      
      <?php if (Session::exists('success') && Session::get('success') != '') : ?>
        <div class="alert alert-success">
          <p><?= Session::flash("success"); ?></p>
        </div>
      <?php endif ?>

      <?php if ($errors) : ?>
        <div class="alert alert-danger">
          <?php foreach ($errors as $error) : ?>
            <p><?= $error; ?></p>
          <?php endforeach; ?>
        </div>
      <?php endif ?>

      <form action="" class="form" method="post">
        <div class="form-group">
          <label for="username">Имя</label>
          <input type="text" id="username" name="username" class="form-control" value="<?php echo $userField->username; ?>">
        </div>
        <div class="form-group">
          <label for="user_desc">Статус</label>
          <input type="text" id="user_desc" name="user_desc" class="form-control" value="<?php echo $userField->user_desc; ?>">
        </div>

        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <div class="form-group">
          <button class="btn btn-warning">Обновить</button>
        </div>
      </form>


    </div>
  </div>
</div>

<?php
require_once '../includes/layouts/footer.php';


?>