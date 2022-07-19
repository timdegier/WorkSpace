<?php

// Upload, view and delete server files

class Server {

  public function viewFiles($db){
    $username = $_SESSION['username'];
    $company = $_SESSION['company'];

    $query = 'SELECT * FROM server WHERE company = ?';

    $prepare = $db->prepare($query);
    $prepare->bind_param('s',$company);
    $prepare->execute();

    $result = $prepare->get_result();

    $prepare->close();

    if($result->num_rows > 0){
      $return = '';
      while ($row = $result->fetch_assoc()) {
        $return .= '<div class="my-1">'.htmlspecialchars($row['name']).' | <a href="'.$row['file'].'" class="btn btn-success btn-sm mr-2" download>Get</a><form method="post" class="d-inline-block"><input type="hidden" name="fileId" value="'.$row['id'].'"><input class="btn btn-danger btn-sm" type="submit" name="deleteFile" value="Delete"></form></div>';
      }
      return $return;
    } else {
      return 'No files found, upload one here.';
    }

  }

  public function deletFile($db){
    if(isset($_POST['deleteFile'])){
      $fileId = $_POST['fileId'];

      $query = 'DELETE FROM server WHERE id = ?';

      $prepare = $db->prepare($query);
      $prepare->bind_param('s',$fileId);
      $prepare->execute();

      $prepare->close();

      header('location:index');
    }
  }

  public function addFile($db){
    if(isset($_POST['uploadServerFile'])){
      if(isset($_FILES['serverFile'])){
        if($_FILES['serverFile']['name'] !== ''){
          $real_file_name = $_FILES['serverFile']['name'];

          $file_name = bin2hex(rand(1000,9999)) . $_FILES['serverFile']['name'];
          $file_tmp = $_FILES['serverFile']['tmp_name'];

          $file_loc = 'uploads/' . $file_name;

          move_uploaded_file($file_tmp,$file_loc);

          $username = $_SESSION['username'];

          $query1 = "SELECT * FROM users WHERE username=?";
          $prepare1 = $db->prepare($query1);
          $prepare1->bind_param("s",$username);
          $prepare1->execute();

          $result1 = $prepare1->get_result();

          $row1 = $result1->fetch_assoc();

          $prepare1->close();

          $company = $row1['company'];
          $date = date('d/m/Y H:i');
          $permission = 2;

          $query = 'INSERT INTO `server`(`name`, `owner`, `company`, `date`, `permission`, `file`) VALUES (?,?,?,?,?,?)';

          $prepare = $db->prepare($query);
          $prepare->bind_param("ssssis",$real_file_name,$username,$company,$date,$permission,$file_loc);
          $prepare->execute();

          $prepare->close();

          header('location:index');

        }
      }





    }
  }

}


?>
