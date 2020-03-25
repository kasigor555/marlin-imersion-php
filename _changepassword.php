<?php
require_once 'init.php';

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
        echo "Invalid current password";
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
          <h3>Change password</h3>
        </div>
        <div class="card-body">
          <form action="" method="post">

            <div class="form-group">
              <label for="username">Current password</label>
              <input class="form-control" type="text" name="current_password" id="current_password">
            </div>

            <div class="form-group">
              <label for="new_password">New password</label>
              <input class="form-control" type="text" name="new_password" id="new_password">
            </div>

            <div class="form-group">
              <label for="new_password_again">New password again</label>
              <input class="form-control" type="text" name="new_password_again" id="new_password_again">
            </div>

            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <div class="card-footer">
          <a href='update.php'>Update profile</a>
        </div>
      </div>
    </div>
  </div>

</body>

</html>