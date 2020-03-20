<?php
require_once 'init.php';

$user = new User();
$validation = new Validate();

$validation->check($_POST, [
  'username' => [
    'required' => true,
    'min' => 2,
  ]
]);

if (Input::exist()) {
  if (Token::check(Input::get('token'))) {
    if ($validation->passed()) {
      $user->update([
        'username' => Input::get('username'),
        ]);
        Redirect::to('update.php');
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
          <h3>Update Profile</h3>
        </div>
        <div class="card-body">
          <form action="" method="post">

            <div class="form-group">
              <label for="username">Username</label>
              <input class="form-control" type="text" name="username" id="username" value="<?php echo $user->getData()->username; ?>">
            </div>

            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <div class="card-footer">
          <a href="login.php" class="card-link">Login</a>
        </div>
      </div>
    </div>
  </div>



</body>

</html>