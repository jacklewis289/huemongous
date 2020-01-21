<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once("Models/LightData.php");
require_once ("Models/Weather.php");


$view = new stdClass();
$view->pageTitle = 'Temperature Lighting';

$lightData = new LightData();
$weatherData = new Weather();


require_once("Views/temperaturelighting.phtml");
