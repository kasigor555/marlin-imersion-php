<?php
require_once 'init.php';

$errors = null;
$alert = null;

if (Input::exist()) { // проверить, отправлена ли форма, по умолчанию type='post'

  if (Token::check(Input::get('token'))) { // проверяем корректность токена

    $validation = new Validate();

    $validation->check($_POST, [
      'email' => [
        'required' => true,
        'email' => true,
      ],
      'password' => [
        'required' => true,
      ],
    ]);

    if ($validation->passed()) {
      $user = new User;
      $remember = (Input::get('remember')) === 'on' ? true : false; // если чекбокс отмечен, вернуть true
      $login = $user->login(Input::get('email'), Input::get('password'), $remember);
      // echo "<pre>";
      // var_dump($remember);
      // echo "</pre>";


      if ($login) {
        Redirect::to('index.php');
      } else {
        $alert = "Login failed";
      }
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
            <h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>
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

            <form action="" method="post">

              <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="text" name="email" aria-describedby="emailHelp" value="<?php echo Input::get('email') ?>">
              </div>

              <div class="form-group">
                <label for="">Password</label>
                <input class="form-control" type="text" name="password">
              </div>

              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember" name="remember">
                  <label class="form-check-label" for="remember">
                    Запомнить меня
                  </label>
                </div>
              </div>
              <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
              <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary btn-block">Войти</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php
require_once 'includes/layouts/footer.php';
?>