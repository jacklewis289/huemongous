<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once("Models/LightData.php");


$view = new stdClass();
$view->pageTitle = 'Homepage';


if (isset($_POST["submitConnect"])) {
    setcookie("host", $_POST["host"], time() + (86400000 * 30), "/"); // 86400 = 1 day
    setcookie("username", $_POST["username"], time() + (86400000 * 30), "/"); // 86400 = 1 day
    header ("Location: ../light.php?light=1");
}


require_once("Views/index.phtml");

