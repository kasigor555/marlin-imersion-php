<?php
require_once 'init.php';

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
        echo "Login failed";
      }
    } else {
      foreach ($validation->errors() as $error) {
        echo $error . "<br>";
      }
    }
  }
}
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title> </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
  <div class="container">



    <div class="row justify-content-md-center">
      <div class="card text-center">
        <div class="card-header">
          <h3>Login</h3>
        </div>
        <div class="card-body">
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
                  Remember Me
                </label>
              </div>
            </div>
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <div class="card-footer">
          <a href="register.php" class="card-link">Registration</a>
        </div>
      </div>
    </div>
  </div>



</body>

</html>