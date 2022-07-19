<?php

require 'php/index.php';
require 'php/classes/database.php';
require 'php/classes/login.php';
require 'php/classes/objects.php';
require 'php/classes/baseplate.php';
require 'php/classes/users.php';
require 'php/classes/work.php';

$login = new Login;
$login->userlogin($db);

?>
