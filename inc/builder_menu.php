<?php
  $builder = new builder;
  $builder->addObject($db);
?>

<div class="menu-left" id="menu-left">
  <div class="menu-left-content" id="menu-left-content">
    <button class="btn btn-success btn-menu-open" name="button" style="position:relative;right:-220px;" id="display-btn-left" onclick="openMenuLeft()">Open Build Menu</button>
    <script type="text/javascript">
      function openMenuLeft(){
        document.getElementById("menu-left").style.left = "10px";
        document.getElementById("display-btn-left").style.display = "none";
      }
    </script>

    <style media="screen">
      .builder-item {
        background-color: #fff;
        border-radius: 10px;
        padding: 10px;
        border: 1px solid #eee;
        margin: 5px;
      }

      .builder-col {
        position: relative;
      }
    </style>

    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center">Build Menu</h1>
      </div>
    </div>

    <div class="row text-center"><!--build-->
      <div class="col-md-12">
        <div class="line"></div>
      </div>

      <div class="col-md-12">
        <?php
        if(!isset($_GET['builder'])){
          echo '<a href="?builder" class="btn btn-success btn-block">Start Building</a>';
        } else {
          echo '<a href="index" class="btn btn-danger btn-block">Stop Building</a>';
        }
        ?>
      </div>

      <div class="col-md-12">
        <div class="line"></div>
      </div>

      <div class="col-md-6 builder-col">
        <div class="builder-item" style="max-height: 200px;">
          <img src="img/wooddesk_occupied.png" style="height:100px; margin:auto; display:block;">
        </div>

        <div class="popup-right">
          <h3>Desk</h3>
          <div style="text-align:center;border-radius:10px;background: #eee;padding:10px;margin:10px 0;">
            <img src="img/wooddesk_occupied.png" style="height:100px; margin:auto;margin-right:10px;">
            <img src="img/wooddesk_occupied_r.png" style="height:100px; margin:auto;margin-right:10px;">
            <img src="img/plasticdesk_occupied.png" style="height:100px; margin:auto;margin-right:10px;">
            <img src="img/plasticdesk_occupied_r.png" style="height:100px; margin:auto;">
          </div>

          <p>A desk to assign to one of your employees or yourself. Comes with a nice handcrafted piece of wood.</p>
          <a href="?addObject=1&builder" class="btn btn-primary btn-block" style="margin-bottom:10px;">Insert Wooden Desk</a>
          <a href="?addObject=2&builder" class="btn btn-primary btn-block" style="margin-bottom:10px;">Insert Wooden Desk R</a>
          <a href="?addObject=3&builder" class="btn btn-primary btn-block" style="margin-bottom:10px;">Insert White Desk</a>
          <a href="?addObject=4&builder" class="btn btn-primary btn-block">Insert White Desk R</a>
        </div>
      </div>

      <div class="col-md-6 builder-col">
        <div class="builder-item" style="max-height: 200px;">
          <img src="img/deco_cactus.png" style="height:100px; margin:auto; display:block;">
        </div>

        <div class="popup-right">
          <h3>Cactus</h3>
          <div style="text-align:center;border-radius:10px;background: #eee;padding:10px;margin:10px 0;">
            <img src="img/deco_cactus.png" style="height:100px; margin:auto;">
          </div>

          <p>Decorate your office to look like it's on with the business.</p>
          <a href="?addObject=5&builder" class="btn btn-primary btn-block">Place A Cactus</a>
        </div>
      </div>

      <div class="col-md-6 builder-col">
        <div class="builder-item" style="max-height: 200px;">
          <img src="img/deco_tree.png" style="height:100px; margin:auto; display:block;">
        </div>

        <div class="popup-right">
          <h3>Tree</h3>
          <p>Make your office stunning by planting one tree and saving the virtual environment.</p>
          <a href="?addObject=6&builder" class="btn btn-primary btn-block">Place A Tree</a>
        </div>
      </div>

      <div class="col-md-6 builder-col">
        <div class="builder-item" style="max-height: 200px;">
          <img src="img/divider_w_l.png" style="height:100px; margin:auto; display:block;">
        </div>

        <div class="popup-right">
          <h3>Divider</h3>
          <div style="text-align:center;border-radius:10px;background: #eee;padding:10px;margin:10px 0;">
            <img src="img/divider_w_l.png" style="height:100px; margin:auto;margin-right:10px;">
            <img src="img/divider_w_r.png" style="height:100px; margin:auto;margin-right:10px;">
            <img src="img/divider_l.png" style="height:100px; margin:auto;margin-right:10px;">
            <img src="img/divider_r.png" style="height:100px; margin:auto;">
          </div>
          <p>Divide your office and create a personal little place for you.</p>
          <a href="?addObject=7&builder" class="btn btn-primary btn-block" style="margin-bottom:10px;">Place A White Divider (R)</a>
          <a href="?addObject=8&builder" class="btn btn-primary btn-block" style="margin-bottom:10px;">Place A White Divider (L)</a>
          <a href="?addObject=9&builder" class="btn btn-primary btn-block" style="margin-bottom:10px;">Place A Divider (R)</a>
          <a href="?addObject=10&builder" class="btn btn-primary btn-block">Place A Divider (L)</a>
        </div>
      </div>

      <div class="col-md-6 builder-col">
        <div class="builder-item" style="max-height: 200px;">
          <img src="img/small_table.png" style="height:100px; margin:auto; display:block;">
        </div>

        <div class="popup-right">
          <h3>Small table</h3>
          <div style="text-align:center;border-radius:10px;background: #eee;padding:10px;margin:10px 0;">
            <img src="img/small_table.png" style="height:100px; margin:auto;margin-right:10px;">
            <img src="img/w_small_table.png" style="height:100px; margin:auto;">
          </div>
          <p>A small table to decorate your office, very handy ofcourse.</p>
          <a href="?addObject=11&builder" class="btn btn-primary btn-block" style="margin-bottom:10px;">Place Table</a>
          <a href="?addObject=12&builder" class="btn btn-primary btn-block">Place White Table</a>
        </div>
      </div>

      <div class="col-md-6 builder-col">
        <div class="builder-item" style="max-height: 200px;">
          <img src="img/coffee_bar_1_right.png" style="height:100px; margin:auto; display:block;">
        </div>

        <div class="popup-right">
          <h3>Coffee bar</h3>
          <div style="text-align:center;border-radius:10px;background: #eee;padding:10px;margin:10px 0;">
            <img src="img/coffee_bar_1_right.png" style="height:100px; margin:auto;margin-right:10px;">
            <img src="img/coffee_bar_2_left.png" style="height:100px; margin:auto;margin:auto;">
          </div>
          <p>Take a break, get some coffee and relax!</p>
          <a href="?addObject=13&builder" class="btn btn-primary btn-block" style="margin-bottom:10px;">Place coffee bar 1 (R)</a>
          <a href="?addObject=14&builder" class="btn btn-primary btn-block" style="margin-bottom:10px;">Place coffee bar 1 (L)</a>
          <a href="?addObject=15&builder" class="btn btn-primary btn-block" style="margin-bottom:10px;">Place coffee bar 2 (R)</a>
          <a href="?addObject=16&builder" class="btn btn-primary btn-block">Place coffee bar 2 (L)</a>
        </div>
      </div>

      <div class="col-md-6 builder-col">
        <div class="builder-item" style="max-height: 200px;">
          <img src="img/server.png" style="height:100px; margin:auto; display:block;">
        </div>

        <div class="popup-right">
          <h3>Server rack</h3>
          <div style="text-align:center;border-radius:10px;background: #eee;padding:10px;margin:10px 0;">
            <img src="img/server.png" style="height:100px; margin:auto;margin:auto;">
          </div>
          <p>Store all your favorite documents in here. At least if you want.</p>
          <a href="?addObject=17&builder" class="btn btn-primary btn-block" style="margin-bottom:10px;">Place server</a>
        </div>
      </div>

      <div class="col-md-6 builder-col">
        <div class="builder-item" style="height:120px;">
          <img src="img/tile.png" style="width:100px; margin: 10px auto; display:block;">
        </div>

        <div class="popup-right">
          <h3>Tile</h3>
          <div style="text-align:center;border-radius:10px;background: #eee;padding:10px;margin:10px 0;">
            <img src="img/tile.png" style="width:100px; margin:auto;margin-right:10px;">
            <img src="img/tile5.png" style="width:100px; margin:auto;margin:auto;">
          </div>

          <p>EXPAND! Expand your business floor!</p>
          <a href="?addObject=18&builder" class="btn btn-primary btn-block" style="margin-bottom:10px;">Place Tile (3)</a>
          <a href="?addObject=19&builder" class="btn btn-primary btn-block">Place Tile (5)</a>
        </div>
      </div>

      <div class="col-md-6 builder-col">
        <div class="builder-item" style="height:120px;">
          <img src="img/meeting_table_left.png" style="width:100px; margin: 10px auto; display:block;">
        </div>

        <div class="popup-right">
          <h3>Meeting Table</h3>
          <div style="text-align:center;border-radius:10px;background: #eee;padding:10px;margin:10px 0;">
            <img src="img/meeting_table_left.png" style="width:100px; margin:auto;margin-right:10px;">
            <img src="img/meeting_table_right.png" style="width:100px; margin:auto;margin:auto;">
          </div>

          <p>Meetings on a large table, not much more.</p>
          <a href="?addObject=20&builder" class="btn btn-primary btn-block" style="margin-bottom:10px;">Place Table (L)</a>
          <a href="?addObject=21&builder" class="btn btn-primary btn-block">Place Table (R)</a>
        </div>
      </div>
    </div>

    <script type="text/javascript">
    var scroll = 0;

    function closeMenuLeft(){
      document.getElementById("menu-left").style.left = "-330px";
      document.getElementById("display-btn-left").style.display = "block";
      scroll = 0;
      document.getElementById('menu-left-content').style.marginTop = '0'+'px';
      document.getElementById("menu-left").style.top = "10px";
      document.getElementById("menu-left").style.height = "calc(100vh - 20px)";
      document.getElementById("menu-left").style.width = "330px";
      document.getElementById("menu-left").style.borderRadius = "5px";
    }

    function scrollMenuUp(){
      if(scroll < 0){
        scroll += 300;
        document.getElementById('menu-left-content').style.marginTop = scroll+'px';
      }
    }

    function scrollMenuDown(){
      scroll -= 300;
      document.getElementById('menu-left-content').style.marginTop = scroll+'px';
    }
    </script>

    <div class="row text-center">
      <div style="position: fixed; bottom: 20px; margin-left: 175px; width: 135px; padding: 27px 10px; background-color: #f9f9f9; border: 1px solid #eee; border-radius: 5px;">
        <a onclick="scrollMenuUp()" class="scrollup">Scroll up</a>

        <a onclick="scrollMenuDown()" class="scrolldown">Scroll down</a>
      </div>
      <button class="btn btn-danger" onclick="closeMenuLeft();" style="position:fixed; bottom:20px;z-index:9999;margin-left:0px;">Close Menu</button>
    </div>
  </div>
</div>
