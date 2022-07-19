<?php

class users {
  public function addUser($db){
    if(isset($_POST['adduser'])){
      var_dump($_POST);
      $name = htmlspecialchars($_POST['name']);
      $username = htmlspecialchars($_POST['username']);
      $password = htmlspecialchars($_POST['password']);
      $company = $_SESSION['company'];
      $password = hash("sha512",$password);
      $permission = $_POST['permission'];
      $working = 0;

      $query = "INSERT INTO `users`(`name`, `username`, `password`, `permission`, `company`, `working`) VALUES (?,?,?,?,?,?)";
      $prepare = $db->prepare($query);
      $prepare->bind_param("sssisi",$name,$username,$password,$permission,$company,$working);
      $prepare->execute();

      var_dump($prepare);

      $prepare->close();

      header('location:index');
    }
  }

  public function showUsers($db){
    $username = $_SESSION['username'];
    $company = $_SESSION['company'];

    $query = "SELECT * FROM users WHERE company=?";
    $prepare = $db->prepare($query);
    $prepare->bind_param("s",$company);
    $prepare->execute();

    $result = $prepare->get_result();

    while ($row = $result->fetch_assoc()) {
      if($row['working'] === 0){
        $working = ' <div class="badge badge-danger ml-2 p-2" style="margin-top:-2px;">Not working</div>';
      } elseif($row['working'] === 1) {
        $working = ' <div class="badge badge-success ml-2 p-2" style="margin-top:-2px;">Working</div>';
      } else {
        $working = ' <div class="badge badge-warning ml-2 p-2" style="margin-top:-2px;">Break</div>';
      }

      if($row['username'] === $username){
        if($row['permission'] > 1){
          echo '<div class="col-md-12 py-3">
            👑 '.$row['name'].' '.$working.'
          </div>';
        } else {
          echo '<div class="col-md-12 py-3">
            '.$row['name'].' '.$working.'
          </div>';
        }
      } else {
        if($_SESSION['permission'] > 1){
          if($row['permission'] > 1){
            echo '<div class="col-md-12 py-3">
              👑 '.$row['name'].' '.$working.' <a class="ml-2 text-danger" href="?deleteUser='.$row['username'].'">Delete</a>
            </div>';
          } else {
            echo '<div class="col-md-12 py-3">
              '.$row['name'].' '.$working.' <a class="ml-2 text-danger" href="?deleteUser='.$row['username'].'">Delete</a>
            </div>';
          }
        } else {
          if($row['permission'] > 1){
            echo '<div class="col-md-12 py-3">
              👑 '.$row['name'].' '.$working.'
            </div>';
          } else {
            echo '<div class="col-md-12 py-3">
              '.$row['name'].' '.$working.'
            </div>';
          }
        }
      }
    }

    $prepare->close();
  }

  public function deleteUser($db){
    if(isset($_GET['deleteUser'])){
      $username = $_GET['deleteUser'];
      $empty = '';

      $query = "DELETE FROM users WHERE username=?";
      $prepare = $db->prepare($query);
      $prepare->bind_param("s",$username);
      $prepare->execute();
      $prepare->close();

      $query1 = "UPDATE objects SET deskfrom=? WHERE deskfrom=?";
      $prepare1 = $db->prepare($query1);
      $prepare1->bind_param("ss",$empty,$username);
      $prepare1->execute();
      $prepare1->close();

      header('location:index');
    }
  }

  public function message($db){
    if(isset($_POST['sendmsg'])){
      if(!empty($_POST['chatmsg'])){
        $sendby = $_SESSION['username'];
        $message = htmlspecialchars($_POST['chatmsg']);
        $date = date("d/m/Y H:i:s");

        $company = $_SESSION['company'];

        $query = "INSERT INTO `chat`(`sendby`, `message`, `date`, `company`) VALUES (?,?,?,?)";
        $prepare = $db->prepare($query);
        $prepare->bind_param("ssss",$sendby,$message,$date,$company);
        $prepare->execute();

        $prepare->close();
        header('location:chat');
      }
    }
  }

  public function messageCompany($db){
    if(isset($_POST['sendmsg'])){
      if(!empty($_POST['chatmsg'])){
        $sendby = $_SESSION['username'];
        $message = htmlspecialchars($_POST['chatmsg']);
        $date = date("d/m/Y H:i:s");

        $company = $_SESSION['company'];

        $query = "INSERT INTO `chat`(`sendby`, `message`, `date`, `company`) VALUES (?,?,?,?)";
        $prepare = $db->prepare($query);
        $prepare->bind_param("ssss",$sendby,$message,$date,$company);
        $prepare->execute();

        $prepare->close();
        header('location:companychat');
      }
    }
  }

  public function checkIfBuilder($db){
    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username=? AND permission='2'";
    $prepare = $db->prepare($query);
    $prepare->bind_param("s",$username);
    $prepare->execute();

    $result = $prepare->get_result();

    if($result->num_rows > 0){
      include 'inc/builder_menu.php';
    }

    $prepare->close();
  }

  public function checkForAdd($db){
    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username=? AND permission='2'";
    $prepare = $db->prepare($query);
    $prepare->bind_param("s",$username);
    $prepare->execute();

    $result = $prepare->get_result();

    if($result->num_rows > 0){
      echo '<div class="row">
        <div class="col-md-12">
              <form method="post">
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
                      <select name="permission" class="form-control">
                        <option value="1">Normal</option>
                        <option value="2">Admin</option>
                      </select>
                  </div>
                  <input type="submit" name="adduser" value="Add User" class="btn btn-success btn-block">
              </form>
        </div>
      </div>';
    }

    $prepare->close();
  }

  public function showEditProfile($db){
    $username = $_SESSION['username'];

    $query = 'SELECT * FROM users WHERE username=?';
    $prepare = $db->prepare($query);
    $prepare->bind_param('s',$username);
    $prepare->execute();

    $result = $prepare->get_result();

    if($result->num_rows > 0){
      $row = $result->fetch_assoc();

      echo '
      <form method="post">
        <label>Full Name</label>
        <input type="text" name="name" placeholder="Name" value="'.$row['name'].'" class="form-control mb-2">
        <label>Username</label>
        <input type="text" name="username" placeholder="Username" value="'.$_SESSION['username'].'" class="form-control mb-2">
        <label>Password</label>
        <input type="password" name="password" placeholder="New Password" class="form-control mb-2">
        <label>Repeat Password</label>
        <input type="password" name="password2" placeholder="Repeat New Password" class="form-control mb-3">
        <input type="submit" name="updateProfile" value="Update Profile" class="btn btn-success">
      </form>
      ';
    }

    $prepare->close();

  }

  public function updateProfile($db){
    if(isset($_POST['updateProfile'])){
      $username = $_POST['username'];
      $username_current = $_SESSION['username'];
      $name = $_POST['name'];
      $password = htmlspecialchars($_POST['password']);
      $password1 = htmlspecialchars($_POST['password1']);
      $password = hash("sha512",$password);

      if(empty($_POST['password'])){
        $query = 'UPDATE `users` SET `name`=?,`username`=? WHERE username=?';

        $prepare = $db->prepare($query);
        $prepare->bind_param('sss',$name,$username,$username_current);
        $prepare->execute();
        $prepare->close();
      } else {
        if($password === $password1){
          $query = 'UPDATE `users` SET `name`=?,`username`=?,`password`=? WHERE username=?';
          $prepare->bind_param('ssss',$name,$username,$password,$username_current);
          $prepare->execute();
          $prepare->close();
        }
      }

      header('location:index');

    }
  }
}

?>
