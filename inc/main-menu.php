<div class="main-menu">
  <div class="modal fade" id="main-menu" tabindex="-1" aria-labelledby="main-menu" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row">
            <div class="col-3 border-right">
              <div class="nav flex-column nav-pills" id="nav" role="tablist" aria-orientation="vertical">
                <div class="row">
                  <div class="col-md-12 mt-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png" height="60" class="rounded d-inline-block mb-auto" style="position:relative;top:-20px;">
                    <div class="d-inline-block ml-2">
                      <h4 class="d-inline-block"><b><?= $_SESSION['username']; ?></b></h4>
                      <br>
                      You work at <b><?= $_SESSION['company']; ?></b>
                    </div>
                  </div>
                </div>

                <div class="line"></div>
                <a class="nav-link" id="chat-tab" data-toggle="pill" href="#chat" role="tab" aria-controls="chat" aria-selected="false">Company Chat</a>
                <a class="nav-link" id="profile-tab" data-toggle="pill" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Edit Profile</a>
                <?php if ($_SESSION['permission'] === 2): ?>
                  <a class="nav-link" id="settings-tab" data-toggle="pill" href="#settings" role="tab" aria-controls="settings" aria-selected="false">My Company</a>
                <?php endif; ?>

                <div class="line"></div>

                <button type="button" name="button" data-dismiss="modal" aria-label="Close" class="btn btn-dark btn-block">
                  Close menu
                </button>
              </div>
            </div>

            <div class="col-9">
              <div class="tab-content" id="nav">
                <div class="tab-pane fade show active" id="community" role="tabpanel" aria-labelledby="community-tab">
                  <h3>Community</h3>
                  <div>
                    Coming soon...
                  </div>
                </div>

                <div class="tab-pane fade show" id="shop" role="tabpanel" aria-labelledby="shop-tab">
                  <h3>Shop</h3>
                  <div>
                    <?php $shop->renderProducts($db); ?>
                  </div>
                </div>

                <div class="tab-pane fade h-100" id="chat" role="tabpanel" aria-labelledby="chat-tab" style="position:relative!important;">
                  <h3>Chat</h3>
                  <div style="height:500px;overflow:hidden;" id="companychat"></div>
                  <iframe src="inc/companychat.php" style="width:100%;border: 0px;overflow:hidden;height:50px;" class="align-bottom border-top pt-2"></iframe>
                </div>

                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <h3>Edit Profile</h3>
                  <div class="row">
                    <div class="col-md-6">
                      <?php $users->showEditProfile($db); ?>
                    </div>
                  </div>
                </div>

                <?php if ($_SESSION['permission'] === 2): ?>
                  <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                    <h3>Company Settings</h3>
                    <div class="line"></div>
                    <div class="row">
                      <div class="col-md-8">
                        <h4>All Users</h4>
                         <?php $users->showUsers($db); ?>
                      </div>

                      <div class="col-md-4">
                        <h4>Add User</h4>
                        <?php $users->checkForAdd($db); ?>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
