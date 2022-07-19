<?php
  require '../php/index.php';
  require '../php/classes/database.php';
  require '../php/classes/login.php';
  require '../php/classes/objects.php';
  require '../php/classes/baseplate.php';
  require '../php/classes/users.php';
  require '../php/classes/work.php';
  $users = new users;
  $users->messageCompany($db);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <script src="../js/main.js" charset="utf-8"></script>

    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  </head>
  <body style="overflow:hidden;">
    <div>
        <form method="post">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col">
                  <input type="text" name="chatmsg" class="form-control d-inline-block" placeholder="Message">
                </div>
                <div class="col-md-3">
                  <input type="submit" name="sendmsg" value="Send" class="btn btn-success btn-block d-inline-block" style="display:inline-block!important;">
                </div>
              </div>
            </div>
          </div>
        </form>
    </div>
  </body>
</html>
