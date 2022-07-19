<?php

require 'php/index.php';
require 'php/classes/database.php';
require 'php/classes/login.php';
require 'php/classes/server.php';
require 'php/classes/objects.php';
require 'php/classes/baseplate.php';
require 'php/classes/users.php';
require 'php/classes/work.php';
require 'php/classes/updates.php';
require 'php/classes/development.php';
require 'php/classes/builder.php';
require 'php/classes/shop.php';

$login = new Login($db);
$login->goToLogin();

$builder = new builder;

$devmode = new devmode;
$devmode->devmode();

$baseplate = new baseplate;
$baseplate->getBasePlate($db);

$working = new working;
$working->startWorking($db);
$working->stopWorking($db);
$working->startBreak($db);
$working->stopBreak($db);

$users = new users;
$users->message($db);
$users->addUser($db);
$users->deleteUser($db);
$users->updateProfile($db);

$objects = new objects;
$objects->ifUpdateObject();
$objects->updateObject($db);
$objects->deleteObject($db);
$objects->asignDesk($db);

$updates = new updates;
$updates->getUpdate();

$server = new server;
$server->deletFile($db);
$server->addFile($db);

$shop = new Shop;

?>
