<?php
#for loading objects

class objects {
  public function ifUpdateObject(){

    if(isset($_GET['updateObject'])){

      header('location:index?builder');


    }

  }

  function getObjects($db){
    $username = $_SESSION['username'];
    $company = $_SESSION['company'];

    $query = "SELECT * FROM `objects` WHERE company=? ORDER BY `object_y` ASC";
    $prepare = $db->prepare($query);
    $prepare->bind_param("s",$company);
    $prepare->execute();

    $result = $prepare->get_result();

    $query1 = "SELECT * FROM users WHERE username=? AND permission='2'";
    $prepare1 = $db->prepare($query1);
    $prepare1->bind_param("s",$username);
    $prepare1->execute();

    $result1 = $prepare1->get_result();

    $row1 = $result1->fetch_assoc();

    if($result1->num_rows > 0){
      $permission = $row1['permission'];
    } else {
      $permission = 0;
    }

    $zIndex = 1;

    $objects = new Objects;

    if($result->num_rows > 0){
      while ($row = $result->fetch_assoc()) {
        $x = $row['object_x'];
        $y = $row['object_y'];
        $z = $zIndex;

        $obj = $objects->checkObject($row['objectid'],$x,$y,$z,$permission,$row['id'],$db);

        echo $obj;

        $zIndex++;
      }
    }

    $prepare->close();
    $prepare1->close();
  }

  function updateObject($db){
    if(isset($_GET['updateObject'])){
      $id = $_GET['id'];
      $x = $_GET['object_x'];
      $y = $_GET['object_y'];

      $query = "UPDATE `objects` SET `object_x`=?,`object_y`=? WHERE `id`=?";

      $prepare = $db->prepare($query);
      $prepare->bind_param("iii",$x,$y,$id);
      $prepare->execute();

      $prepare->close();
      //header('location:index?builder');
    }
  }

  function deleteObject($db){
    if(isset($_POST['deleteObject'])){
      $id = $_POST['id'];

      $query = "DELETE FROM objects WHERE `id`=?";

      $prepare = $db->prepare($query);
      $prepare->bind_param("i",$id);
      $prepare->execute();

      $prepare->close();
      header('location:index?builder');
    }
  }

  function asignDesk($db){
    if(isset($_POST['asignDesk'])){
      $id = $_POST['id'];
      $user = $_POST['asignUserDesk'];

      $query = "UPDATE `objects` SET `deskfrom` = ? WHERE `id`=?";

      $prepare = $db->prepare($query);
      $prepare->bind_param("si",$user,$id);
      $prepare->execute();

      $prepare->close();

      header('location:index');
    }
  }

  #objects loader
  function checkIfBuilderActive($id,$x,$y,$zPopover){
    $obj = '<div class="object-popover text-center" style="position:fixed;z-index:'.$zPopover.'!important;" id="mover'.$id.'" onmouseleave="closeMoveMenu('.$id.');">
      <form method="post" style="display:inline-block;vertical-align:top;">
        <input type="hidden" name="id" value="'.$id.'">
        <input type="submit" class="btn btn-danger" name="deleteObject" value="Delete This Object">
      </form>
    </div>
    <script>

    document.getElementById("obj"+'.$id.').ondblclick = function(){
      var object = document.getElementById("obj'.$id.'");
      var objectX = "";
      var objectY = "";
      var baseplate = document.getElementById("baseplate");
      var canmove = true;

      document.getElementById("obj"+'.$id.').onmousemove = function(){
        if(canmove === true){
          object.style.left = event.pageX - baseplate.offsetLeft - object.offsetWidth / 2 + "px";
          object.style.top = event.pageY - baseplate.offsetTop - object.offsetHeight / 2 + "px";

          object.style.opacity = 0.3;
          object.style.transition = "0s";
          object.style.zIndex = 10000000000000;

          objectX = event.pageX - baseplate.offsetLeft - object.offsetWidth / 2 + "px";
          objectY = event.pageY - baseplate.offsetTop - object.offsetHeight / 2 + "px";
        }
      }

      document.getElementById("obj"+'.$id.').onmouseup = function(){
        object.style.opacity = 1;

        setTimeout(function(){
          window.location.href="?id='.$id.'&object_x="+objectX+"&object_y="+objectY+"&updateObject=Confirm&builder";
        },100,objectX,objectY);

      }
    }
    </script>';

    return $obj;
  }

