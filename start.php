<?php
  include 'php/loaders/start.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Virtual Company - Create Your Company</title>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
  </head>

  <body>
    <div class="container" style="margin-top: 128px;">
      <div class="row justify-content-center align-items-center" style="margin-top:100px;">
          <div class="col-4">
            <?php if (isset($GLOBALS['error'])): ?>
              <div class="alert alert-danger">
                <?php echo $GLOBALS['error']; ?>
              </div>
            <?php endif; ?>
              <div class="card">
                  <div class="card-body">
                    <h1 style="margin: 25px 0;" class="text-center">New Company</h1>
                      <form method="post">

                          <div class="form-group">
                              <input type="text" class="form-control" name="company" placeholder="Company name">
                          </div>

                          <div class="form-group">
                              <input type="text" class="form-control" name="name" placeholder="Name">
                          </div>

                          <div class="form-group">
                              <input type="text" class="form-control" name="username" placeholder="Username">
                          </div>

                          <div class="form-group">
                              <input type="password" class="form-control" name="password" placeholder="Password">
                          </div>

                          <div class="form-group">
                            <select class="form-control" name="baseplate">
                              <option value="1">Baseplate (big)</option>
                              <option value="2">Baseplate (small)</option>
                            </select>
                          </div>

                          <input type="submit" name="register" value="Create Company" class="btn btn-primary btn-block">
                      </form>
                  </div>
              </div>

              <a href="login" class="my-3 d-block">Already have one? Log in here.</a>
          </div>
      </div>
    </div>
  </body>
</html>
