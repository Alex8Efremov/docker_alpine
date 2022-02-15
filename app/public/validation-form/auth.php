<DOCTYPE html>
<body>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <?php
    require 'pass.php';

    $login = filter_var(trim($_POST['login']),
    FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']),
    FILTER_SANITIZE_STRING);

    $pass = md5($pass."addmychashpasswordtomypass9876543210123456789852456");

    $mysql = new mysqli($DBHOST, $DBUSER, $DBPASS, $DBNAME);

    // this is forat object
    $result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login' AND
       `password` = '$pass'");
    // DELETE USER!
    if(isset($_GET['delete'])) {
           $sql = $mysql->query('DELETE FROM `users` WHERE `id` = "'.$_GET['delete'].'"');
           if ($sql) {
           echo "<p><center><h1>User deleted!</h1></center></p>";
           echo "<br><center>To come back<p><a href='../index.php'>click here</a></center>";
           exit();
         } else {
           echo "<p><center><h1 color='red'>ERROR</h1></center></p>";
         }
       }
    // masive
    $user = $result->fetch_assoc();
    if(count((array)$user) == 0) {
      echo '<h2><center>This user is not found =(';
      echo '<br>To come back<p><a href="../index.php">click here</a>';
      exit();
    } else { // output data
      $sql = $mysql->query("SELECT * FROM `users`");
      if(mysqli_num_rows($sql) != 0) {
        echo "<table>";
                      while ($result = mysqli_fetch_array($sql)) {
                        echo '<tr>';
                        echo '<p><td>Name: ' .$result['name']. '</td></p>';
                        echo '<td>Login: ' .$result['login']. '</td>';
                        echo '<td align="center">' . "<a href='?delete=".$result['id']."'>deleted!</a>". '</td';
                        echo '</tr>';
                      }
        echo "</table>";
        echo '<br><h3 align="center">To come back</h1><p align="center" color=green><a href="../index.php">click here</a>';
      }
    }
    setcookie('name_cookie', $user['name'], time() + 3600, "/");

    // need to close //
    $mysql->close();

  ?>
</body>
</hyml>
