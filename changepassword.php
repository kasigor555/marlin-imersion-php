<?php
require_once 'init.php';

$errors = null;
$alert = null;

$user = new User();

if (Input::exist()) {
  if (Token::check(Input::get('token'))) {

    $validation = new Validate();

    $validation->check($_POST, [
      'current_password' => [
        'required' => true,
        'min' => 3,
      ],
      'new_password' => [
        'required' => true,
        'min' => 6,

      ],
      'new_password_again' => [
        'required' => true,
        'min' => 6,
        'matches' => 'new_password'
      ]
    ]);

    if ($validation->passed()) {
      if (password_verify(Input::get('current_password'), $user->getData()->password)) {
        $user->update([
          'password' => password_hash(Input::get('new_password'), PASSWORD_DEFAULT),
        ]);
        Session::flash('success', 'Password has bin updated!');
        Redirect::to('index.php');
      } else {
        $alert = "Invalid current password";
      }
    } else {
      $errors = $validation->errors();
    }
  }
}

require_once 'includes/layouts/header.php';
require_once 'includes/layouts/top-nav.php';

?>

<div class="container">
  <div class="row">
    <div class="col-md-8">
      <h1>Изменить пароль пользователя - <?php echo $user->getData()->username; ?></h1>

      <?php if (Session::exists('success') && Session::get('success') != '') : ?>
        <div class="alert alert-info">
          <p><?= Session::flash("success"); ?></p>
        </div>
      <?php endif ?>

      <?php if ($alert) : ?>
        <div class="alert alert-success">
          <p><?= $alert; ?></p>
        </div>
      <?php endif ?>

      <?php if ($errors) : ?>
        <div class="alert alert-danger">
          <?php foreach ($errors as $error) : ?>
            <p><?= $error; ?></p>
          <?php endforeach; ?>
        </div>
      <?php endif ?>

      <ul>
        <li><a href="profile.php">Изменить профиль</a></li>
      </ul>
      <form action="" class="form" method="post">
        <div class="form-group">
          <label for="current_password">Текущий пароль</label>
          <input type="password" id="current_password" name="current_password" class="form-control">
        </div>
        <div class="form-group">
          <label for="new_password">Новый пароль</label>
          <input type="password" id="new_password" name="new_password" class="form-control">
        </div>
        <div class="form-group">
          <label for="new_password_again">Повторите новый пароль</label>
          <input type="password" id="new_password_again" name="new_password_again" class="form-control">
        </div>

        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <div class="form-group">
          <button class="btn btn-warning">Изменить</button>
        </div>
      </form>


    </div>
  </div>
</div>

<?php
require_once 'includes/layouts/footer.php';


?>