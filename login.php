<?php include 'php/loaders/login.php'; ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <title>Virtual Company - Login</title>

    <script src="js/main.js" charset="utf-8"></script>
  </head>

  <body>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="margin-top:100px;">
            <div class="col-4">
              <?php if (isset($GLOBALS['error'])): ?>
                <div class="alert alert-danger">
                  <?php echo $GLOBALS['error']; ?>
                </div>
              <?php endif; ?>
                <div class="card">
                    <div class="card-body">
                      <h1 style="margin: 25px 0;" class="text-center">Login</h1>
                        <form method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="company" placeholder="Company">
                            </div>
                            <input type="submit" name="login" value="Login" class="btn btn-primary btn-block">
                        </form>
                    </div>
                </div>

                <a href="start" class="my-3 d-block">No company? Create one.</a>
            </div>
        </div>
    </div>
  </body>
</html>