  function standardObjectFunc($objId,$x,$y,$z,$permission,$id,$db,$img,$height,$kind){
    $query = "SELECT * FROM objects WHERE id=?";
    $prepare = $db->prepare($query);
    $prepare->bind_param("i",$id);
    $prepare->execute();

    $result = $prepare->get_result();

    $row = $result->fetch_assoc();

    $obj = '<div class="object" id="obj'.$row['id'].'" style="position:absolute;left:'.$x.'px;top:'.$y.'px;z-index:'.$z.';"  onclick="openMoveMenu('.$id.')" draggable="false"><div class="round-pop"></div>';

    $zPopover = 10000000 - $z;

    $objects = new objects;

    if($permission === 2 && isset($_GET['builder'])){

      $id = $row['id'];
      $x = $row['object_x'];
      $y = $row['object_y'];

      $obj .= $objects->checkIfBuilderActive($id,$x,$y,$zPopover);
    }

    $obj .= $objects->objectMenu($kind,$id,$db,$permission);

    $obj .= '
    <img style="height:'.$height.';" src="img/'.$img.'">
    </div>';
    return $obj;

    $prepare->close();
    $prepare1->close();
  }

  function objectMenu($kind,$id,$db,$permission){
    $server = new Server;

    if($kind === 'server'){
      return '
      <div class="object-info" style="width:350px;left:calc(50% - 175px);line-height:30px;position:absolute;z-index:99999;">
        <h3 class="mb-2">Server</h3>
        '.$server->viewFiles($db).'
        <form method="post" enctype="multipart/form-data">
          <div class="custom-file text-left mt-1">
            <input type="file" name="serverFile" class="custom-file-input text-left" id="customFile">
            <label class="custom-file-label" for="customFile">Choose file</label>
            <input type="submit" value="Upload File" name="uploadServerFile" class="btn btn-success btn-block mt-2 mb-2">
          </div>
        </form>
      </div>
      ';
    }

    if($kind === 'coffee'){
      $username = $_SESSION['username'];

      $query = "SELECT * FROM users WHERE username=?";
      $prepare = $db->prepare($query);
      $prepare->bind_param("s",$username);
      $prepare->execute();

      $result = $prepare->get_result();

      $row = $result->fetch_assoc();

      if($row['working'] === 1){
        return '
        <div class="object-info" style="line-height:30px;">
          <h3 class="mb-2">Coffee bar</h3>
          Tired of working?<br>
          <a href="?startBreak" class="btn btn-success btn-block mt-2">Take a break</a>
        </div>
        ';
      } else {
        return '
        <div class="object-info" style="line-height:30px;">
          <h3 class="mb-2">Coffee bar</h3>
          Ready to work again?
          <a href="?stopBreak" class="btn btn-success btn-block mt-2">Start working</a>
        </div>
        ';
      }
    }

    if($kind === "desk"){
      $query = "SELECT * FROM objects WHERE id=?";
      $prepare = $db->prepare($query);
      $prepare->bind_param("i",$id);
      $prepare->execute();

      $result = $prepare->get_result();

      $row = $result->fetch_assoc();

      if($row['deskfrom'] !== ""){
        $deskfrom = $row['deskfrom'];

        $query3 = "SELECT * FROM users WHERE username=?";
        $prepare3 = $db->prepare($query3);
        $prepare3->bind_param("s",$deskfrom);
        $prepare3->execute();

        $result3 = $prepare3->get_result();

        $row3 = $result3->fetch_assoc();
        $return = '';

        if($row3['working'] === 1){
          $return .= '<div class="greenbubble"></div>';
        }

        if($row3['working'] === 2){
          $return .= '<div class="orangebubble"></div>';
        }

        if($row['deskfrom'] === $_SESSION['username']){
          $return .= '
          <div class="object-info">
            <h3 class="mb-2">Desk</h3>
            This desk is from <b>you</b>
          </div>
          ';
        } else {
          $return .= '
          <div class="object-info">
            <h3 class="mb-2">Desk</h3>
            This desk is from <b>'.$row['deskfrom'].'</b>
          </div>
          ';
        }

        $prepare3->close();

        return $return;

      } else {
        if($permission === 2){
          $username = $_SESSION['username'];

          $query1 = "SELECT * FROM users WHERE username=?";
          $prepare1 = $db->prepare($query1);
          $prepare1->bind_param("s",$username);
          $prepare1->execute();

          $result1 = $prepare1->get_result();

          $row1 = $result1->fetch_assoc();

          $company = $row1['company'];

          $query2 = "SELECT username FROM users WHERE company=?";
          $prepare2 = $db->prepare($query2);
          $prepare2->bind_param("s",$company);
          $prepare2->execute();

          $result2 = $prepare2->get_result();

          $total = '<div class="object-info">
            <h3 class="mb-2">Desk</h3>
            <div style="mb-3">Assign desk to</div>
            <form method="post">
              <div class="form-group mt-2" style="margin-bottom:10px!important;">
                <select name="asignUserDesk" class="form-control">';

                  while($row2 = $result2->fetch_assoc()){
                    $total .= '<option value="'.$row2['username'].'">'.$row2['username'].'</option>';
                  }
                $total .= '
                </select>
              </div>

              <div class="form-group mt-0 mb-0">
                <input type="hidden" name="id" value="'.$id.'">
                <input type="submit" name="asignDesk" value="Assign Desk To User" class="btn btn-success btn-block mt-0">
              </div>
            </form>
          </div>
          ';
          $prepare1->close();
          $prepare2->close();

          return $total;
        }
      }

      $prepare->close();
    }
  }

