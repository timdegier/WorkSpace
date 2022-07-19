<?php

require 'php/index.php';
include 'php/classes/database.php';
include 'php/classes/login.php';

$login = new Login;
$login->register($db);

?>
