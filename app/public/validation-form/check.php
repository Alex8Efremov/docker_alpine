<DOCKTYPE html>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <?php
    require 'pass.php';

    $login = filter_var(trim($_POST['login']),
    FILTER_SANITIZE_STRING);
    $name = filter_var(trim($_POST['name']),
    FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']),
    FILTER_SANITIZE_STRING);
    $e_mail = filter_var(trim($_POST['e_mail']),
    FILTER_SANITIZE_STRING);

    if(mb_strlen($login) < 5 || mb_strlen($login) > 32) {
      echo 'Login length must be between 5 and 32 characters!';
      exit();
    } else if(mb_strlen($name) < 3 || mb_strlen($name) > 32) {
      echo 'Name length ength must be between 3 and 32 characters!';
      exit();
    } else if(mb_strlen($pass) < 3 || mb_strlen($pass) > 32) {
      echo 'Name length ength must be between 3 and 32 characters!';
      exit();
    }

    $pass = md5($pass."addmychashpasswordtomypass9876543210123456789852456");

    $mysql = new mysqli($DBHOST, $DBUSER, $DBPASS, $DBNAME);
    $mysql->query("INSERT INTO `users` (`name`, `login`, `password`, `email`)
    VALUES('$name', '$login', '$pass', '$e_mail')");
    // need to close //
    $mysql->close();

    // redirect to main page
    header('Location: congratulation.html');
    exit();
  ?>
</html>