  #for loading objects
  function checkObject($objId,$x,$y,$z,$permission,$id,$db){
    switch ($objId) {
      case '1':
        echo objects::standardObjectFunc($objId,$x,$y,$z,$permission,$id,$db,"wooddesk_occupied.png","130px","desk");
        break;

      case '2':
        echo objects::standardObjectFunc($objId,$x,$y,$z,$permission,$id,$db,"wooddesk_occupied_r.png","130px","desk");
        break;

      case '3':
        echo objects::standardObjectFunc($objId,$x,$y,$z,$permission,$id,$db,"plasticdesk_occupied.png","130px","desk");
        break;

      case '4':
        echo objects::standardObjectFunc($objId,$x,$y,$z,$permission,$id,$db,"plasticdesk_occupied_r.png","130px","desk");
        break;

      case '5':
        echo objects::standardObjectFunc($objId,$x,$y,$z,$permission,$id,$db,"deco_cactus.png","80px","");
        break;

      case '6':
        echo objects::standardObjectFunc($objId,$x,$y,$z,$permission,$id,$db,"deco_tree.png","100px","");
        break;

      case '7':
        echo objects::standardObjectFunc($objId,$x,$y,$z,$permission,$id,$db,"divider_w_l.png","100px","");
        break;

      case '8':
        echo objects::standardObjectFunc($objId,$x,$y,$z,$permission,$id,$db,"divider_w_r.png","100px","");
        break;

      case '9':
        echo objects::standardObjectFunc($objId,$x,$y,$z,$permission,$id,$db,"divider_l.png","100px","");
        break;

      case '10':
        echo objects::standardObjectFunc($objId,$x,$y,$z,$permission,$id,$db,"divider_r.png","100px","");
        break;

      case '11':
        echo objects::standardObjectFunc($objId,$x,$y,$z,$permission,$id,$db,"small_table.png","75px","");
        break;

      case '12':
        echo objects::standardObjectFunc($objId,$x,$y,$z,$permission,$id,$db,"w_small_table.png","75px","");
        break;

      case '13':
        echo objects::standardObjectFunc($objId,$x,$y,$z,$permission,$id,$db,"coffee_bar_1_right.png","130px","coffee");
        break;

      case '14':
        echo objects::standardObjectFunc($objId,$x,$y,$z,$permission,$id,$db,"coffee_bar_1_left.png","130px","coffee");
        break;

      case '15':
        echo objects::standardObjectFunc($objId,$x,$y,$z,$permission,$id,$db,"coffee_bar_2_right.png","130px","coffee");
        break;

      case '16':
        echo objects::standardObjectFunc($objId,$x,$y,$z,$permission,$id,$db,"coffee_bar_2_left.png","130px","coffee");
        break;

      case '17':
        echo objects::standardObjectFunc($objId,$x,$y,$z,$permission,$id,$db,"server.png","140px","server");
        break;

      case '18':
        echo objects::standardObjectFunc($objId,$x,$y,($z-2),$permission,$id,$db,"tile.png","80px","");
        break;

      case '19':
        echo objects::standardObjectFunc($objId,$x,$y,($z-2),$permission,$id,$db,"tile5.png","120px","");
        break;

      case '20':
        echo objects::standardObjectFunc($objId,$x,$y,$z,$permission,$id,$db,"meeting_table_left.png","150px","");
        break;

      case '21':
        echo objects::standardObjectFunc($objId,$x,$y,$z,$permission,$id,$db,"meeting_table_right.png","150px","");
        break;

      default:
        // code...
        break;
    }
  }
}


?>
