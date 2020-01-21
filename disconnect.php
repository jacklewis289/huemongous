<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once("Models/LightData.php");

$view = new stdClass();
$view->pageTitle = 'Disconnect';

setcookie("host", "", time()-3600, "/");
setcookie("username", "", time()-3600, "/");

header("Location: index.php");
