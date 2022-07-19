<?php

class working {
  public function toggleWorking($db){
    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username=?";
    $prepare = $db->prepare($query);
    $prepare->bind_param("s",$username);
    $prepare->execute();

    $result = $prepare->get_result();

    $row = $result->fetch_assoc();

    if($row['working'] === 0){
      echo '<a href="?startWorking" class="btn btn-block btn-success">Start working</a>';
    } else {
      echo '<a href="?stopWorking" class="btn btn-block btn-danger">Stop working</a>';
    }

    $prepare->close();
  }

  public function startWorking($db){
    if(isset($_GET['startWorking'])){
      $username = $_SESSION['username'];
      $working = 1;

      $query1 = "UPDATE users SET working=? WHERE username=?";
      $prepare1 = $db->prepare($query1);
      $prepare1->bind_param("is",$working,$username);
      $prepare1->execute();

      $prepare1->close();

      $message = $username . ' has started working';
      $game = 'Game';
      $date = date("d/m/Y H:i:s");

      $company = $_SESSION['company'];

      $query = "INSERT INTO `chat`(`sendby`, `message`, `date`, `company`) VALUES (?,?,?,?)";
      $prepare = $db->prepare($query);
      $prepare->bind_param("ssss",$game,$message,$date,$company);
      $prepare->execute();

      $prepare->close();

      header('location:index');
    }
  }

  public function stopWorking($db){
    if(isset($_GET['stopWorking'])){
      $username = $_SESSION['username'];
      $working = 0;

      $query1 = "UPDATE users SET working=? WHERE username=?";
      $prepare1 = $db->prepare($query1);
      $prepare1->bind_param("is",$working,$username);
      $prepare1->execute();

      $prepare1->close();

      $message = $username . ' stopped working';
      $game = 'Game';
      $date = date("d/m/Y H:i:s");

      $company = $_SESSION['company'];

      $query = "INSERT INTO `chat`(`sendby`, `message`, `date`, `company`) VALUES (?,?,?,?)";
      $prepare = $db->prepare($query);
      $prepare->bind_param("ssss",$game,$message,$date,$company);
      $prepare->execute();

      $prepare->close();
      header('location:index');
    }
  }

  public function startBreak($db){
    if(isset($_GET['startBreak'])){
      $username = $_SESSION['username'];
      $working = 2;

      $query1 = "UPDATE users SET working=? WHERE username=?";
      $prepare1 = $db->prepare($query1);
      $prepare1->bind_param("is",$working,$username);
      $prepare1->execute();

      $prepare1->close();

      $message = $username . ' is lazy, '.$username.' is taking a break.';
      $game = 'Game';
      $date = date("d/m/Y H:i:s");

      $company = $_SESSION['company'];

      $query = "INSERT INTO `chat`(`sendby`, `message`, `date`, `company`) VALUES (?,?,?,?)";
      $prepare = $db->prepare($query);
      $prepare->bind_param("ssss",$game,$message,$date,$company);
      $prepare->execute();

      $prepare->close();

      header('location:index');
    }
  }

  public function stopBreak($db){
    if(isset($_GET['stopBreak'])){
      $username = $_SESSION['username'];
      $working = 1;

      $query1 = "UPDATE users SET working=? WHERE username=?";
      $prepare1 = $db->prepare($query1);
      $prepare1->bind_param("is",$working,$username);
      $prepare1->execute();

      $prepare1->close();

      $message = $username . ' has started working again';
      $game = 'Game';
      $date = date("d/m/Y H:i:s");

      $company = $_SESSION['company'];

      $query = "INSERT INTO `chat`(`sendby`, `message`, `date`, `company`) VALUES (?,?,?,?)";
      $prepare = $db->prepare($query);
      $prepare->bind_param("ssss",$game,$message,$date,$company);
      $prepare->execute();

      $prepare->close();

      header('location:index');
    }
  }
}

?>
