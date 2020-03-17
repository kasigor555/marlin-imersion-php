<?php
require_once 'init.php';

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

      Session::flash('success', 'register success');
      // header('Location: test.php');
      // Redirect::to('test.php');
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

    <?php echo Session::flash('success'); ?>

    <div class="row justify-content-md-center">
      <div class="card text-center">
        <div class="card-header">
          <h3>Test Form</h3>
        </div>
        <div class="card-body">
          <form action="" method="post">

            <div class="form-group">
              <label for="username">Username</label>
              <input class="form-control" type="text" name="username" value="<?php echo Input::get('username') ?>">
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input class="form-control" type="text" name="email" aria-describedby="emailHelp" value="<?php echo Input::get('email') ?>">
            </div>

            <div class="form-group">
              <label for="">Password</label>
              <input class="form-control" type="password" name="password">
            </div>

            <div class="form-group">
              <label for="">Repeat password</label>
              <input class="form-control" type="password" name="password_again">
            </div>

            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>



</body>

</html>