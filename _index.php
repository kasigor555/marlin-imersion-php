<?php
require_once 'init.php';

// var_dump(Session::get('user'));
// echo "<pre>";
// print_r(Session::get(Config::get('session.user_session')));
// echo "<hr>";
// print_r($_SESSION);
// echo "</pre>";
// exit;

echo Session::flash("success") . "<br>";

$user = new User;

// echo $user->getData()->username;
// echo "<br>";
// echo $anotherrUser->getData()->username;
// echo "<hr>";


// if ($user->isLoggedIn()) {
//   echo "Hi {$user->getData()->username}!";
//   echo "<br>";
//   echo "<a href='logout.php'>Logout</a><br>";
//   echo "<a href='update.php'>Update profile</a><br>";
//   echo "<a href='changepassword.php'>Change password</a><br>";

//   if ($user->hasPermissions('admin')) {
//     echo "You are Admin.";
//   }
// } else {
//   echo "<a href='login.php'>Login</a> or <a href='register.php'>Registration</a>";
// }

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

      <?php if ($user->isLoggedIn()) { ?>

        <div class="card mb-3" style="max-width: 540px;">
          <div class="row no-gutters">
            <div class="col-md-4">
              <img src="images/User_No_Image-180.png" class="card-img m-2" alt='<?php echo "Hi {$user->getData()->username}!"; ?>'>
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title"><?php echo "Hi {$user->getData()->username}!"; ?></h5>

                <?php if ($user->hasPermissions('admin')) {
                  echo '<p class="card-text"><small class="text-muted">You are Admin.</small></p>';
                } ?>

                <p class="card-text">This is your profile card.</p>
                <ul>
                  <li><?php echo "<a href='logout.php'>Logout</a>"; ?></li>
                  <li><?php echo "<a href='update.php'>Update profile</a>"; ?></li>
                  <li><?php echo "<a href='changepassword.php'>Change password</a>"; ?></li>
                </ul>
              </div>
            </div>
          </div>
        </div>

      <?php } else { ?>
        <div class="card text-center" style="width: 18rem;">
          <div class="card-body">
            <p><a href='login.php' class="btn btn-primary">Login</a></p>
            <p>OR</p>
            <p><a href='register.php' class="btn btn-primary">Registration</a></p>
          </div>
        </div>

      <?php } ?>

    </div>
  </div>



</body>

</html>