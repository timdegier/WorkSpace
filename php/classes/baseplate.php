<?php

class baseplate {
  public function getBasePlate($db){
    $user = $_SESSION['username'];
    $company = $_SESSION['company'];

    $query = "SELECT * FROM companies WHERE name=?";
    $prepare = $db->prepare($query);
    $prepare->bind_param("s",$company);
    $prepare->execute();

    $result = $prepare->get_result();

    $row = $result->fetch_assoc();

    $GLOBALS['baseplateType'] = $row['baseplate'];

    $prepare->close();
  }

  public function launchBasePlate($baseplateType){
    switch ($baseplateType) {
      case '1':
        echo '<div class="baseplate" id="baseplate" style="position:relative;"><!--baseplate-->';
        break;

      case '2':
        echo '<div class="baseplate-small" id="baseplate" style="position:relative;"><!--baseplate-->';
        break;

      default:
        // code...
        break;
    }
  }
}

?>
