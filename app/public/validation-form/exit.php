<DOCKTYPE html>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <?php
    setcookie('name_cookie', $user['name'], time() - 3600, "/");
    header('Location: /');
    exit();

   ?>
</html>
