<?php
require_once 'init.php';

$errors = null;
$alert = null;

if (Input::exist()) {
  if (Token::check(Input::get('token'))) {
    $validate = new Validate();

    $validation = $validate->check($_POST, [
      'username' => [
        'required' => true,
        'min' => 2,
        'max' => 15,
      ],
      'email' => [
        'required' => true,
        'email' => true,
        'unique' => 'users'
      ],
      'password' => [
        'required' => true,
        'min' => 3
      ],
      'password_again' => [
        'required' => true,
        'matches' => 'password'
      ]
    ]);

    if ($validation->passed()) {
      // echo 'passed';
      $user = new User;
      $user->create([
        'username' => Input::get('username'),
        'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
        'email' => Input::get('email'),
      ]);

      $alert = Session::flash('success', 'register success');
      // header('Location: test.php');
      // Redirect::to('test.php');
    } else {
      $errors = $validation->errors();
    }
  }
}

require_once 'includes/layouts/header.php';
?>
<main role="main" class="flex-shrink-0">
  <section>
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="card text-center">
          <div class="card-header">
            <img class="mb-4" src="images/apple-touch-icon.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Регистрация</h1>
          </div>
          <div class="card-body">

            <?php if ($errors) : ?>
              <div class="alert alert-danger">
                <?php foreach ($errors as $error) : ?>
                  <p><?= $error; ?></p>
                <?php endforeach; ?>
              </div>
            <?php endif ?>

            <?php if ($alert) : ?>
              <div class="alert alert-success">
                <p><?= $alert; ?></p>
              </div>
            <?php endif ?>

            <form class="form-signin" method="post">

              <div class="form-group">
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo Input::get('email') ?>">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="username" name="username" placeholder="Ваше имя" value="<?php echo Input::get('username') ?>">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
              </div>

              <div class="form-group">
                <input type="password" class="form-control" id="password" name="password_again" placeholder="Повторите пароль">
              </div>

              <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
              <div class="checkbox mb-3">
                <label for="iagree" class="form-check-label">
                  <input type="checkbox" class="form-check-input" id="iagree" name="iagree"> Согласен со всеми правилами
                </label>
              </div>
              <button class="btn btn-lg btn-primary btn-block" type="submit">Зарегистрироваться</button>
            </form>
  </section>
</main>
<?php
require_once 'includes/layouts/footer.php';
?>