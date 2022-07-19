<?php

class builder {
  public function addObject($db){
    if(isset($_GET['addObject'])){
      $objectid = $_GET['addObject'];
      $username = $_SESSION['username'];
      $empty = '';

      $username = $_SESSION['username'];
      $company = $_SESSION['company'];

      $query = "INSERT INTO `objects`(`objectid`, `object_x`, `object_y`, `owner`, `deskfrom`, `company`) VALUES (?,'506','256',?,?,?)";
      $prepare = $db->prepare($query);
      $prepare->bind_param("ssss",$objectid,$username,$empty,$company);
      $prepare->execute();

      $prepare->close();

      echo '<script>window.location.href="?builder"</script>';
    }
  }

  public function builderCss(){
    if(isset($_GET['builder'])){
      echo '<link rel="stylesheet" href="css/builder.css">';
    }
  }

  public function autoBuilderMenu(){
    if(isset($_GET['builder'])){
      echo '
        <script>
        document.getElementById("menu-left").style.left = "10px";
        document.getElementById("display-btn-left").style.display = "none";
        </script>
      ';
    }
  }
}

?>
