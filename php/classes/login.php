<?php

class Login {

  public function goToLogin(){
    if(!isset($_SESSION['username'])){
      header('location:login');
    }
  }

  public function userlogin($db){
    if(isset($_POST['login'])){
      $username = $_POST['username'];
      $password = $_POST['password'];
      $password = hash("sha512",$password);
      $company = $_POST['company'];

      $query = "SELECT * FROM users WHERE username=? AND password=? AND company=?";
      $prepare = $db->prepare($query);
      $prepare->bind_param("sss",$username,$password,$company);
      $prepare->execute();

      $result = $prepare->get_result();

      if($result->num_rows > 0){

        $row = $result->fetch_assoc();

        $_SESSION['username'] = $username;
        $_SESSION['company'] = $company;
        $_SESSION['permission'] = $row['permission'];

        header('location:index');
      } else {
        $GLOBALS['error'] = 'Username or password is not correct.';
      }
      $prepare->close();
    }
  }

  public function register($db){
    if(isset($_POST['register'])){
      $name = htmlspecialchars($_POST['name']);
      $username = htmlspecialchars($_POST['username']);
      $password = htmlspecialchars($_POST['password']);
      $password = hash("sha512", $password);
      $company = htmlspecialchars($_POST['company']);
      $baseplate = htmlspecialchars($_POST['baseplate']);
      $permission = 2;
      $working = 0;

      if(!empty($name) && !empty($username) && !empty($password) && !empty($company) && !empty($baseplate)) {
        $query1 = "SELECT * FROM users WHERE username = ?";
        $prepare1 = $db->prepare($query1);
        $prepare1->bind_param("s",$username);
        $prepare1->execute();

        $result1 = $prepare1->get_result();

        if($result1->num_rows == 0){

          $query3 = "SELECT * FROM companies WHERE name = ?";
          $prepare3 = $db->prepare($query3);
          $prepare3->bind_param("s",$company);
          $prepare3->execute();

          $result3 = $prepare3->get_result();

          if ($result3->num_rows == 0) {
            $query = "INSERT INTO `users`(`name`, `username`, `password`, `permission`, `company`, `working`) VALUES (?,?,?,?,?,?);";
            $prepare = $db->prepare($query);
            $prepare->bind_param("sssisi",$name,$username,$password,$permission,$company,$working);
            $prepare->execute();

            $prepare->close();

            $query2 = "INSERT INTO `companies`(`name`, `creator`, `baseplate`) VALUES (?,?,?);";
            $prepare2 = $db->prepare($query2);
            $prepare2->bind_param("ssi",$company,$name,$baseplate);
            $prepare2->execute();

            $result = $prepare->get_result();

            $_SESSION['username'] = $username;
            $_SESSION['company'] = $company;
            $_SESSION['permission'] = $permission;

            $prepare2->close();

            header('location:index');

          } else {

            $GLOBALS['error'] = 'Company already exists.';

          }

          $prepare3->close();

          $prepare1->close();

        } else {

          $GLOBALS['error'] = 'User already exists';

          $prepare1->close();

        }
      } else {
        $GLOBALS['error'] = 'Please fill in all fields.';
      }
    }
  }
}

?>
