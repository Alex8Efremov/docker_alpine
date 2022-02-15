<DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Request of the information</title>
</head>
<body>
  <div class="container mt-4">
    <!-- Check Cookie -->
    <?php
      if($_COOKIE['name_cookie'] == ''):
    ?>
    <div class="row">
      <div class="col">
        <h2>Registration form</h2>
        <!-- File that processes input data -->
        <form action="validation-form/check.php" method="post">
          <input type="text" class="form-control" name="login" id="login"
          placeholder="Enter Login"><br>
          <input type="text" class="form-control" name="name" id="name"
          placeholder="Enter Name"><br>
          <input type="password" class="form-control" name="pass" id="pass"
          placeholder="Enter Password"><br>
          <input type="text" class="form-control" name="e_mail" id="e_mail"
          placeholder="Enter E-mail"><br>
          <button class="btn btn-success" type="submit">Registration</button>
        </form>
      </div>
      <div class="col">
        <h2>Registration form</h2>
        <!-- File that processes input data -->
        <form action="validation-form/auth.php" method="post">
          <input type="text" class="form-control" name="login" id="login"
          placeholder="Enter Login"><br>
          <input type="password" class="form-control" name="pass" id="pass"
          placeholder="Enter Password"><br>
          <button class="btn btn-success" type="submit">Authorization</button>
        </form>
      </div>
    <?php else: ?>
      <p>Hello my Dear Friend! <?$_COOKIE['name_cookie']?>. To exit cleack <a
        href="/validation-form/exit.php">here</a>! </p>

    <?php endif; ?>
</body>
</hyml>
