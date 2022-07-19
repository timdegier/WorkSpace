<?php include 'php/loaders/game.php'; ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Create your office here. Forget about traffic jams and wasting money. VirtualOffice is here!">
    <link rel="stylesheet" href="css/style.css">
    <?php $builder->builderCss(); ?>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

    <script src="https://www.paypal.com/sdk/js?client-id=AZXbELN_WS7qCHzjdK-EM-tg3HLjvTIDFkmshc-UrXIH98-ZAOEbDOfeqi0uSzsyLcGGbp2cTXADPn-r&disable-funding=credit,card,sofort&currency=EUR"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.</script>

    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <title>WorkSpace - My Company</title>

  </head>

  <body>
    <?php include 'inc/main-menu.php'; ?>

    <?php $users->checkIfBuilder($db); ?>

    <?php $baseplate->launchBasePlate($baseplateType); ?>
      <?php $objects->getObjects($db); ?>
    </div>

    <?php include 'inc/right-menu.php'; ?>

    <div class="footer">
      &copy; <?php echo date('Y'); ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="js/main.js" charset="utf-8"></script>
    <?php $builder->autoBuilderMenu(); ?>
  </body>

</html>
