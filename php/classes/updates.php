<?php

class updates {

  public function getUpdate(){

    $update = '
    <h2>Update Patch 0.0.01</h2>
    <div><img class="float-right my-2" src="img/0-0-01.png" height="130">
    New update is here fellas. We\'ve added servers and the ability to move your furniture around by simply dragging it. You can store documents, files and more in servers. We also added some new furiture like meeting tables, coffee cups and printers.
    </div>
    ';

    if(!isset($_COOKIE['update'])){
      if(isset($_SESSION['username'])){
        echo '<div class="update" id="updateScreen">
        '.$update.'
        <a onclick="updateScreenDown()" class="btn btn-success mt-2">Dismiss Message</a>
        <script>
          function updateScreenDown(){
            document.getElementById("updateScreen").style.opacity = 0;
            setTimeout(function(){
              window.location.href="index";
            },1000)
          }
        </script>
        </div>';
        setcookie('update','yes');
      }

    }

  }

}

?>
