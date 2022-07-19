<div class="menu-right" id="menu-right">
  <div class="inside">
    <button class="btn btn-success btn-menu-open" name="button" style="position:relative;left:-150px;" id="display-btn-right" onclick="openMenuRight()">Open Menu</button>

    <div class="row">
      <div class="col-md-12">
        <h1 style="margin: 0px; padding: 0px;" class="text-center">Small Menu</h1>
      </div>
    </div>

    <div class="line"></div>

    <div class="bigger-menu p-2 py-4 rounded" style="background:#eee;">
      <span class="p-3 h5">Main Menu</span>
      <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#main-menu" style="position:relative;top:-6px;right:10px;">
        Open
      </button>
    </div>

    <div class="line"></div>

    <div class="row">
      <?php $working->toggleWorking($db); ?>
    </div>

    <div class="line"></div>

    <div class="row"><!--users-->
      <?php $users->showUsers($db); ?>
    </div>

    <div class="line"></div>

    <div class="row"><!--chat-->
      <div class="col-md-12" style="padding: 0;margin-bottom: 15px;">
        <div class="card">
          <div class="card-body">
            <div id="chatinside"></div>
          </div>

          <iframe src="inc/chat.php" style="border: 0px;overflow:hidden;height:110px;"></iframe>
        </div>
      </div>
    </div>



    <div class="row text-center" style="margin-bottom:10px;">
      <div class="col-md-5">
        <a href="logout"><button class="btn btn-warning">Logout</button></a>
      </div>

      <div class="col-md-7">
        <button class="btn btn-danger" onclick="closeMenuRight();">Close Menu</button>
        <script type="text/javascript">
        document.getElementById('menu-right').style.right = "10px";
        document.getElementById('display-btn-right').style.display = "none";

        function openMenuRight(){
          document.getElementById('menu-right').style.right = "10px";
          document.getElementById('display-btn-right').style.display = "none";
        }

        function closeMenuRight(){
          document.getElementById('menu-right').style.right = "-340px";
          document.getElementById('display-btn-right').style.display = "block";
        }
        </script>
      </div>
    </div>
  </div>
</div>
