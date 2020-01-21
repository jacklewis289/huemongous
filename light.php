<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once("Models/LightData.php");


$view = new stdClass();
$view->pageTitle = 'Light';

$lightData = new LightData();

require_once("Views/light.phtml");
